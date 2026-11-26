<?php
class AdminController {

    // ✅ Bug 6 corrigé : admin_id au lieu de admin
    private function requireAdmin(): void {
        if (empty($_SESSION['admin_id'])) {
            $_SESSION['error'] = 'Accès réservé aux administrateurs.';
            header('Location: ?action=admin_login');
            exit;
        }
    }

    // ── Albums ────────────────────────────────────────────────────

    // Redirige vers la connexion si la session admin a expiré (au lieu d'une erreur)
    private function redirectIfNotAdmin(): void {
        if (empty($_SESSION['admin_id'])) {
            $_SESSION['error'] = 'Votre session a expiré, veuillez vous reconnecter.';
            header('Location: ?action=admin_login');
            exit;
        }
    }

    public function albums(): void {
        $this->redirectIfNotAdmin();
        $albums = (new Album())->getAll(); // ✅ findAll() → getAll()
        require_once __DIR__ . '/../views/admin/albums.php';
    }

    public function createAlbum(): void {
        $this->requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titre        = trim($_POST['titre']        ?? '');
            $desc         = trim($_POST['description']  ?? '');
            $date_mariage = trim($_POST['date_mariage'] ?? '');

            $code = trim($_POST['code_client'] ?? '');
            if (empty($code)) {
                $code = strtoupper(substr(md5(uniqid()), 0, 8));
            }

            if (empty($titre)) {
                $_SESSION['error'] = 'Le titre est obligatoire.';
                header('Location: ?action=admin_album_create'); exit;
            }

            // ✅ Bug 3 corrigé : $date → $date_mariage
            $id = (new Album())->create($titre, $desc, $code, $date_mariage);
            $_SESSION['success'] = "Album créé ! Code client : {$code}";
            header('Location: ?action=admin_photos&album_id=' . $id);
            exit;
        }

