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
<section style="position:relative; height:55vh; min-height:400px; display:flex; align-items:flex-end; padding:0 4rem 5rem; overflow:hidden; background:linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.15) 60%), url('/lovelens1/public/uploads/hero.jpg') center 30%/cover no-repeat; background-color:#111;">
  <div style="opacity:0; transform:translateY(20px); animation:fadeUp 0.9s ease 0.2s forwards;">
    <div style="font-family:var(--font-ui); font-size:0.68rem; letter-spacing:0.3em; text-transform:uppercase; color:var(--gold-light); margin-bottom:0.8rem; display:flex; align-items:center; gap:0.8rem;">
      <span style="width:28px; height:1px; background:var(--gold-light); display:inline-block;"></span>
      Tarifs
    </div>
    <h1 style="font-family:var(--font-display); font-size:clamp(2.5rem,5vw,4.5rem); font-style:italic; font-weight:400; color:white; line-height:1.1; margin:0;">
      Trois façons d'immortaliser<br>votre plus beau jour
    </h1>
  </div>
</section>

<!-- ── INTRO ── -->
<section style="background:var(--warm-white); padding:6rem 4rem 4rem;">
  <div style="max-width:680px; margin:0 auto; text-align:center;">
    <div style="font-family:var(--font-ui); font-size:0.68rem; letter-spacing:0.3em; text-transform:uppercase; color:var(--gold); margin-bottom:1rem; display:flex; align-items:center; justify-content:center; gap:1rem;">
      <span style="width:24px; height:1px; background:var(--gold); display:inline-block;"></span>
      Nos formules
    </div>
    <h2 style="font-family:var(--font-display); font-size:clamp(1.8rem,3.5vw,2.8rem); font-style:italic; color:var(--dark-gray); margin-bottom:1.2rem;">Une promesse sur mesure</h2>
    <p style="font-family:var(--font-body); font-size:1.1rem; color:var(--mid-gray); line-height:1.9;">Chaque couple est unique. C'est pourquoi nos formules s'adaptent à votre vision, votre lieu et votre budget — sans jamais sacrifier la qualité.</p>
  </div>
</section>

