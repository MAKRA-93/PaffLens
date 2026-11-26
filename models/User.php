<?php
require_once __DIR__ . '/../config/database.php';
 
class User {
    private PDO $pdo;
 
    public function __construct() {
        $this->pdo = (new Database())->getConnection();
    }
 
    /**
     * Vérifie les identifiants admin.
     * @return array|false  L'utilisateur si authentifié, false sinon
     */
    public function authenticate(string $login, string $password): array|false {
        // 1. Chercher l'utilisateur par son login uniquement
        $stmt = $this->pdo->prepare(
            'SELECT * FROM users WHERE login = :login LIMIT 1'
        );
        $stmt->execute([':login' => $login]);
        $user = $stmt->fetch();
 
        // 2. Vérifier le mot de passe avec password_verify()
        //    Ne jamais faire : $user['password'] === $password  ← FAUX !
        if ($user && password_verify($password, $user['password'])) {
            return $user;  // ✅ Login + mot de passe corrects
        }
 
        return false;  // ❌ Login inexistant OU mot de passe incorrect
        // ⭐ Même message d'erreur pour les 2 cas !
        //    Ne pas révéler si le login existe ou non.
    }
}
