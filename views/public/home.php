<?php require_once __DIR__ . '/../layout/header.php'; ?>

<!-- CSS spécifique à la home -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;1,400&family=Cormorant+Garamond:wght@300;400&family=Jost:wght@300;400;500&display=swap">
<link rel="stylesheet" href="/lovelens1/public/css/home.css">

<div class="home-page-wrapper">

<!-- ═══════════════════════════════════════
     SECTION 1 : HERO
═══════════════════════════════════════ -->
<section class="hero" id="hero">
  <div class="hero-bg"></div>

  <div class="hero-content">
    <div class="hero-eyebrow">Photographe de mariage</div>
    <h1 class="hero-title">L'amour capturé<br>pour l'éternité</h1>
    <p class="hero-subtitle">
      Des instants précieux immortalisés avec sensibilité,<br>
      pour que chaque souvenir reste vivant.
    </p>
    <div class="hero-actions">
      <a href="#portfolio" class="btn-primary">Voir le portfolio</a>
      <a href="#contact" class="btn-outline">Me contacter</a>
    </div>
  </div>

  <div class="hero-scroll" aria-hidden="true">
    <div class="hero-scroll-line"></div>
    <span>Découvrir</span>
  </div>
</section>


<!-- ═══════════════════════════════════════
     SECTION 2 : À PROPOS
═══════════════════════════════════════ -->
<section class="section about" id="about">
  <div class="about-inner">

    <div class="about-image-wrapper reveal">
      <img
        src="/lovelens1/public/uploads/photographe.jpg"
        alt="Sophie Martin, photographe"
      >
    </div>

    <div class="about-text reveal">
      <div class="section-label">À propos</div>
      <h2 class="section-title">Chaque mariage<br>raconte une histoire</h2>
      <p>
        Je suis Sophie, photographe de mariage depuis 2015. Ma philosophie est simple :
        être présente sans être intrusive, pour capturer les émotions authentiques,
        les regards complices, les rires spontanés.
      </p>
      <p>
        Mon approche mêle photographie documentaire et portraits soignés,
        pour vous offrir un album qui vous ressemble vraiment.
      </p>
      <div class="about-signature">Sophie Martin</div>
      <div class="about-stats">
        <div class="stat">
          <div class="stat-number">320+</div>
          <div class="stat-label">Mariages</div>
        </div>
        <div class="stat">
          <div class="stat-number">9 ans</div>
          <div class="stat-label">D'expérience</div>
        </div>
        <div class="stat">
          <div class="stat-number">4.9/5</div>
          <div class="stat-label">Satisfaction</div>
        </div>
      </div>
    </div>

  </div>
</section>


<!-- ═══════════════════════════════════════
     SECTION 3 : PORTFOLIO
═══════════════════════════════════════ -->
<section class="section portfolio" id="portfolio">
  <div class="portfolio-inner">

    <div class="portfolio-header reveal">
      <div>
        <div class="section-label">Portfolio</div>
        <h2 class="section-title">Quelques instants choisis</h2>
      </div>
    </div>

    <?php if (empty($albums)): ?>
      <div class="portfolio-empty">
        Aucune réalisation pour le moment — revenez bientôt.
      </div>
    <?php else: ?>
      <div class="portfolio-grid">
        <?php foreach ($albums as $album): ?>
          <div class="photo-item">
            <img
              src="/lovelens1/public/<?= htmlspecialchars($album['image_couverture']) ?>"
              alt="<?= htmlspecialchars($album['titre']) ?>"
            >
            <div class="photo-overlay">
              <div class="photo-overlay-icon"></div>
            </div>
            <div class="photo-item-caption">
              <div class="photo-item-title"><?= htmlspecialchars($album['titre']) ?></div>
              <?php if (!empty($album['date_mariage'])): ?>
                <div class="photo-item-date"><?= htmlspecialchars($album['date_mariage']) ?></div>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

  </div>
</section>