<!-- ── FORFAITS ── -->
<section style="background:var(--warm-white); padding:2rem 4rem 7rem;">
  <div style="max-width:1200px; margin:0 auto; display:flex; flex-wrap:wrap; gap:2rem; align-items:stretch;">

    <?php
    $forfaits = [
      [
        'num'    => '01',
        'nom'    => 'Essentielle',
        'prix'   => '390',
        'desc'   => 'Pour la cérémonie civile et une séance couple dans un parc parisien. La quintessence de votre union, capturée avec élégance.',
        'items'  => ['1 photographe','Cérémonie civile (mairie)','Séance couple en extérieur','Photos illimitées + retouches','Galerie privée en ligne 3 mois'],
        'star'   => false,
      ],
      [
        'num'    => '02',
        'nom'    => 'Premium',
        'prix'   => '1 290',
        'desc'   => 'De vos préparatifs jusqu\'à l\'ouverture du bal. Une journée entière racontée avec sensibilité et précision.',
        'items'  => ['1 photographe','Préparatifs mariés (Mme & M.)','Cérémonie + cocktail + repas','Jusqu\'à l\'ouverture de bal','Photos illimitées + retouches','Galerie privée 6 mois','Clé USB offerte','Livre photo 30 photos'],
        'star'   => true,
      ],
      [
        'num'    => '03',
        'nom'    => 'Prestige',
        'prix'   => '2 590',
        'desc'   => 'Deux photographes, deux regards, une couverture totale. Pour ne manquer aucun moment de votre histoire.',
        'items'  => ['2 photographes + chef d\'équipe','Couverture totale de la journée','Studio photo sur place','Impressions distribuées le jour J','Photos illimitées + retouches','Galerie privée à vie','2 clés USB offertes','Coffret livre prestige 100 photos'],
        'star'   => false,
      ],
    ];
    foreach ($forfaits as $f):
      $bg     = $f['star'] ? 'var(--charcoal)' : 'white';
      $border = $f['star'] ? 'var(--charcoal)' : 'var(--light-gray)';
      $numCol = $f['star'] ? 'rgba(184,155,106,0.15)' : 'rgba(184,155,106,0.1)';
      $titleC = $f['star'] ? 'var(--cream)' : 'var(--dark-gray)';
      $descC  = $f['star'] ? 'rgba(201,196,190,0.65)' : 'var(--mid-gray)';
      $itemC  = $f['star'] ? 'rgba(201,196,190,0.8)' : 'var(--mid-gray)';
      $checkC = $f['star'] ? 'var(--gold-light)' : 'var(--gold)';
      $scale  = $f['star'] ? 'scale(1.03)' : 'scale(1)';
    ?>
    <div style="flex:1 1 300px; background:<?= $bg ?>; border:1px solid <?= $border ?>; padding:3rem 2.5rem; display:flex; flex-direction:column; transform:<?= $scale ?>; position:relative;">
      <?php if ($f['star']): ?>
        <div style="position:absolute; top:-14px; left:50%; transform:translateX(-50%); background:var(--gold); color:white; font-family:var(--font-ui); font-size:0.62rem; font-weight:500; letter-spacing:0.2em; text-transform:uppercase; padding:0.35rem 1.2rem; white-space:nowrap;">Le plus choisi</div>
      <?php endif; ?>

      <!-- En-tête -->
      <div style="border-bottom:1px solid <?= $f['star'] ? 'rgba(255,255,255,0.1)' : 'var(--light-gray)' ?>; padding-bottom:1.8rem; margin-bottom:1.8rem;">
        <div style="font-family:var(--font-ui); font-size:0.7rem; font-weight:500; letter-spacing:0.22em; text-transform:uppercase; color:<?= $f['star'] ? 'var(--gold-light)' : 'var(--gold)' ?>; margin-bottom:0.8rem;">Formule <?= $f['num'] ?></div>
        <div style="display:flex; align-items:baseline; gap:0.3rem;">
          <span style="font-family:var(--font-display); font-size:1.4rem; font-style:italic; color:<?= $f['star'] ? 'rgba(253,250,247,0.5)' : 'var(--mid-gray)' ?>;">€</span>
          <span style="font-family:var(--font-display); font-size:3.2rem; font-style:italic; color:<?= $titleC ?>; line-height:1;"><?= $f['prix'] ?></span>
        </div>
        <div style="font-family:var(--font-display); font-size:1.5rem; font-style:italic; color:<?= $titleC ?>; margin-top:0.8rem;"><?= $f['nom'] ?></div>
        <p style="font-family:var(--font-body); font-size:0.95rem; color:<?= $descC ?>; line-height:1.7; margin-top:0.5rem;"><?= $f['desc'] ?></p>
      </div>

      <!-- Inclus -->
      <ul style="list-style:none; padding:0; margin:0 0 2.5rem; flex:1; display:flex; flex-direction:column; gap:0.75rem;">
        <?php foreach ($f['items'] as $item): ?>
          <li style="display:flex; align-items:flex-start; gap:0.75rem; font-family:var(--font-body); font-size:1rem; color:<?= $itemC ?>; line-height:1.5;">
            <span style="flex-shrink:0; width:16px; height:16px; margin-top:3px; display:flex; align-items:center; justify-content:center;">
              <span style="display:block; width:8px; height:5px; border-left:1.5px solid <?= $checkC ?>; border-bottom:1.5px solid <?= $checkC ?>; transform:rotate(-45deg) translateY(-1px);"></span>
            </span>
            <?= htmlspecialchars($item) ?>
          </li>
        <?php endforeach; ?>
      </ul>

      <!-- CTA -->
      <a href="?action=contact"
         style="font-family:var(--font-ui); font-size:0.72rem; font-weight:500; letter-spacing:0.18em; text-transform:uppercase; padding:0.9rem 1.5rem; text-align:center; text-decoration:none; display:block; <?= $f['star'] ? 'background:var(--gold); color:white;' : 'border:1px solid var(--charcoal); color:var(--charcoal);' ?> transition:all 0.3s;"
         onmouseover="<?= $f['star'] ? 'this.style.background=\'var(--gold-dark)\'' : 'this.style.background=\'var(--charcoal)\'; this.style.color=\'var(--cream)\'' ?>"
         onmouseout="<?= $f['star'] ? 'this.style.background=\'var(--gold)\'' : 'this.style.background=\'transparent\'; this.style.color=\'var(--charcoal)\'' ?>"
      >
        Demander un devis
      </a>
    </div>
    <?php endforeach; ?>

  </div>
</section>