        require_once __DIR__ . '/../views/admin/album_form.php';
    }

    public function editAlbum(): void {
        $this->requireAdmin();
        $id = (int) ($_GET['id'] ?? 0);

        $albumModel = new Album();
        $album      = $albumModel->getById($id);

        if (!$album) {
            $_SESSION['error'] = 'Album introuvable.';
            header('Location: ?action=admin_albums'); exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $albumModel->update(
                $id,
                trim($_POST['titre']        ?? ''),
                trim($_POST['description']  ?? ''),
                trim($_POST['date_mariage'] ?? '')
            );
            $_SESSION['success'] = 'Album mis à jour.';
            header('Location: ?action=admin_albums'); exit;
        }

        require_once __DIR__ . '/../views/admin/album_form.php';
    }

    public function deleteAlbum(): void {
        $this->requireAdmin();
        $id = (int) ($_GET['id'] ?? 0);

        // Supprimer les fichiers physiques
        $dir = __DIR__ . '/../public/uploads/album_' . $id . '/';
        if (is_dir($dir)) {
            foreach (glob($dir . '*') as $f) unlink($f);
            rmdir($dir);
        }

        (new Album())->delete($id);
        $_SESSION['success'] = 'Album supprimé.';
        header('Location: ?action=admin_albums'); exit;
    }

    // ── Photos ────────────────────────────────────────────────────

    public function photos(): void {
        $this->requireAdmin();
        $albumId = (int) ($_GET['album_id'] ?? 0);

        $album = (new Album())->getById($albumId);
        if (!$album) {
            header('Location: ?action=admin_albums'); exit;
        }

        $photos   = (new Photo())->getByAlbum($albumId);
        $nbPhotos = (new Photo())->countByAlbum($albumId);
        require_once __DIR__ . '/../views/admin/photos.php';
    }

    public function uploadPhotos(): void {
        $this->requireAdmin();
        $albumId = (int) ($_POST['album_id'] ?? 0);

        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !$albumId) {
            header('Location: ?action=admin_albums'); exit;
        }

        $fm         = new FileManager();
        $photoModel = new Photo();
        $errors     = [];
        $uploaded   = 0;

        $files = $_FILES['photos'];
        for ($i = 0; $i < count($files['name']); $i++) {
            $file = [
                'name'     => $files['name'][$i],
                'tmp_name' => $files['tmp_name'][$i],
                'error'    => $files['error'][$i],
                'size'     => $files['size'][$i],
            ];
            $result = $fm->upload($file, $albumId);
            if ($result['success']) {
                $photoModel->create($result['path'], $albumId);
                $uploaded++;
            } else {
                $errors[] = $files['name'][$i] . ' : ' . $result['error'];
            }
        }

        if ($uploaded) $_SESSION['success'] = "{$uploaded} photo(s) ajoutée(s).";
        if ($errors)   $_SESSION['error']   = implode('<br>', $errors);
        header('Location: ?action=admin_photos&album_id=' . $albumId); exit;
    }

    public function deletePhoto(): void {
        $this->requireAdmin();
        $pid = (int) ($_GET['id']       ?? 0);
        $aid = (int) ($_GET['album_id'] ?? 0);

        $path = (new Photo())->delete($pid);
        if ($path) (new FileManager())->deleteFile($path);

        $_SESSION['success'] = 'Photo supprimée.';
        header('Location: ?action=admin_photos&album_id=' . $aid); exit;
    }

    public function setCover(): void {
        $this->requireAdmin();
        $photoId = (int) ($_GET['photo_id'] ?? 0);
        $albumId = (int) ($_GET['album_id'] ?? 0);

        // Marquer is_cover en BDD
        $pdo = (new Database())->getConnection();
        $pdo->prepare('UPDATE photos SET is_cover = 0 WHERE id_album = :aid')
            ->execute([':aid' => $albumId]);
        $pdo->prepare('UPDATE photos SET is_cover = 1 WHERE id = :pid')
            ->execute([':pid' => $photoId]);

        // Mettre à jour image_couverture dans albums
        $stmt = $pdo->prepare('SELECT chemin_fichier FROM photos WHERE id = :pid');
        $stmt->execute([':pid' => $photoId]);
        $photo = $stmt->fetch();
        if ($photo) {
            $pdo->prepare('UPDATE albums SET image_couverture = :c WHERE id = :aid')
                ->execute([':c' => $photo['chemin_fichier'], ':aid' => $albumId]);
        }

        $_SESSION['success'] = 'Photo de couverture mise à jour.';
        header('Location: ?action=admin_photos&album_id=' . $albumId); exit;
    }


    // crée un DELETE WHERE id_album pour nettouyer la BDD avant de supprimer l'album
    public function deleteAlbumWithPhotos(): void {
        $this->requireAdmin();
        $albumId = (int) ($_GET['id'] ?? 0);
        (new Photo())->deleteByAlbum($albumId);
        (new Album())->delete($albumId);
        $_SESSION['success'] = 'Album supprimé avec ses photos.';
        header('Location: ?action=admin_albums'); exit;
    }


    // ── Témoignages ───────────────────────────────────────────────

    public function testimonials(): void {
        $this->requireAdmin();
        $pdo  = (new Database())->getConnection();
        $stmt = $pdo->query(
            'SELECT t.*, a.titre FROM testimonials t
             LEFT JOIN albums a ON t.id_album = a.id
             ORDER BY t.created_at DESC'
        );
        $testimonials = $stmt->fetchAll();
        require_once __DIR__ . '/../views/admin/testimonials.php';
    }

    // Rend un témoignage visible sur le site public
    public function approveTestimonial(): void {
        $this->requireAdmin();
        $id = (int) ($_GET['id'] ?? 0);
        (new Database())->getConnection()
            ->prepare('UPDATE testimonials SET approuve = 1 WHERE id = :id')
            ->execute([':id' => $id]);
        $_SESSION['success'] = 'Témoignage approuvé.';
        header('Location: ?action=admin_testimonials'); exit;
    }

    public function deleteTestimonial(): void {
        $this->requireAdmin();
        $id = (int) ($_GET['id'] ?? 0);
        (new Database())->getConnection()
            ->prepare('DELETE FROM testimonials WHERE id = :id')
            ->execute([':id' => $id]);
        $_SESSION['success'] = 'Témoignage supprimé.';
        header('Location: ?action=admin_testimonials'); exit;
    }
}