<!-- ═══════════════════════════════════════
     SECTION 4 : PRESTATIONS
═══════════════════════════════════════ -->
<section class="section services" id="services">
  <div class="services-inner">

    <div class="reveal">
      <div class="section-label">Prestations</div>
      <h2 class="section-title">Formules sur mesure</h2>
    </div>

    <div class="services-grid">
      <div class="service-card reveal">
        <div class="service-number">01</div>
        <h3 class="service-title">Essentielle</h3>
        <p class="service-desc">
          Couverture de la cérémonie et cocktail.
          200 photos retouchées livrées en galerie privée en ligne.
        </p>
        <div class="service-price">À partir de 390 €</div>
      </div>
      <div class="service-card reveal">
        <div class="service-number">02</div>
        <h3 class="service-title">Premium</h3>
        <p class="service-desc">
          De la préparation à la soirée.
          Photos illimitées + album imprimé livré chez vous.
        </p>
        <div class="service-price">À partir de 1 290 €</div>
      </div>
      <div class="service-card reveal">
        <div class="service-number">03</div>
        <h3 class="service-title">Prestige</h3>
        <p class="service-desc">
          Deux photographes, séance engagement offerte.
          Album premium + galerie privée à vie.
        </p>
        <div class="service-price">À partir de 2 590 €</div>
      </div>
    </div>

  </div>
</section>


<!-- ═══════════════════════════════════════
     SECTION 5 : TÉMOIGNAGES
═══════════════════════════════════════ -->
<?php if (!empty($testimonials)): ?>
<section class="testimonials-section">
  <div class="container-xl">
    <div class="section-label">Témoignages</div>
    <h2 class="section-title">Ce qu'ils disent<br>de nous</h2>
    <div class="testimonials-grid">
      <?php foreach ($testimonials as $t): ?>
        <div class="testimonial-card">
          <div class="testimonial-quote-mark">&ldquo;</div>
          <p class="testimonial-text"><?= htmlspecialchars($t['contenu']) ?></p>
          <div class="testimonial-author">— <?= htmlspecialchars($t['auteur']) ?></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php else: ?>
<section class="testimonial reveal">
  <blockquote class="testimonial-quote">
    Sophie a su capter l'essence même de notre journée. Chaque photo transpire l'émotion,
    comme si elle avait photographié nos cœurs.
  </blockquote>
  <cite class="testimonial-author-static">Clara &amp; Thomas — Mariés en juin 2024</cite>
</section>
<?php endif; ?>


<!-- ═══════════════════════════════════════
     SECTION 6 : CONTACT / CTA
═══════════════════════════════════════ -->
<section class="section" id="contact" style="background: var(--cream);">
  <div class="cta-inner reveal">
    <div class="section-label" style="justify-content:center;">Contact</div>
    <h2 class="cta-title">Parlons de votre mariage</h2>
    <p class="cta-text">
      Chaque projet est unique. Contactez-moi pour vérifier ma disponibilité
      et discuter de vos envies.
    </p>
    <div style="display:flex; gap:1rem; flex-wrap:wrap; justify-content:center;">
      <a href="?action=client_login" class="btn-dark-custom">Accéder à mon album</a>
      <a href="mailto:contact@lovelens.fr" class="btn-gold">Envoyer un message</a>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════
     FOOTER
═══════════════════════════════════════ -->
<footer class="home-footer">
  &copy; <?= date('Y') ?> LoveLens &mdash; Tous droits réservés
</footer>

</div><!-- /home-page-wrapper -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
<script>
  GLightbox({ selector: '.glightbox' });

  // Reveal au scroll
  const reveals = document.querySelectorAll('.reveal');
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.classList.add('visible');
        observer.unobserve(e.target);
      }
    });
  }, { threshold: 0.1 });
  reveals.forEach(el => observer.observe(el));

  // Hero loaded
  document.querySelector('.hero')?.classList.add('loaded');
</script>
</body>
</html>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>