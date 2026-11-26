<?php // views/layout/header.php

$action    = $_GET['action'] ?? 'home';
$is_admin  = strpos($action, 'admin_') === 0;
$is_light  = $is_admin || in_array($action, ['forfaits','photographe','contact','mentions_legales']);
$is_dark   = in_array($action, ['galerie','client_login','client_gallery']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LoveLens — Photographe de Mariage</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;1,400&family=Cormorant+Garamond:wght@300;400&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/lovelens1/public/css/style.css">
  <?php if ($is_admin): ?>
  <link rel="stylesheet" href="/lovelens1/public/css/admin.css">
  <?php endif; ?>

  <?php if ($is_light): ?>
  <style>
    #ll-nav,
    #ll-nav.ll-nav,
    nav.ll-nav {
      background: rgba(253,250,247,0.97) !important;
      backdrop-filter: blur(12px) !important;
      box-shadow: 0 1px 0 rgba(0,0,0,0.06) !important;
    }
    #ll-nav .ll-nav-logo { color: #1C1C1C !important; }
    #ll-nav .ll-nav-links a,
    #ll-nav .ll-nav-links .nav-link { color: #7A7570 !important; }
    #ll-nav .ll-nav-links a:hover { color: #B89B6A !important; }
    #ll-nav .ll-nav-cta { border-color: #B89B6A !important; color: #8B7248 !important; }
    #ll-nav .ll-nav-burger span { background: #1C1C1C !important; }
    .page-content { padding-top: 80px !important; }
  </style>
  <?php elseif ($is_dark): ?>
  <style>
    #ll-nav,
    #ll-nav.ll-nav,
    nav.ll-nav {
      background: rgba(14,14,14,0.95) !important;
      backdrop-filter: blur(12px) !important;
    }
    #ll-nav .ll-nav-logo { color: #F7F3EE !important; }
    #ll-nav .ll-nav-links a,
    #ll-nav .ll-nav-links .nav-link { color: rgba(253,250,247,0.75) !important; }
    #ll-nav .ll-nav-links a:hover { color: #D4BB8E !important; }
    #ll-nav .ll-nav-cta { border-color: rgba(184,155,106,0.5) !important; color: #D4BB8E !important; }
    #ll-nav .ll-nav-burger span { background: #F7F3EE !important; }
  </style>
  <?php endif; ?>
  <style>
    :root {
      --cream:      #F7F3EE;
      --warm-white: #FDFAF7;
      --charcoal:   #1C1C1C;
      --dark-gray:  #2E2E2E;
      --mid-gray:   #7A7570;
      --light-gray: #C9C4BE;
      --gold:       #B89B6A;
      --gold-light: #D4BB8E;
      --gold-dark:  #8B7248;
      --font-display: 'Playfair Display', Georgia, serif;
      --font-body:    'Cormorant Garamond', Georgia, serif;
      --font-ui:      'Jost', sans-serif;
      --transition:   0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    /* ─── Reset global ─── */
    body { font-family: var(--font-body); background: var(--warm-white); }
    a    { text-decoration: none !important; }

    /* ─── Navbar LoveLens ─── */
    .ll-nav {
      position: fixed;
      top: 0; left: 0; right: 0;
      z-index: 1000;
      padding: 1.2rem 3rem;
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: space-between;
      transition: background 0.4s ease, box-shadow 0.4s ease;
      background: transparent;
    }

    .ll-nav.scrolled {
      background: rgba(253,250,247,0.96);
      backdrop-filter: blur(12px);
      box-shadow: 0 1px 0 rgba(0,0,0,0.06);
    }

    /* Logo */
    .ll-nav-logo {
      font-family: var(--font-display);
      font-size: 1.4rem;
      font-style: italic;
      color: white;
      transition: color 0.4s ease;
      flex-shrink: 0;
    }
    .ll-nav.scrolled .ll-nav-logo { color: var(--charcoal); }

    /* Liens */
    .ll-nav-links {
      display: flex;
      flex-direction: row;
      align-items: center;
      gap: 2.5rem;
      list-style: none;
      margin: 0; padding: 0;
    }

    .ll-nav-links a {
      font-family: var(--font-ui);
      font-size: 0.75rem;
      letter-spacing: 0.18em;
      text-transform: uppercase;
      color: rgba(255,255,255,0.85) !important;
      transition: color 0.2s ease;
      position: relative;
      white-space: nowrap;
    }
    .ll-nav.scrolled .ll-nav-links a { color: var(--mid-gray) !important; }
    .ll-nav-links a:hover { color: var(--gold) !important; }

    /* Ligne sous le lien au hover */
    .ll-nav-links a::after {
      content: '';
      position: absolute;
      bottom: -4px; left: 0; right: 0;
      height: 1px;
      background: var(--gold);
      transform: scaleX(0);
      transition: transform 0.4s ease;
      transform-origin: left;
    }
    .ll-nav-links a:hover::after { transform: scaleX(1); }

    /* Bouton Admin (discret) */
    .ll-nav-admin {
      font-family: var(--font-ui);
      font-size: 0.68rem;
      letter-spacing: 0.14em;
      text-transform: uppercase;
      color: var(--gold-light) !important;
    }
    .ll-nav.scrolled .ll-nav-admin { color: var(--gold-dark) !important; }

    /* Bouton Espace client */
    .ll-nav-cta {
      font-family: var(--font-ui);
      font-size: 0.72rem;
      font-weight: 500;
      letter-spacing: 0.16em;
      text-transform: uppercase;
      padding: 0.55rem 1.4rem;
      border: 1px solid rgba(255,255,255,0.6);
      color: white !important;
      flex-shrink: 0;
      transition: all 0.4s ease;
      white-space: nowrap;
    }
    .ll-nav.scrolled .ll-nav-cta {
      border-color: var(--gold);
      color: var(--gold-dark) !important;
    }
    .ll-nav-cta:hover {
      background: var(--gold);
      border-color: var(--gold);
      color: white !important;
    }

    /* Burger mobile */
    .ll-nav-burger {
      display: none;
      flex-direction: column;
      gap: 5px;
      cursor: pointer;
      background: none;
      border: none;
      padding: 4px;
    }
    .ll-nav-burger span {
      display: block;
      width: 24px; height: 1.5px;
      background: white;
      transition: background 0.4s ease;
    }
    .ll-nav.scrolled .ll-nav-burger span { background: var(--charcoal); }

    /* Menu mobile */
    .ll-nav-mobile {
      display: none;
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      background: var(--warm-white);
      z-index: 999;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 2rem;
    }
    .ll-nav-mobile.open { display: flex; }
    .ll-nav-mobile a {
      font-family: var(--font-display);
      font-size: 2rem;
      font-style: italic;
      color: var(--dark-gray) !important;
      transition: color 0.2s ease;
    }
    .ll-nav-mobile a:hover { color: var(--gold) !important; }
    .ll-nav-mobile-close {
      position: absolute;
      top: 1.5rem; right: 2rem;
      font-family: var(--font-ui);
      font-size: 0.72rem;
      letter-spacing: 0.18em;
      text-transform: uppercase;
      color: var(--mid-gray) !important;
      cursor: pointer;
      background: none;
      border: none;
    }

    /* Espace sous la navbar fixe */
    .page-content { padding-top: 0; }

    /* Alertes */
    .ll-alerts {
      position: fixed;
      top: 80px; left: 50%; transform: translateX(-50%);
      z-index: 998;
      width: 100%;
      max-width: 600px;
      padding: 0 1rem;
    }

    /* ─── Responsive ─── */
    @media (max-width: 991.98px) {
      .ll-nav-links, .ll-nav-cta { display: none; }
      .ll-nav-burger { display: flex; }
      .ll-nav { padding: 1.2rem 1.5rem; }
    }
  </style>
</head>
<body>

<!-- ─── Navbar ─── -->
<nav class="ll-nav" id="ll-nav">
  <a href="?action=home" class="ll-nav-logo">LoveLens</a>

  <ul class="ll-nav-links">
    <li><a href="?action=home">Accueil</a></li>
    <li><a href="?action=photographe">Le photographe</a></li>
    <li><a href="?action=galerie">Galerie</a></li>
    <li><a href="?action=forfaits">Forfaits</a></li>
    <li><a href="?action=contact">Contact</a></li>
    <?php if (!empty($_SESSION['admin_id'])): ?>
      <li><a href="?action=admin_albums" class="ll-nav-admin">Admin</a></li>
    <?php endif; ?>
  </ul>

  <a href="?action=client_login" class="ll-nav-cta">Mon album</a>

  <button class="ll-nav-burger" id="ll-burger" aria-label="Menu">
    <span></span><span></span><span></span>
  </button>
</nav>

<!-- ─── Menu mobile ─── -->
<div class="ll-nav-mobile" id="ll-mobile-menu">
  <button class="ll-nav-mobile-close" id="ll-close">Fermer ✕</button>
  <a href="?action=home"         onclick="closeMobile()">Accueil</a>
  <a href="?action=photographe"  onclick="closeMobile()">Le photographe</a>
  <a href="?action=galerie"      onclick="closeMobile()">Galerie</a>
  <a href="?action=forfaits"     onclick="closeMobile()">Forfaits</a>
  <a href="?action=contact"      onclick="closeMobile()">Contact</a>
  <a href="?action=client_login" onclick="closeMobile()" style="font-size:1rem; color: var(--gold) !important;">Mon album →</a>
  <?php if (!empty($_SESSION['admin_id'])): ?>
    <a href="?action=admin_albums"  onclick="closeMobile()" style="color: var(--gold) !important; font-size:1rem;">Admin</a>
    <a href="?action=admin_logout"  onclick="closeMobile()" style="color: #C0392B !important; font-size:0.9rem;">Déconnexion</a>
  <?php endif; ?>
</div>

<!-- ─── Alertes session ─── -->
<?php if (!empty($_SESSION['success']) || !empty($_SESSION['error'])): ?>
<div class="ll-alerts">
  <?php if (!empty($_SESSION['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show">
      <?= htmlspecialchars($_SESSION['success']) ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php unset($_SESSION['success']); ?>
  <?php endif; ?>
  <?php if (!empty($_SESSION['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show">
      <?= $_SESSION['error'] ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php unset($_SESSION['error']); ?>
  <?php endif; ?>
</div>
<?php endif; ?>

<!-- ─── Scripts navbar ─── -->
<script>
  // Scroll → navbar devient blanche
  const nav = document.getElementById('ll-nav');
  window.addEventListener('scroll', () => {
    nav.classList.toggle('scrolled', window.scrollY > 60);
  }, { passive: true });

  // Burger menu
  const burger = document.getElementById('ll-burger');
  const menu   = document.getElementById('ll-mobile-menu');
  const close  = document.getElementById('ll-close');

  burger.addEventListener('click', () => menu.classList.add('open'));
  close.addEventListener('click',  () => menu.classList.remove('open'));

  function closeMobile() { menu.classList.remove('open'); }
</script>

<div class="page-content">
<?php // Le contenu de la page commence ici
// Sur les pages admin, on ajoute un conteneur Bootstrap avec marge
if (strpos($action, 'admin_') === 0): ?>
<div class="container-xl py-4">
<?php endif; ?>

<?php /* Modifier la vue views/layout/header.php pour afficher dans la barre de navigation, côté droit (classe ms-auto de Bootstrap), le login de l'administrateur connecté. Le login est disponible dans $_SESSION['admin_login']. Utiliser htmlspecialchars() pour protéger l'affichage. N'afficher ce bloc que si la session admin est active (isset($_SESSION['admin_id'])). */ ?>
<?php if (isset($_SESSION['admin_id'])): ?>
  <div class="ms-auto" style="color: var(--gold); font-weight: bold;">
    <?= htmlspecialchars($_SESSION['admin_login']) ?>
  </div>
<?php endif; ?>

<?php /* Ajouter un lien "Déconnexion" à côté du login de l'administrateur, qui pointe vers ?action=admin_logout. */ ?>
<?php if (isset($_SESSION['admin_id'])): ?>
  <a href="?action=admin_logout" class="ms-3" style="color: #C0392B; font-weight: bold;">
    Déconnexion
  </a>
<?php endif; ?>
