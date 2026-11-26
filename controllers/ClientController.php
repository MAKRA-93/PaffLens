<?php
class ClientController {

    public function showLogin(): void {
        if (!empty($_SESSION['client_album_id'])) {
            header('Location: ?action=client_gallery'); exit;
        }
        require_once __DIR__ . '/../views/public/login_client.php';
    }

    public function authenticate(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ?action=client_login'); exit;
        }
        $code  = trim(strtoupper($_POST['code_album'] ?? ''));
        $album = (new Album())->getByCode($code);

        if ($album) {
            $_SESSION['client_album_id']    = $album['id'];
            $_SESSION['client_album_titre'] = $album['titre'];
            header('Location: ?action=client_gallery');
        } else {
            $_SESSION['error'] = 'Code album invalide.';
            header('Location: ?action=client_login');
        }
        exit;
    }

    public function gallery(): void {
        if (empty($_SESSION['client_album_id'])) {
            header('Location: ?action=client_login'); exit;
        }
        $albumId = (int) $_SESSION['client_album_id'];
        $album   = (new Album())->getById($albumId);
        $photos  = (new Photo())->getByAlbum($albumId);
        require_once __DIR__ . '/../views/client/gallery.php';
    }

    public function logout(): void {
        unset($_SESSION['client_album_id'], $_SESSION['client_album_titre']);
        header('Location: ?action=home'); exit;
    }

    public function downloadZip(): void {
        if (empty($_SESSION['client_album_id'])) {
            header('Location: ?action=client_login'); exit;
        }

        // Vérifier que ZipArchive est disponible
        if (!class_exists('ZipArchive')) {
            die('Erreur : l\'extension ZipArchive n\'est pas activée sur ce serveur.');
        }

        $albumId = (int) $_SESSION['client_album_id'];
        $photos  = (new Photo())->getByAlbum($albumId);

        if (empty($photos)) {
            die('Aucune photo dans cet album.');
        }

        // Chemin absolu propre vers public/ (sans /../)
        $publicDir = realpath(__DIR__ . '/../public') . '/';
        // Dossier tmp dans le projet (évite le problème de droits sur Mac/XAMPP)
        $tmpDir = __DIR__ . '/../public/uploads/tmp/';
        if (!is_dir($tmpDir)) mkdir($tmpDir, 0755, true);
        $zipPath = $tmpDir . 'album_' . $albumId . '_' . time() . '.zip';

        $zip = new ZipArchive();
        $result = $zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        if ($result !== true) {
            die('Erreur ZIP code ' . $result . ' — dossier tmp : ' . sys_get_temp_dir() . ' — droits : ' . (is_writable(sys_get_temp_dir()) ? 'OK' : 'NON WRITABLE'));
        }

        $added = 0;
        foreach ($photos as $p) {
            $fp = $publicDir . $p['chemin_fichier'];
            if (file_exists($fp)) {
                $zip->addFile($fp, basename($fp));
                $added++;
            }
        }
        $zip->close();

        if ($added === 0) {
            unlink($zipPath);
            die('Aucune photo trouvée sur le serveur.');
        }

        // Envoi du fichier ZIP au navigateur
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="album_' . $albumId . '.zip"');
        header('Content-Length: ' . filesize($zipPath));
        header('Pragma: no-cache');
        header('Expires: 0');
        ob_end_clean(); // Vide le buffer de sortie avant d'envoyer le fichier
        readfile($zipPath);
        unlink($zipPath);
        exit;
    }
}