<!-- ── OPTIONS ── -->
<section style="background:var(--cream); padding:6rem 4rem;">
  <div style="max-width:1200px; margin:0 auto;">
    <div style="font-family:var(--font-ui); font-size:0.68rem; letter-spacing:0.3em; text-transform:uppercase; color:var(--gold); margin-bottom:1rem; display:flex; align-items:center; gap:1rem;">
      <span style="width:24px; height:1px; background:var(--gold); display:inline-block;"></span>
      En supplément
    </div>
    <h2 style="font-family:var(--font-display); font-size:clamp(1.8rem,3vw,2.5rem); font-style:italic; color:var(--dark-gray); margin-bottom:3rem;">Options à la carte</h2>

    <div style="display:flex; flex-wrap:wrap; gap:1.5rem;">
      <?php
      $options = [
        ['200 €',     'Drone',                    'Vue aérienne de votre lieu de réception pour des clichés uniques et époustouflants.'],
        ['99 €',      'Livre photo supplémentaire','Album A4 de 50 photos, relié et imprimé en qualité premium.'],
        ['Sur devis', 'Séance engagement',         'Une séance photo en amoureux avant le mariage, pour apprivoiser l\'objectif.'],
      ];
      foreach ($options as $o):
      ?>
      <div style="flex:1 1 280px; display:flex; gap:1.2rem; padding:1.5rem; background:white; border:1px solid var(--light-gray);">
        <div style="font-family:var(--font-display); font-size:1.4rem; font-style:italic; color:var(--gold-dark); flex-shrink:0; min-width:85px;"><?= $o[0] ?></div>
        <div>
          <div style="font-family:var(--font-ui); font-size:0.72rem; font-weight:500; letter-spacing:0.14em; text-transform:uppercase; color:var(--dark-gray); margin-bottom:0.4rem;"><?= $o[1] ?></div>
          <p style="font-family:var(--font-body); font-size:0.95rem; color:var(--mid-gray); line-height:1.6; margin:0;"><?= $o[2] ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── FAQ ── -->
<section style="background:var(--warm-white); padding:6rem 4rem;">
  <div style="max-width:800px; margin:0 auto;">
    <div style="font-family:var(--font-ui); font-size:0.68rem; letter-spacing:0.3em; text-transform:uppercase; color:var(--gold); margin-bottom:1rem; display:flex; align-items:center; gap:1rem;">
      <span style="width:24px; height:1px; background:var(--gold); display:inline-block;"></span>
      Questions fréquentes
    </div>
    <h2 style="font-family:var(--font-display); font-size:clamp(1.8rem,3vw,2.5rem); font-style:italic; color:var(--dark-gray); margin-bottom:3rem;">Tout ce que vous voulez savoir</h2>

    <?php
    $faqs = [
      ['Quand recevrons-nous nos photos ?', 'Votre galerie privée est disponible dans les 4 semaines suivant votre mariage. Je prends le temps de retoucher chaque image avec soin, une par une.'],
      ['Combien de photos allons-nous recevoir ?', 'Je ne fixe pas de limite. Vous recevrez toutes les photos de qualité de votre journée, généralement entre 400 et 800 images selon la formule et la durée.'],
      ['Voyagez-vous pour des mariages en dehors de Paris ?', 'Oui, avec plaisir ! Pour les mariages en Île-de-France, aucun frais supplémentaire. Au-delà, les frais de déplacement sont discutés ensemble lors du devis.'],
      ['Comment sécurisez-vous nos photos ?', 'Vos photos sont sauvegardées sur plusieurs supports dès le soir de votre mariage. Votre galerie privée reste accessible en ligne pendant toute la durée de votre formule.'],
    ];
    foreach ($faqs as $i => $faq):
    ?>
    <div style="border-bottom:1px solid var(--light-gray); padding:1.8rem 0;">
      <div style="font-family:var(--font-display); font-size:1.15rem; font-style:italic; color:var(--dark-gray); margin-bottom:0.8rem; cursor:pointer;"><?= $faq[0] ?></div>
      <p style="font-family:var(--font-body); font-size:1rem; color:var(--mid-gray); line-height:1.8; margin:0;"><?= $faq[1] ?></p>
    </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- ── CTA ── -->
<section style="background:var(--charcoal); padding:7rem 4rem; text-align:center;">
  <div style="font-family:var(--font-display); font-size:clamp(1.8rem,3.5vw,2.8rem); font-style:italic; color:var(--cream); margin-bottom:1rem;">Votre mariage mérite le meilleur</div>
  <p style="font-family:var(--font-body); font-size:1.1rem; color:rgba(201,196,190,0.55); margin-bottom:2.5rem; max-width:480px; margin-left:auto; margin-right:auto;">Contactez-moi pour vérifier mes disponibilités et obtenir un devis personnalisé.</p>
  <a href="?action=contact" style="font-family:var(--font-ui); font-size:0.75rem; font-weight:500; letter-spacing:0.18em; text-transform:uppercase; padding:1rem 2.8rem; background:var(--gold); color:white; text-decoration:none; display:inline-flex; align-items:center; gap:0.8rem;">
    Nous contacter <span>→</span>
  </a>
</section>

<footer style="background:var(--charcoal); border-top:1px solid rgba(255,255,255,0.05); color:rgba(253,250,247,0.25); text-align:center; padding:2rem; font-family:var(--font-ui); font-size:0.72rem; letter-spacing:0.12em; text-transform:uppercase;">
  &copy; <?= date('Y') ?> LoveLens &mdash; Tous droits réservés
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<style>@keyframes fadeUp { to { opacity:1; transform:none; } }</style>
</body></html>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>