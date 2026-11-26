<?php
require_once __DIR__ . '/../config/database.php';

class Album {
    private PDO $pdo;

    public ?int    $id               = null;
    public string  $titre            = '';
    public string  $description      = '';
    public ?string $date_mariage     = null;
    public string  $code_client      = '';
    public ?string $image_couverture = null;

    public function __construct() {
        $database = new Database();
        $this->pdo = $database->getConnection();
    }

    // ── READ ──────────────────────────────────────────────────────
    

    // Renommé : findById → getById  (appelé par ClientController et AdminController)
    public function getById(int $id): array|false {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM albums WHERE id = :id LIMIT 1'
        );
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // Renommé : findAll → getAll  (appelé par AdminController)
    public function getAll(): array {
        $stmt = $this->pdo->query(
            'SELECT * FROM albums ORDER BY date_mariage DESC'
        );
        return $stmt->fetchAll();
    }

    // Renommé : findByCodeClient → getByCode  (appelé par ClientController)
    public function getByCode(string $code): array|false {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM albums WHERE code_client = :code LIMIT 1'
        );
        $stmt->execute([':code' => $code]);
        return $stmt->fetch();
    }

    // ── CREATE ────────────────────────────────────────────────────

    // Bug 4 corrigé : suppression du premier return, lastInsertId() retourne maintenant l'ID
    public function create(
        string  $titre,
        string  $description,
        string  $code_client,
        ?string $date_mariage = null
    ): int {
        $stmt = $this->pdo->prepare(
            'INSERT INTO albums (titre, description, code_client, date_mariage)
             VALUES (:titre, :description, :code_client, :date_mariage)'
        );
        $stmt->execute([
            ':titre'        => $titre,
            ':description'  => $description,
            ':code_client'  => $code_client,
            ':date_mariage' => $date_mariage,
        ]);
        return (int) $this->pdo->lastInsertId();
    }

    // ── UPDATE ────────────────────────────────────────────────────

    public function update(int $id, string $titre, string $desc, string $date): bool {
        $stmt = $this->pdo->prepare(
            'UPDATE albums
             SET titre = :titre, description = :desc, date_mariage = :date
             WHERE id = :id'
        );
        return $stmt->execute([
            ':titre' => $titre,
            ':desc'  => $desc,
            ':date'  => $date,
            ':id'    => $id,
        ]);
    }

    // ── DELETE ────────────────────────────────────────────────────

    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare('DELETE FROM albums WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }
}

   // getNbPhotos : retourne le nombre de photos dans un album donné
    public function getNbPhotos(int $albumId): int {
        $stmt = $this->pdo->prepare(
            'SELECT COUNT(*) AS nb_photos FROM photos WHERE album_id = :album_id'
        );
        $stmt->execute([':album_id' => $albumId]);
        $result = $stmt->fetch();
        return (int) ($result['nb_photos'] ?? 0);
    }