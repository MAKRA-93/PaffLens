<?php
class AuthController {

    public function showLogin(): void {
        if (!empty($_SESSION['admin_id'])) {
            header('Location: ?action=admin_albums');
            exit;
        }
        require_once __DIR__ . '/../views/admin/login.php';
    }

    public function authenticate(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ?action=admin_login'); exit;
        }

        $login = trim($_POST['login']    ?? '');
        $pass  = trim($_POST['password'] ?? '');

        $user = (new User())->authenticate($login, $pass);

        if ($user) {
            session_regenerate_id(true);
            $_SESSION['admin_id']    = $user['id'];
            $_SESSION['admin_login'] = $user['login'];
            header('Location: ?action=admin_albums');
        } else {
            $_SESSION['error'] = 'Identifiants incorrects.';
            header('Location: ?action=admin_login');
        }
        exit;
    }

    public function logout(): void {
        session_destroy();
        header('Location: ?action=home'); exit;
    }
}