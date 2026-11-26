<?php
class FileManager {

    // ✅ Suppression de $pdo et du constructeur — FileManager ne touche pas la BDD
    // C'est le contrôleur qui appelle Photo::create() pour enregistrer en BDD

    public function upload(array $file, int $albumId): array {
        // ① Erreur de transfert HTTP ?
        if ($file['error'] !== UPLOAD_ERR_OK)
            return ['success' => false, 'error' => "Erreur d'upload."];

        // ② Taille max 10 Mo
        if ($file['size'] > 10 * 1024 * 1024)
            return ['success' => false, 'error' => 'Fichier trop volumineux (max 10 Mo).'];

        // ③ Type MIME RÉEL — lit les octets magiques du fichier
        $finfo    = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($file['tmp_name']);
        $mimes    = ['image/jpeg', 'image/png', 'image/webp'];
        if (!in_array($mimeType, $mimes))
            return ['success' => false, 'error' => 'Type de fichier non autorisé.'];

        // ④ Extension whitelist
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp']))
            return ['success' => false, 'error' => "Extension non autorisée."];

        // ⑤ Créer le dossier si nécessaire
        $dir = __DIR__ . '/../public/uploads/album_' . $albumId . '/';
        if (!is_dir($dir)) mkdir($dir, 0755, true);

        // ⑥ Nom unique anti-doublon + déplacement
        $name = uniqid('photo_', true) . '.' . $ext;
        move_uploaded_file($file['tmp_name'], $dir . $name);

        return ['success' => true, 'path' => 'uploads/album_' . $albumId . '/' . $name];
    }

    public function deleteFile(string $relativePath): bool {
        $full = __DIR__ . '/../public/' . $relativePath;
        return file_exists($full) ? unlink($full) : false;
    }
}