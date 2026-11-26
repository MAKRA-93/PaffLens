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
<section style="position:relative; height:55vh; min-height:400px; display:flex; align-items:flex-end; padding:0 4rem 5rem; overflow:hidden; background:linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.1) 60%), url('/lovelens1/public/uploads/hero.jpg') center 40%/cover no-repeat; background-color:#111;">
  <div style="opacity:0; transform:translateY(20px); animation:fadeUp 0.9s ease 0.2s forwards;">
    <div style="font-family:var(--font-ui); font-size:0.68rem; letter-spacing:0.3em; text-transform:uppercase; color:var(--gold-light); margin-bottom:0.8rem; display:flex; align-items:center; gap:0.8rem;">
      <span style="width:28px; height:1px; background:var(--gold-light); display:inline-block;"></span>
      Contact
    </div>
    <h1 style="font-family:var(--font-display); font-size:clamp(2.5rem,5vw,4.5rem); font-style:italic; font-weight:400; color:white; line-height:1.1; margin:0;">
      Écrivez-moi,<br>parlons de votre mariage
    </h1>
  </div>
</section>

<!-- ── CONTENU PRINCIPAL ── -->
<section style="background:var(--warm-white); padding:7rem 4rem;">
  <div style="max-width:1200px; margin:0 auto; display:flex; flex-direction:row; gap:7rem; flex-wrap:wrap;">

    <!-- Colonne gauche : infos -->
    <div style="flex:0 0 320px; display:flex; flex-direction:column;">
      <div style="font-family:var(--font-ui); font-size:0.68rem; letter-spacing:0.3em; text-transform:uppercase; color:var(--gold); margin-bottom:1rem; display:flex; align-items:center; gap:1rem;">
        <span style="width:24px; height:1px; background:var(--gold); display:inline-block;"></span>
        Restons en contact
      </div>
      <h2 style="font-family:var(--font-display); font-size:clamp(1.8rem,3vw,2.5rem); font-style:italic; color:var(--dark-gray); margin-bottom:1.5rem; line-height:1.2;">Chaque histoire<br>commence par un message</h2>
      <p style="font-family:var(--font-body); font-size:1.05rem; color:var(--mid-gray); line-height:1.9; margin-bottom:2.5rem;">
        Je réponds à chaque message personnellement, sous 48h. N'hésitez pas à me partager votre date, votre lieu et vos envies — c'est ainsi que commence la plus belle des collaborations.
      </p>

      <!-- Coordonnées -->
      <?php
      $coords = [
        ['📧', 'Email', 'contact@lovelens.fr',  'mailto:contact@lovelens.fr'],
        ['📞', 'Téléphone', '+33 6 12 34 56 78', 'tel:+33612345678'],
        ['📍', 'Zone', 'Paris &amp; Île-de-France', null],
      ];
      foreach ($coords as $c):
      ?>
      <div style="display:flex; align-items:flex-start; gap:1rem; margin-bottom:1.5rem;">
        <div style="width:40px; height:40px; border:1px solid var(--light-gray); display:flex; align-items:center; justify-content:center; flex-shrink:0; font-size:1rem;"><?= $c[0] ?></div>
        <div>
          <div style="font-family:var(--font-ui); font-size:0.62rem; letter-spacing:0.18em; text-transform:uppercase; color:var(--light-gray); margin-bottom:0.2rem;"><?= $c[1] ?></div>
          <?php if ($c[3]): ?>
            <a href="<?= $c[3] ?>" style="font-family:var(--font-body); font-size:1rem; color:var(--dark-gray);"><?= $c[2] ?></a>
          <?php else: ?>
            <span style="font-family:var(--font-body); font-size:1rem; color:var(--dark-gray);"><?= $c[2] ?></span>
          <?php endif; ?>
        </div>
      </div>
      <?php endforeach; ?>

      <!-- Citation -->
      <div style="margin-top:auto; padding:2rem; background:var(--cream); border-left:3px solid var(--gold);">
        <p style="font-family:var(--font-display); font-size:1rem; font-style:italic; color:var(--dark-gray); line-height:1.7; margin:0;">&ldquo;Les plus belles photos naissent de la confiance. Prenons le temps de nous connaître.&rdquo;</p>
        <div style="font-family:var(--font-ui); font-size:0.65rem; letter-spacing:0.14em; text-transform:uppercase; color:var(--gold-dark); margin-top:0.8rem;">— Sophie Martin</div>
      </div>
    </div>

    <!-- Colonne droite : formulaire -->
    <div style="flex:1 1 400px; min-width:0;">

      <?php if (!empty($success)): ?>
        <!-- Message de succès -->
        <div style="padding:3rem; background:var(--cream); border:1px solid var(--light-gray); text-align:center;">
          <div style="font-family:var(--font-display); font-size:1.8rem; font-style:italic; color:var(--dark-gray); margin-bottom:0.8rem;">Message envoyé !</div>
          <p style="font-family:var(--font-body); color:var(--mid-gray); margin-bottom:2rem;">Merci pour votre message. Je vous réponds dans les 48h avec toute l'attention que votre projet mérite.</p>
          <a href="?action=contact" style="font-family:var(--font-ui); font-size:0.72rem; font-weight:500; letter-spacing:0.16em; text-transform:uppercase; padding:0.85rem 2rem; background:var(--charcoal); color:var(--cream); text-decoration:none; display:inline-block;">
            Envoyer un autre message
          </a>
        </div>

      <?php else: ?>

        <?php if (!empty($error)): ?>
          <div style="background:#FDF2F2; border-left:3px solid #C0392B; padding:1rem; margin-bottom:1.5rem; font-family:var(--font-ui); font-size:0.8rem; color:#922B21;">
            <?= htmlspecialchars($error) ?>
          </div>
        <?php endif; ?>

        <form method="POST" action="?action=contact" style="display:flex; flex-direction:column; gap:1.4rem;">

          <!-- Nom + Email -->
          <div style="display:flex; gap:1.2rem; flex-wrap:wrap;">
            <div style="flex:1 1 180px; display:flex; flex-direction:column;">
              <label style="font-family:var(--font-ui); font-size:0.65rem; font-weight:500; letter-spacing:0.16em; text-transform:uppercase; color:var(--mid-gray); margin-bottom:0.5rem;">Nom *</label>
              <input type="text" name="nom" required placeholder="Marie & Thomas"
                     style="padding:0.85rem 1rem; font-family:var(--font-body); font-size:1rem; color:var(--charcoal); background:var(--warm-white); border:1px solid var(--light-gray); outline:none; border-radius:0;"
                     onfocus="this.style.borderColor='var(--gold)'" onblur="this.style.borderColor='var(--light-gray)'">
            </div>
            <div style="flex:1 1 180px; display:flex; flex-direction:column;">
              <label style="font-family:var(--font-ui); font-size:0.65rem; font-weight:500; letter-spacing:0.16em; text-transform:uppercase; color:var(--mid-gray); margin-bottom:0.5rem;">Email *</label>
              <input type="email" name="email" required placeholder="marie@email.com"
                     style="padding:0.85rem 1rem; font-family:var(--font-body); font-size:1rem; color:var(--charcoal); background:var(--warm-white); border:1px solid var(--light-gray); outline:none; border-radius:0;"
                     onfocus="this.style.borderColor='var(--gold)'" onblur="this.style.borderColor='var(--light-gray)'">
            </div>
          </div>

          <!-- Date + Lieu -->
          <div style="display:flex; gap:1.2rem; flex-wrap:wrap;">
            <div style="flex:1 1 180px; display:flex; flex-direction:column;">
              <label style="font-family:var(--font-ui); font-size:0.65rem; font-weight:500; letter-spacing:0.16em; text-transform:uppercase; color:var(--mid-gray); margin-bottom:0.5rem;">Date prévue</label>
              <input type="date" name="date" min="<?= date('Y-m-d') ?>"
                     style="padding:0.85rem 1rem; font-family:var(--font-body); font-size:1rem; color:var(--charcoal); background:var(--warm-white); border:1px solid var(--light-gray); outline:none; border-radius:0;"
                     onfocus="this.style.borderColor='var(--gold)'" onblur="this.style.borderColor='var(--light-gray)'">
            </div>
            <div style="flex:1 1 180px; display:flex; flex-direction:column;">
              <label style="font-family:var(--font-ui); font-size:0.65rem; font-weight:500; letter-spacing:0.16em; text-transform:uppercase; color:var(--mid-gray); margin-bottom:0.5rem;">Lieu envisagé</label>
              <input type="text" name="lieu" placeholder="Paris, Versailles..."
                     style="padding:0.85rem 1rem; font-family:var(--font-body); font-size:1rem; color:var(--charcoal); background:var(--warm-white); border:1px solid var(--light-gray); outline:none; border-radius:0;"
                     onfocus="this.style.borderColor='var(--gold)'" onblur="this.style.borderColor='var(--light-gray)'">
            </div>
          </div>

          <!-- Message -->
          <div style="display:flex; flex-direction:column;">
            <label style="font-family:var(--font-ui); font-size:0.65rem; font-weight:500; letter-spacing:0.16em; text-transform:uppercase; color:var(--mid-gray); margin-bottom:0.5rem;">Votre message *</label>
            <textarea name="message" required rows="5" placeholder="Parlez-moi de votre projet, de votre vision, de vos envies..."
                      style="padding:0.85rem 1rem; font-family:var(--font-body); font-size:1rem; color:var(--charcoal); background:var(--warm-white); border:1px solid var(--light-gray); outline:none; resize:vertical; border-radius:0; line-height:1.7;"
                      onfocus="this.style.borderColor='var(--gold)'" onblur="this.style.borderColor='var(--light-gray)'"></textarea>
          </div>

          <button type="submit"
                  style="padding:1rem 2.8rem; font-family:var(--font-ui); font-size:0.75rem; font-weight:500; letter-spacing:0.18em; text-transform:uppercase; background:var(--charcoal); color:var(--cream); border:none; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:0.8rem; transition:background 0.2s; border-radius:0;"
                  onmouseover="this.style.background='var(--gold)'"
                  onmouseout="this.style.background='var(--charcoal)'">
            Envoyer mon message <span>→</span>
          </button>

          <p style="font-family:var(--font-ui); font-size:0.65rem; color:var(--light-gray); letter-spacing:0.04em;">* Champs obligatoires — Réponse sous 48h</p>
        </form>

      <?php endif; ?>
    </div>

  </div>
</section>

<footer class="home-footer">&copy; <?= date('Y') ?> LoveLens &mdash; Tous droits réservés</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<style>@keyframes fadeUp { to { opacity:1; transform:none; } }</style>
</body></html>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>