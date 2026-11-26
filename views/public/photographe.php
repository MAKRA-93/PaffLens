<?php require_once __DIR__ . '/../layout/header.php'; ?>
<link rel="stylesheet" href="/lovelens1/public/css/home.css">
<style>
  .ll-nav { background: rgba(253,250,247,0.96) !important; backdrop-filter: blur(12px); box-shadow: 0 1px 0 rgba(0,0,0,0.06); }
  .ll-nav-logo { color: var(--charcoal) !important; }
  .ll-nav-links a { color: var(--mid-gray) !important; }
  .ll-nav-links a:hover { color: var(--gold) !important; }
  .ll-nav-cta { border-color: var(--gold) !important; color: var(--gold-dark) !important; }
  .ll-nav-burger span { background: var(--charcoal) !important; }
</style>

<!-- ── HERO ── -->
<section style="position:relative; height:70vh; min-height:500px; display:flex; align-items:flex-end; padding:0 4rem 5rem; overflow:hidden; background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.1) 60%), url('/lovelens1/public/uploads/hero.jpg') center/cover no-repeat; background-color:#1a1a1a;">
  <div style="opacity:0; transform:translateY(20px); animation: fadeUp 0.9s ease 0.2s forwards;">
    <div style="font-family:var(--font-ui); font-size:0.68rem; letter-spacing:0.3em; text-transform:uppercase; color:var(--gold-light); margin-bottom:0.8rem; display:flex; align-items:center; gap:0.8rem;">
      <span style="width:28px; height:1px; background:var(--gold-light); display:inline-block;"></span>
      Le photographe
    </div>
    <h1 style="font-family:var(--font-display); font-size:clamp(2.5rem,5vw,4.5rem); font-style:italic; font-weight:400; color:white; line-height:1.1; margin:0;">
      L'œil qui capture<br>l'âme des instants
    </h1>
  </div>
</section>

<!-- ── PORTRAIT + BIO ── -->
<section style="background:var(--cream); padding:8rem 4rem;">
  <div style="max-width:1200px; margin:0 auto; display:flex; flex-direction:row; align-items:center; gap:7rem;">

    <div style="flex:0 0 38%; position:relative;">
      <img src="/lovelens1/public/uploads/photographe.jpg" alt="Sophie Martin"
           style="width:100%; aspect-ratio:3/4; object-fit:cover; object-position:center top; display:block; position:relative; z-index:1;">
      <div style="position:absolute; top:1.5rem; left:-1.5rem; right:1.5rem; bottom:-1.5rem; border:1px solid var(--gold-light); z-index:0;"></div>
    </div>

    <div style="flex:1; min-width:0;">
      <div class="section-label">À propos</div>
      <h2 style="font-family:var(--font-display); font-size:clamp(2rem,3.5vw,2.8rem); font-style:italic; color:var(--dark-gray); margin-bottom:2rem; line-height:1.2;">
        Je photographie<br>ce que les mots ne peuvent pas dire
      </h2>
      <p style="font-family:var(--font-body); font-size:1.1rem; color:var(--mid-gray); line-height:1.9; margin-bottom:1.5rem;">
        Je suis Sophie Martin, et depuis 2015 je suis le témoin privilégié de l'un des jours les plus précieux de votre vie. Mon approche est simple : disparaître pour mieux voir. Je ne mets pas en scène — j'observe, j'anticipe, je capture.
      </p>
      <p style="font-family:var(--font-body); font-size:1.1rem; color:var(--mid-gray); line-height:1.9; margin-bottom:2.5rem;">
        Chaque mariage est un univers unique. Les rires nerveux du matin, la larme qui glisse au moment des vœux, l'étreinte qui dure un peu trop longtemps — ce sont ces fragments d'éternité que je m'engage à préserver pour vous.
      </p>
      <div style="font-family:var(--font-display); font-size:1.8rem; font-style:italic; color:var(--gold-dark);">Sophie Martin</div>

      <!-- Stats -->
      <div style="display:flex; gap:3rem; margin-top:2.5rem; padding-top:2.5rem; border-top:1px solid var(--light-gray);">
        <?php foreach ([['320+','Mariages'],['9 ans','D\'expérience'],['4.9/5','Satisfaction']] as $s): ?>
        <div>
          <div style="font-family:var(--font-display); font-size:2.4rem; font-style:italic; color:var(--dark-gray); line-height:1;"><?= $s[0] ?></div>
          <div style="font-family:var(--font-ui); font-size:0.68rem; letter-spacing:0.18em; text-transform:uppercase; color:var(--mid-gray); margin-top:0.3rem;"><?= $s[1] ?></div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

  </div>
</section>

