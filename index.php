<?php
// Les erreurs sont journalisées, jamais affichées au visiteur
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);
ob_start();
session_start();

spl_autoload_register(function (string $class_name) {
    $paths = [__DIR__ . '/models/', __DIR__ . '/config/', __DIR__ . '/controllers/'];
    foreach ($paths as $dir) {
        $file = $dir . $class_name . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
    die("Classe '$class_name' introuvable.");
});

$action = $_GET['action'] ?? 'home';

switch ($action) {

    // ── Public ────────────────────────────────────────────────────
    case 'home':
        (new PublicController())->home();
        break;
    case 'photographe':
        (new PublicController())->photographe();
        break;
    case 'galerie':
        (new PublicController())->galerie();
        break;
    case 'forfaits':
        (new PublicController())->forfaits();
        break;
    case 'contact':
        (new PublicController())->contact();
        break;

    // ── Client ────────────────────────────────────────────────────
    case 'client_login':
        (new ClientController())->showLogin();
        break;
    case 'client_auth':
        (new ClientController())->authenticate();
        break;
    case 'client_gallery':
        (new ClientController())->gallery();
        break;
    case 'client_download':
        (new ClientController())->downloadZip();
        break;
    case 'client_logout':
        (new ClientController())->logout();
        break;

    // ── Admin : Auth ──────────────────────────────────────────────
    case 'admin_login':
        (new AuthController())->showLogin();
        break;
    case 'admin_auth':
        (new AuthController())->authenticate();
        break;
    case 'admin_logout':
        (new AuthController())->logout();
        break;

    // ── Admin : Albums ────────────────────────────────────────────
    case 'admin_albums':                                      // ✅ ajout du s
        (new AdminController())->albums();
        break;
    case 'admin_album_create':
        (new AdminController())->createAlbum();
        break;
    case 'admin_album_edit':
        (new AdminController())->editAlbum();
        break;
    case 'admin_album_delete':
        (new AdminController())->deleteAlbum();
        break;

    // ── Admin : Photos ────────────────────────────────────────────
    case 'admin_photos':
        (new AdminController())->photos();
        break;
    case 'admin_photo_upload':
        (new AdminController())->uploadPhotos();
        break;
    case 'admin_photo_delete':
        (new AdminController())->deletePhoto();
        break;
    case 'admin_photo_cover':
        (new AdminController())->setCover();
        break;

    // ── Admin : Témoignages ───────────────────────────────────────
    case 'admin_testimonials':
        (new AdminController())->testimonials();
        break;
    case 'admin_testimonial_approve':
        (new AdminController())->approveTestimonial();
        break;
    case 'admin_testimonial_delete':
        (new AdminController())->deleteTestimonial();
        break;

    default:
        http_response_code(404);
        echo "Erreur 404 - Page non trouvée.";
        break;
}