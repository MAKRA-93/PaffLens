<?php require_once __DIR__ . '/../layout/header.php'; ?>

<style>
  /* ── Reset page ── */
  body { background: #0a0a0a; }
  .ll-nav { display: none !important; }
  .page-content { padding-top: 0 !important; }

  /* ── Hero plein écran ── */
  .gallery-hero {
    position: relative;
    height: 100vh;
    min-height: 600px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
  }

  .gallery-hero-bg {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    transition: transform 8s ease-out;
    transform: scale(1.04);
  }
  .gallery-hero-bg.loaded { transform: scale(1); }

  /* Dégradé bas */
  .gallery-hero-gradient {
    position: absolute;
    inset: 0;
    background: linear-gradient(
      to bottom,
      rgba(0,0,0,0.1) 0%,
      rgba(0,0,0,0) 40%,
      rgba(0,0,0,0.6) 75%,
      rgba(0,0,0,0.9) 100%
    );
  }

  /* Infos album */
  .gallery-hero-info {
    position: relative;
    z-index: 2;
    padding: 0 2.5rem 2rem;
  }

  .gallery-hero-title {
    font-family: 'Jost', sans-serif;
    font-size: 0.7rem;
    font-weight: 500;
    letter-spacing: 0.3em;
    text-transform: uppercase;
    color: white;
    margin-bottom: 0.4rem;
  }

  .gallery-hero-date {
    font-family: 'Jost', sans-serif;
    font-size: 0.65rem;
    letter-spacing: 0.12em;
    color: rgba(255,255,255,0.5);
  }

  /* Flèche scroll */
  .gallery-hero-scroll {
    position: absolute;
    bottom: 1.5rem;
    left: 50%;
    transform: translateX(-50%);
    z-index: 2;
    display: flex;
    flex-direction: column;
    align-items: center;
    color: rgba(255,255,255,0.4);
    animation: bounce 2s ease-in-out infinite;
  }
  @keyframes bounce {
    0%,100% { transform: translateX(-50%) translateY(0); }
    50%      { transform: translateX(-50%) translateY(6px); }
  }

  /* Watermark discret */
  .gallery-hero-watermark {
    position: absolute;
    bottom: 1.2rem;
    right: 1.5rem;
    z-index: 2;
    font-family: 'Playfair Display', Georgia, serif;
    font-style: italic;
    font-size: 0.75rem;
    color: rgba(255,255,255,0.25);
    letter-spacing: 0.06em;
  }

  /* ── Barre d'actions fixe ── */
  .gallery-toolbar {
    position: sticky;
    top: 0;
    z-index: 100;
    background: rgba(15,15,15,0.95);
    backdrop-filter: blur(12px);
    border-bottom: 1px solid rgba(255,255,255,0.06);
    padding: 0.85rem 2rem;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
  }

  .gallery-toolbar-left {
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 1.5rem;
  }

  .toolbar-album-name {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 0.95rem;
    font-style: italic;
    color: white;
  }

  .toolbar-count {
    font-family: 'Jost', sans-serif;
    font-size: 0.62rem;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: rgba(255,255,255,0.3);
  }

  .gallery-toolbar-right {
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 0.5rem;
  }

  .toolbar-btn {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: transparent;
    border: 1px solid rgba(255,255,255,0.12);
    color: rgba(255,255,255,0.5);
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
  }
  .toolbar-btn:hover { border-color: #B89B6A; color: #B89B6A; }

  .toolbar-btn-download {
    padding: 0 1.2rem;
    width: auto;
    font-family: 'Jost', sans-serif;
    font-size: 0.65rem;
    font-weight: 500;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    background: #B89B6A;
    border-color: #B89B6A;
    color: white;
    gap: 0.5rem;
    display: inline-flex;
    align-items: center;
  }
  .toolbar-btn-download:hover { background: #8B7248; border-color: #8B7248; color: white; }

  .toolbar-logout {
    font-family: 'Jost', sans-serif;
    font-size: 0.62rem;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: rgba(255,255,255,0.25);
    text-decoration: none;
    padding: 0 0.8rem;
    transition: color 0.2s;
  }
  .toolbar-logout:hover { color: rgba(255,255,255,0.6); }

  /* ── Grille mosaïque ── */
  .gallery-grid-section {
    background: #0a0a0a;
    padding: 4px;
  }

  /* 3 colonnes flexbox */
  .gallery-columns {
    display: flex;
    flex-direction: row;
    gap: 4px;
  }

  .gallery-col {
    flex: 1 1 0;
    min-width: 0;
    display: flex;
    flex-direction: column;
    gap: 4px;
  }

  .gallery-photo {
    width: 100%;
    overflow: hidden;
    position: relative;
    cursor: pointer;
    background: #1a1a1a;
    display: block;
  }

  /* Hauteurs alternées par colonne */
  .gallery-col:nth-child(1) .gallery-photo:nth-child(3n+1) { height: 280px; }
  .gallery-col:nth-child(1) .gallery-photo:nth-child(3n+2) { height: 200px; }
  .gallery-col:nth-child(1) .gallery-photo:nth-child(3n)   { height: 240px; }
  .gallery-col:nth-child(2) .gallery-photo:nth-child(3n+1) { height: 220px; }
  .gallery-col:nth-child(2) .gallery-photo:nth-child(3n+2) { height: 260px; }
  .gallery-col:nth-child(2) .gallery-photo:nth-child(3n)   { height: 200px; }
  .gallery-col:nth-child(3) .gallery-photo:nth-child(3n+1) { height: 240px; }
  .gallery-col:nth-child(3) .gallery-photo:nth-child(3n+2) { height: 200px; }
  .gallery-col:nth-child(3) .gallery-photo:nth-child(3n)   { height: 280px; }

  .gallery-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.6s ease, opacity 0.3s;
    opacity: 0.88;
  }
  .gallery-photo:hover img {
    transform: scale(1.04);
    opacity: 1;
  }

  /* Numéro discret */
  .gallery-photo-num {
    position: absolute;
    bottom: 8px;
    right: 10px;
    font-family: 'Jost', sans-serif;
    font-size: 0.55rem;
    letter-spacing: 0.08em;
    color: rgba(255,255,255,0.3);
    pointer-events: none;
    z-index: 1;
  }

  /* ── Footer galerie ── */
  .gallery-footer {
    background: #0a0a0a;
    border-top: 1px solid rgba(255,255,255,0.05);
    padding: 1.5rem 2rem;
    text-align: center;
    font-family: 'Jost', sans-serif;
    font-size: 0.62rem;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: rgba(255,255,255,0.15);
  }

  /* ── Responsive ── */
  @media (max-width: 767px) {
    .gallery-columns { gap: 2px; }
    .gallery-col:nth-child(3) { display: none; }
    .gallery-col .gallery-photo { height: 180px !important; }
    .toolbar-btn-download span { display: none; }
    .toolbar-btn-download { padding: 0 0.8rem; }
  }
  @media (max-width: 479px) {
    .gallery-col:nth-child(2) { display: none; }
    .gallery-col .gallery-photo { height: 220px !important; }
  }
</style>

<?php
// Photo de couverture pour le hero
$cover = !empty($album['image_couverture'])
  ? '/lovelens1/public/' . htmlspecialchars($album['image_couverture'])
  : '';

// Répartition photos en 3 colonnes
$cols = [[], [], []];
foreach ($photos as $i => $p) {
  $cols[$i % 3][] = $p;
}

// Formatage date
$date_fr = '';
if (!empty($album['date_mariage'])) {
  $mois = ['','Janvier','Février','Mars','Avril','Mai','Juin',
           'Juillet','Août','Septembre','Octobre','Novembre','Décembre'];
  $ts = strtotime($album['date_mariage']);
  $date_fr = date('d', $ts) . ' ' . $mois[(int)date('n', $ts)] . ' ' . date('Y', $ts);
}
?>

<!-- ═══════════════════════════════════════
     HERO
═══════════════════════════════════════ -->
<section class="gallery-hero">

  <div class="gallery-hero-bg<?= $cover ? '' : ' no-cover' ?>"
       id="heroBg"
       <?= $cover ? "style=\"background-image:url('$cover')\"" : "style=\"background:#1a1a1a\"" ?>>
  </div>

  <div class="gallery-hero-gradient"></div>

  <div class="gallery-hero-info">
    <div class="gallery-hero-title"><?= htmlspecialchars($album['titre']) ?></div>
    <?php if ($date_fr): ?>
      <div class="gallery-hero-date"><?= $date_fr ?></div>
    <?php endif; ?>
  </div>

  <div class="gallery-hero-scroll">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
      <polyline points="6 9 12 15 18 9"/>
    </svg>
  </div>

  <div class="gallery-hero-watermark">LoveLens</div>

</section>


<!-- ═══════════════════════════════════════
     BARRE D'ACTIONS
═══════════════════════════════════════ -->
<div class="gallery-toolbar">

  <div class="gallery-toolbar-left">
    <span class="toolbar-album-name"><?= htmlspecialchars($album['titre']) ?></span>
    <span class="toolbar-count"><?= count($photos) ?> photo<?= count($photos) > 1 ? 's' : '' ?></span>
  </div>

  <div class="gallery-toolbar-right">

    <!-- Télécharger -->
    <a href="?action=client_download" class="toolbar-btn toolbar-btn-download">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
        <polyline points="7 10 12 15 17 10"/>
        <line x1="12" y1="15" x2="12" y2="3"/>
      </svg>
      <span>Télécharger l'album</span>
    </a>

    <!-- Se déconnecter -->
    <a href="?action=client_logout" class="toolbar-logout">Quitter</a>

  </div>

</div>


<!-- ═══════════════════════════════════════
     GRILLE PHOTOS
═══════════════════════════════════════ -->
<section class="gallery-grid-section">

  <?php if (empty($photos)): ?>
    <div style="padding:5rem 2rem; text-align:center; font-family:'Playfair Display',Georgia,serif; font-style:italic; color:rgba(255,255,255,0.3); font-size:1.2rem;">
      Votre album est en cours de préparation — revenez bientôt.
    </div>
  <?php else: ?>

    <div class="gallery-columns">
      <?php foreach ($cols as $col_photos): ?>
        <div class="gallery-col">
          <?php foreach ($col_photos as $i => $photo): ?>
            <a
              href="/lovelens1/public/<?= htmlspecialchars($photo['chemin_fichier']) ?>"
              class="gallery-photo glightbox"
              data-gallery="wedding"
              data-description="<?= htmlspecialchars($album['titre']) ?>"
            >
              <img
                src="/lovelens1/public/<?= htmlspecialchars($photo['chemin_fichier']) ?>"
                alt="Photo de mariage"
                loading="lazy"
              >
              <span class="gallery-photo-num"><?= str_pad(array_search($photo, $photos) + 1, 2, '0', STR_PAD_LEFT) ?></span>
            </a>
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>
    </div>

  <?php endif; ?>

</section>


<!-- ═══════════════════════════════════════
     FOOTER
═══════════════════════════════════════ -->
<footer class="gallery-footer">
  &copy; <?= date('Y') ?> LoveLens &mdash; Tous droits réservés
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
<script>
  // Lightbox
  GLightbox({ selector: '.glightbox', loop: true, touchNavigation: true });

  // Animation hero
  requestAnimationFrame(() => {
    setTimeout(() => document.getElementById('heroBg').classList.add('loaded'), 100);
  });
</script>
</body>
</html>