<!-- ── MA PHILOSOPHIE ── -->
<section style="background:var(--charcoal); padding:8rem 4rem;">
  <div style="max-width:1200px; margin:0 auto;">
    <div style="font-family:var(--font-ui); font-size:0.68rem; letter-spacing:0.3em; text-transform:uppercase; color:var(--gold-light); margin-bottom:1rem; display:flex; align-items:center; gap:1rem;">
      <span style="width:24px; height:1px; background:var(--gold-light); display:inline-block;"></span>
      Ma philosophie
    </div>
    <h2 style="font-family:var(--font-display); font-size:clamp(2rem,4vw,3rem); font-style:italic; color:var(--cream); margin-bottom:4rem; line-height:1.2;">Trois engagements<br>pour votre jour J</h2>

    <div style="display:flex; flex-wrap:wrap; gap:2px;">
      <?php
        $engagements = [
          ['01', 'Présence discrète', 'Je m\'intègre naturellement à votre journée. Vos invités m\'oublient, et c\'est exactement ce que je recherche. Les émotions les plus vraies naissent quand personne ne pose.'],
          ['02', 'Regard authentique', 'Pas de poses forcées. Je vous guide avec douceur pour créer des souvenirs qui vous ressemblent, imprégnés de votre personnalité et de votre amour.'],
          ['03', 'Livraison soignée', 'Chaque photo est retouchée avec soin, dans un style naturel et lumineux. Votre galerie privée est disponible en ligne dans les 4 semaines suivant votre mariage.'],
        ];
        foreach ($engagements as $e):
      ?>
      <div style="flex:1 1 300px; padding:3rem 2.5rem; background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.06);">
        <div style="font-family:var(--font-display); font-size:4rem; font-style:italic; color:rgba(184,155,106,0.15); line-height:1; margin-bottom:1.5rem;"><?= $e[0] ?></div>
        <h3 style="font-family:var(--font-display); font-size:1.4rem; font-style:italic; color:var(--cream); margin-bottom:1rem;"><?= $e[1] ?></h3>
        <p style="font-family:var(--font-body); font-size:1rem; color:rgba(201,196,190,0.7); line-height:1.8;"><?= $e[2] ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── TÉMOIGNAGES ── -->
<?php if (!empty($testimonials)): ?>
<section style="background:var(--warm-white); padding:8rem 4rem;">
  <div style="max-width:1200px; margin:0 auto;">
    <div style="font-family:var(--font-ui); font-size:0.68rem; letter-spacing:0.3em; text-transform:uppercase; color:var(--gold); margin-bottom:1rem; display:flex; align-items:center; gap:1rem;">
      <span style="width:24px; height:1px; background:var(--gold); display:inline-block;"></span>
      Témoignages
    </div>
    <h2 style="font-family:var(--font-display); font-size:clamp(2rem,4vw,3rem); font-style:italic; color:var(--dark-gray); margin-bottom:3rem;">Ils me font confiance</h2>
    <div style="display:flex; flex-wrap:wrap; gap:2rem;">
      <?php foreach ($testimonials as $t): ?>
      <div style="flex:1 1 280px; padding:2.5rem; background:var(--cream); border-left:3px solid var(--gold);">
        <p style="font-family:var(--font-display); font-size:1.1rem; font-style:italic; color:var(--dark-gray); line-height:1.8; margin-bottom:1.5rem;">&ldquo;<?= htmlspecialchars($t['contenu']) ?>&rdquo;</p>
        <div style="font-family:var(--font-ui); font-size:0.68rem; letter-spacing:0.16em; text-transform:uppercase; color:var(--gold-dark);">— <?= htmlspecialchars($t['auteur']) ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ── CTA ── -->
<section style="background:var(--cream); padding:7rem 4rem; text-align:center;">
  <div style="font-family:var(--font-display); font-size:clamp(2rem,4vw,3rem); font-style:italic; color:var(--dark-gray); margin-bottom:1rem;">Votre histoire mérite<br>d'être racontée</div>
  <p style="font-family:var(--font-body); font-size:1.1rem; color:var(--mid-gray); margin-bottom:2.5rem; max-width:480px; margin-left:auto; margin-right:auto; line-height:1.8;">Vérifiez mes disponibilités et parlons de votre projet en toute simplicité.</p>
  <a href="?action=contact" style="font-family:var(--font-ui); font-size:0.75rem; font-weight:500; letter-spacing:0.18em; text-transform:uppercase; padding:1rem 2.8rem; background:var(--charcoal); color:var(--cream); text-decoration:none; display:inline-flex; align-items:center; gap:0.8rem;">
    Me contacter <span>→</span>
  </a>
</section>

<footer class="home-footer">&copy; <?= date('Y') ?> LoveLens &mdash; Tous droits réservés</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<style>@keyframes fadeUp { to { opacity:1; transform:none; } }</style>
</body></html>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>