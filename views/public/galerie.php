<?php require_once __DIR__ . '/../layout/header.php'; ?>
<link rel="stylesheet" href="/lovelens1/public/css/home.css">
<style>
  .ll-nav { background: rgba(14,14,14,0.95) !important; backdrop-filter: blur(12px); }
  .ll-nav-logo { color: var(--cream) !important; }
  .ll-nav-links a { color: rgba(253,250,247,0.75) !important; }
  .ll-nav-links a:hover { color: var(--gold-light) !important; }
  .ll-nav-cta { border-color: rgba(184,155,106,0.5) !important; color: var(--gold-light) !important; }
  .ll-nav-burger span { background: var(--cream) !important; }
</style>

<!-- ── HERO ── -->
<section style="position:relative; height:60vh; min-height:420px; display:flex; align-items:flex-end; padding:0 4rem 5rem; overflow:hidden; background:linear-gradient(to top, rgba(0,0,0,0.75) 0%, rgba(0,0,0,0.1) 60%), url('/lovelens1/public/uploads/hero.jpg') center/cover no-repeat; background-color:#111;">
  <div style="opacity:0; transform:translateY(20px); animation: fadeUp 0.9s ease 0.2s forwards;">
    <div style="font-family:var(--font-ui); font-size:0.68rem; letter-spacing:0.3em; text-transform:uppercase; color:var(--gold-light); margin-bottom:0.8rem; display:flex; align-items:center; gap:0.8rem;">
      <span style="width:28px; height:1px; background:var(--gold-light); display:inline-block;"></span>
      Portfolio
    </div>
    <h1 style="font-family:var(--font-display); font-size:clamp(2.5rem,5vw,4.5rem); font-style:italic; font-weight:400; color:white; line-height:1.1; margin:0;">
      Des histoires d'amour<br>gravées dans la lumière
    </h1>
  </div>
</section>

<!-- ── INTRO ── -->
<section style="background:#0E0E0E; padding:5rem 4rem 3rem;">
  <div style="max-width:700px; margin:0 auto; text-align:center;">
    <p style="font-family:var(--font-display); font-size:1.3rem; font-style:italic; color:rgba(253,250,247,0.65); line-height:1.8;">
      Chaque image présentée ici est une promesse tenue — celle d'avoir été là, au bon moment, avec le regard juste.
    </p>
  </div>
</section>

<!-- ── GRILLE ALBUMS ── -->
<section style="background:#0E0E0E; padding:2rem 4rem 8rem;">
  <div style="max-width:1400px; margin:0 auto;">

    <?php if (empty($albums)): ?>
      <div style="padding:5rem 2rem; text-align:center; border:1px dashed rgba(255,255,255,0.1); font-family:var(--font-body); color:rgba(255,255,255,0.3); font-size:1.1rem; font-style:italic;">
        La galerie se remplit bientôt — revenez nous voir.
      </div>
    <?php else: ?>
      <div style="display:flex; flex-wrap:wrap; gap:4px;">
        <?php foreach ($albums as $i => $album):
          // Hauteurs alternées pour l'effet mosaïque
          $heights = [380, 300, 340, 300, 380, 260, 320, 360, 280];
          $h = $heights[$i % count($heights)];
          $flex = ($i % 5 === 0) ? '2 1 500px' : '1 1 280px';
        ?>
          <div style="flex:<?= $flex ?>; height:<?= $h ?>px; overflow:hidden; position:relative; background:#1a1a1a; cursor:pointer;"
               onmouseover="this.querySelector('img').style.transform='scale(1.05)'; this.querySelector('.overlay').style.background='rgba(0,0,0,0.45)'; this.querySelector('.caption').style.opacity='1'; this.querySelector('.caption').style.transform='none';"
               onmouseout="this.querySelector('img').style.transform='scale(1)'; this.querySelector('.overlay').style.background='rgba(0,0,0,0)'; this.querySelector('.caption').style.opacity='0'; this.querySelector('.caption').style.transform='translateY(10px)';">
            <img src="/lovelens1/public/<?= htmlspecialchars($album['image_couverture']) ?>"
                 alt="<?= htmlspecialchars($album['titre']) ?>"
                 style="width:100%; height:100%; object-fit:cover; display:block; transition:transform 0.8s ease; opacity:0.8;">
            <div class="overlay" style="position:absolute; inset:0; background:rgba(0,0,0,0); transition:background 0.4s; pointer-events:none;"></div>
            <div class="caption" style="position:absolute; bottom:0; left:0; right:0; padding:1.5rem; opacity:0; transform:translateY(10px); transition:opacity 0.4s, transform 0.4s; pointer-events:none;">
              <div style="font-family:var(--font-display); font-size:1.2rem; font-style:italic; color:white;"><?= htmlspecialchars($album['titre']) ?></div>
              <?php if (!empty($album['date_mariage'])): ?>
                <div style="font-family:var(--font-ui); font-size:0.62rem; letter-spacing:0.15em; text-transform:uppercase; color:var(--gold-light); margin-top:0.3rem;"><?= htmlspecialchars($album['date_mariage']) ?></div>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

  </div>
</section>

<!-- ── CTA ── -->
<section style="background:#111; padding:6rem 4rem; text-align:center; border-top:1px solid rgba(255,255,255,0.06);">
  <div style="font-family:var(--font-display); font-size:clamp(1.8rem,3.5vw,2.8rem); font-style:italic; color:var(--cream); margin-bottom:1rem;">Votre album vous attend</div>
  <p style="font-family:var(--font-body); font-size:1.1rem; color:rgba(201,196,190,0.5); margin-bottom:2.5rem;">Vous avez reçu un code ? Accédez à vos photos en quelques secondes.</p>
  <a href="?action=client_login" style="font-family:var(--font-ui); font-size:0.75rem; font-weight:500; letter-spacing:0.18em; text-transform:uppercase; padding:1rem 2.8rem; background:var(--gold); color:white; text-decoration:none; display:inline-flex; align-items:center; gap:0.8rem;">
    Accéder à mon album <span>→</span>
  </a>
</section>

<footer style="background:#0a0a0a; color:rgba(253,250,247,0.25); text-align:center; padding:2rem; font-family:var(--font-ui); font-size:0.72rem; letter-spacing:0.12em; text-transform:uppercase;">
  &copy; <?= date('Y') ?> LoveLens &mdash; Tous droits réservés
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
<style>@keyframes fadeUp { to { opacity:1; transform:none; } }</style>
</body></html>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>