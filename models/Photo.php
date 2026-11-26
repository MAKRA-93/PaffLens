<?php
require_once __DIR__ . '/../config/database.php';
 
class Photo {
    private PDO $pdo;
 
    public function __construct() {
        $this->pdo = (new Database())->getConnection();
    }
 
    // Toutes les photos d'un album (du plus ancien au plus récent)
    public function getByAlbum(int $albumId): array {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM photos
             WHERE id_album = :id ORDER BY created_at ASC'
        );
        $stmt->execute([':id' => $albumId]);
        return $stmt->fetchAll();
    }
 
    // Insère une photo en BDD — retourne son ID
    public function create(string $chemin, int $albumId): int {
        $stmt = $this->pdo->prepare(
            'INSERT INTO photos (chemin_fichier, id_album)
             VALUES (:chemin, :album)'
        );
        $stmt->execute([':chemin'=>$chemin, ':album'=>$albumId]);
        return (int) $this->pdo->lastInsertId();
    }
 
    // Supprime en BDD, retourne le chemin pour supprimer le fichier
    public function delete(int $id): string|false {
        $stmt = $this->pdo->prepare(
            'SELECT chemin_fichier FROM photos WHERE id = :id'
        );
        $stmt->execute([':id' => $id]);
        $photo = $stmt->fetch();
        if (!$photo) return false;
        $this->pdo->prepare('DELETE FROM photos WHERE id=:id')
                  ->execute([':id' => $id]);
        return $photo['chemin_fichier'];  // Contrôleur appelle unlink()
    }

    // Ajoute la commande deleteByAlbum pour supprimer toutes les photos d'un album donné
    public function deleteByAlbum(int $albumId): void {
        $stmt = $this->pdo->prepare(
            'SELECT chemin_fichier FROM photos WHERE id_album = :album_id'
        );
        $stmt->execute([':album_id' => $albumId]);
        $photos = $stmt->fetchAll();
        foreach ($photos as $photo) {
            (new FileManager())->deleteFile($photo['chemin_fichier']);
        }
        $this->pdo->prepare('DELETE FROM photos WHERE id_album = :album_id')
                  ->execute([':album_id' => $albumId]);
    }

    // Ajouter la méthode Photo::countByAlbum(int $albumId): int dans Photo.php. Cette méthode retourne le nombre de photos de l'album via une requête COUNT(*) préparée PDO.

    public function countByAlbum(int $albumId): int {
        $stmt = $this->pdo->prepare(
            'SELECT COUNT(*) AS nb_photos FROM photos WHERE id_album = :album_id'
        );
        $stmt->execute([':album_id' => $albumId]);
        $result = $stmt->fetch();
        return (int) ($result['nb_photos'] ?? 0);
    }
}
