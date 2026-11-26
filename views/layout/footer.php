<?php // views/layout/footer.php
$action = $_GET['action'] ?? 'home';
if (strpos($action, 'admin_') === 0): ?>
</div><!-- /container admin -->
<?php endif; ?>

</div><!-- /page-content -->

<!-- ═══════════════════════════════════════
     FOOTER GLOBAL
═══════════════════════════════════════ -->
<footer style="background:#0E0E0E; border-top:1px solid rgba(255,255,255,0.06);">

  <!-- ── Contenu principal ── -->
  <div style="max-width:1400px; margin:0 auto; padding:4rem 4rem 3rem; display:flex; flex-direction:row; justify-content:space-between; align-items:flex-start; flex-wrap:wrap; gap:3rem;">

    <!-- Logo + tagline -->
    <div style="display:flex; flex-direction:column; gap:0.8rem; flex:0 0 auto;">
      <div style="font-family:'Playfair Display',Georgia,serif; font-size:1.8rem; font-style:italic; color:#F7F3EE;">LoveLens</div>
      <div style="font-family:'Jost',sans-serif; font-size:0.7rem; letter-spacing:0.18em; text-transform:uppercase; color:rgba(201,196,190,0.4);">Photographe de mariage · Paris</div>

      <!-- Réseaux sociaux -->
      <div style="display:flex; flex-direction:row; gap:0.8rem; margin-top:0.8rem;">

        <!-- Instagram -->
        <a href="https://instagram.com" target="_blank" rel="noopener"
           style="width:38px; height:38px; border:1px solid rgba(255,255,255,0.1); display:flex; align-items:center; justify-content:center; color:rgba(255,255,255,0.4); transition:all 0.3s; text-decoration:none;"
           onmouseover="this.style.borderColor='#B89B6A'; this.style.color='#B89B6A';"
           onmouseout="this.style.borderColor='rgba(255,255,255,0.1)'; this.style.color='rgba(255,255,255,0.4)';"
           title="Instagram">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
            <circle cx="12" cy="12" r="4"/>
            <circle cx="17.5" cy="6.5" r="0.5" fill="currentColor"/>
          </svg>
        </a>

        <!-- Facebook -->
        <a href="https://facebook.com" target="_blank" rel="noopener"
           style="width:38px; height:38px; border:1px solid rgba(255,255,255,0.1); display:flex; align-items:center; justify-content:center; color:rgba(255,255,255,0.4); transition:all 0.3s; text-decoration:none;"
           onmouseover="this.style.borderColor='#B89B6A'; this.style.color='#B89B6A';"
           onmouseout="this.style.borderColor='rgba(255,255,255,0.1)'; this.style.color='rgba(255,255,255,0.4)';"
           title="Facebook">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
          </svg>
        </a>

        <!-- Pinterest -->
        <a href="https://pinterest.com" target="_blank" rel="noopener"
           style="width:38px; height:38px; border:1px solid rgba(255,255,255,0.1); display:flex; align-items:center; justify-content:center; color:rgba(255,255,255,0.4); transition:all 0.3s; text-decoration:none;"
           onmouseover="this.style.borderColor='#B89B6A'; this.style.color='#B89B6A';"
           onmouseout="this.style.borderColor='rgba(255,255,255,0.1)'; this.style.color='rgba(255,255,255,0.4)';"
           title="Pinterest">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 2C6.48 2 2 6.48 2 12c0 4.24 2.65 7.86 6.39 9.29-.09-.78-.17-1.98.03-2.83.19-.77 1.27-5.38 1.27-5.38s-.32-.65-.32-1.61c0-1.51.88-2.64 1.97-2.64.93 0 1.38.7 1.38 1.54 0 .94-.6 2.34-.91 3.64-.26 1.09.54 1.97 1.6 1.97 1.92 0 3.4-2.02 3.4-4.95 0-2.59-1.86-4.4-4.52-4.4-3.08 0-4.89 2.31-4.89 4.7 0 .93.36 1.93.8 2.47a.32.32 0 0 1 .07.31c-.08.34-.27 1.09-.3 1.24-.05.2-.17.24-.38.15-1.42-.66-2.3-2.75-2.3-4.42 0-3.6 2.61-6.9 7.53-6.9 3.95 0 7.02 2.82 7.02 6.58 0 3.93-2.48 7.09-5.91 7.09-1.15 0-2.24-.6-2.61-1.3l-.71 2.65c-.26.99-.95 2.23-1.41 2.99.76.24 1.56.37 2.39.37 5.52 0 10-4.48 10-10S17.52 2 12 2z"/>
          </svg>
        </a>

      </div>
    </div>

    <!-- Navigation -->
    <div style="display:flex; flex-direction:column; gap:0.7rem;">
      <div style="font-family:'Jost',sans-serif; font-size:0.65rem; letter-spacing:0.25em; text-transform:uppercase; color:#B89B6A; margin-bottom:0.4rem;">Navigation</div>
      <?php
        $nav_links = [
          ['Accueil',         '?action=home'],
          ['Le photographe',  '?action=photographe'],
          ['Galerie',         '?action=galerie'],
          ['Forfaits',        '?action=forfaits'],
          ['Contact',         '?action=contact'],
        ];
        foreach ($nav_links as $l):
      ?>
        <a href="<?= $l[1] ?>" style="font-family:'Cormorant Garamond',Georgia,serif; font-size:1rem; color:rgba(201,196,190,0.55); text-decoration:none; transition:color 0.2s;"
           onmouseover="this.style.color='#F7F3EE'" onmouseout="this.style.color='rgba(201,196,190,0.55)'">
          <?= $l[0] ?>
        </a>
      <?php endforeach; ?>
    </div>

    <!-- Espace client -->
    <div style="display:flex; flex-direction:column; gap:0.7rem;">
      <div style="font-family:'Jost',sans-serif; font-size:0.65rem; letter-spacing:0.25em; text-transform:uppercase; color:#B89B6A; margin-bottom:0.4rem;">Espace client</div>
      <a href="?action=client_login" style="font-family:'Cormorant Garamond',Georgia,serif; font-size:1rem; color:rgba(201,196,190,0.55); text-decoration:none; transition:color 0.2s;"
         onmouseover="this.style.color='#F7F3EE'" onmouseout="this.style.color='rgba(201,196,190,0.55)'">
        Accéder à mon album
      </a>
      <?php if (!empty($_SESSION['client_album_id'])): ?>
        <a href="?action=client_gallery" style="font-family:'Cormorant Garamond',Georgia,serif; font-size:1rem; color:rgba(201,196,190,0.55); text-decoration:none;"
           onmouseover="this.style.color='#F7F3EE'" onmouseout="this.style.color='rgba(201,196,190,0.55)'">
          Ma galerie
        </a>
        <a href="?action=client_logout" style="font-family:'Cormorant Garamond',Georgia,serif; font-size:1rem; color:rgba(201,196,190,0.55); text-decoration:none;"
           onmouseover="this.style.color='#F7F3EE'" onmouseout="this.style.color='rgba(201,196,190,0.55)'">
          Se déconnecter
        </a>
      <?php endif; ?>
    </div>

    <!-- Contact + Admin -->
    <div style="display:flex; flex-direction:column; gap:0.7rem;">
      <div style="font-family:'Jost',sans-serif; font-size:0.65rem; letter-spacing:0.25em; text-transform:uppercase; color:#B89B6A; margin-bottom:0.4rem;">Contact</div>
      <a href="mailto:contact@lovelens.fr" style="font-family:'Cormorant Garamond',Georgia,serif; font-size:1rem; color:rgba(201,196,190,0.55); text-decoration:none;"
         onmouseover="this.style.color='#F7F3EE'" onmouseout="this.style.color='rgba(201,196,190,0.55)'">
        contact@lovelens.fr
      </a>
      <a href="tel:+33612345678" style="font-family:'Cormorant Garamond',Georgia,serif; font-size:1rem; color:rgba(201,196,190,0.55); text-decoration:none;"
         onmouseover="this.style.color='#F7F3EE'" onmouseout="this.style.color='rgba(201,196,190,0.55)'">
        +33 6 12 34 56 78
      </a>
      <span style="font-family:'Cormorant Garamond',Georgia,serif; font-size:1rem; color:rgba(201,196,190,0.55);">Paris &amp; Île-de-France</span>

      <!-- Accès admin discret -->
      <?php if (!empty($_SESSION['admin_id'])): ?>
        <div style="margin-top:1rem; padding-top:1rem; border-top:1px solid rgba(255,255,255,0.06);">
          <a href="?action=admin_albums" style="font-family:'Jost',sans-serif; font-size:0.65rem; letter-spacing:0.14em; text-transform:uppercase; color:#B89B6A; text-decoration:none;">
            ⚙ Admin
          </a>
          &nbsp;&nbsp;
          <a href="?action=admin_logout" style="font-family:'Jost',sans-serif; font-size:0.65rem; letter-spacing:0.14em; text-transform:uppercase; color:rgba(192,57,43,0.7); text-decoration:none;">
            Déconnexion
          </a>
        </div>
      <?php else: ?>
        <div style="margin-top:1rem;">
          <a href="?action=admin_login"
             style="font-family:'Jost',sans-serif; font-size:0.62rem; letter-spacing:0.14em; text-transform:uppercase; color:rgba(255,255,255,0.2); text-decoration:none; transition:color 0.3s;"
             onmouseover="this.style.color='rgba(184,155,106,0.7)'" onmouseout="this.style.color='rgba(255,255,255,0.2)'"
             title="Administration">
            ⚙ Administration
          </a>
        </div>
      <?php endif; ?>
    </div>

  </div>

  <!-- ── Séparateur ── -->
  <div style="border-top:1px solid rgba(255,255,255,0.06); margin:0 4rem;"></div>

  <!-- ── Bas de footer ── -->
  <div style="max-width:1400px; margin:0 auto; padding:1.5rem 4rem; display:flex; flex-direction:row; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:1rem;">

    <span style="font-family:'Jost',sans-serif; font-size:0.65rem; letter-spacing:0.1em; color:rgba(201,196,190,0.25);">
      &copy; <?= date('Y') ?> LoveLens &mdash; Tous droits réservés
    </span>

    <div style="display:flex; flex-direction:row; gap:2rem;">
      <a href="?action=mentions_legales"
         style="font-family:'Jost',sans-serif; font-size:0.65rem; letter-spacing:0.1em; text-transform:uppercase; color:rgba(201,196,190,0.25); text-decoration:none; transition:color 0.2s;"
         onmouseover="this.style.color='rgba(201,196,190,0.6)'" onmouseout="this.style.color='rgba(201,196,190,0.25)'">
        Mentions légales
      </a>
      <a href="?action=mentions_legales"
         style="font-family:'Jost',sans-serif; font-size:0.65rem; letter-spacing:0.1em; text-transform:uppercase; color:rgba(201,196,190,0.25); text-decoration:none; transition:color 0.2s;"
         onmouseover="this.style.color='rgba(201,196,190,0.6)'" onmouseout="this.style.color='rgba(201,196,190,0.25)'">
        Politique de confidentialité
      </a>
    </div>

  </div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
<script>
  if (typeof GLightbox !== 'undefined') {
    GLightbox({ selector: '.glightbox' });
  }
</script>
</body>
</html>