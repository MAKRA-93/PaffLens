<?php // views/admin/albums.php
require_once __DIR__ . '/../layout/header.php'; ?>

<div class="admin-page">
<div class="container-xl">

  <!-- En-tête -->
  <div class="admin-header">
    <div>
      <h1>Gestion des Albums</h1>
      <div class="admin-header-sub"><?= count($albums) ?> album<?= count($albums) > 1 ? 's' : '' ?> au total</div>
    </div>
    <a href="?action=admin_album_create" class="btn-new-album">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
      </svg>
      Nouvel Album
    </a>
  </div>

  <!-- Grille albums -->
  <div class="albums-grid">

    <?php if (empty($albums)): ?>
      <div class="albums-empty">Aucun album pour le moment — créez le premier !</div>
    <?php else: ?>
      <?php foreach ($albums as $album): ?>
        <div class="album-card">

          <!-- Image couverture -->
          <?php if (!empty($album['image_couverture'])): ?>
            <img
              src="/lovelens1/public/<?= htmlspecialchars($album['image_couverture']) ?>"
              alt="<?= htmlspecialchars($album['titre']) ?>"
              class="album-card-cover"
            >
          <?php else: ?>
            <div class="album-card-cover-placeholder">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/>
                <polyline points="21 15 16 10 5 21"/>
              </svg>
              Pas de couverture
            </div>
          <?php endif; ?>

          <!-- Corps -->
          <div class="album-card-body">

            <div class="album-card-title"><?= htmlspecialchars($album['titre']) ?></div>

            <div class="album-card-meta">
              <?php if (!empty($album['date_mariage'])): ?>
                <div class="album-card-meta-item">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                  </svg>
                  <?= htmlspecialchars($album['date_mariage']) ?>
                </div>
              <?php endif; ?>
            </div>

            <!-- Code client copiable -->
            <div
              class="album-card-code"
              onclick="copyCode('<?= htmlspecialchars($album['code_client']) ?>', this)"
              title="Cliquer pour copier"
            >
              <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/>
              </svg>
              <?= htmlspecialchars($album['code_client']) ?>
              <span class="album-card-code-copied">Copié !</span>
            </div>

            <!-- Actions -->
            <div class="album-card-actions">
              <a href="?action=admin_photos&album_id=<?= $album['id'] ?>" class="btn-action btn-action-photos">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/>
                </svg>
                Photos
              </a>
              <a href="?action=admin_album_edit&id=<?= $album['id'] ?>" class="btn-action btn-action-edit">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>
                Modifier
              </a>
              <a href="?action=admin_album_delete&id=<?= $album['id'] ?>"
                 class="btn-action btn-action-delete"
                 onclick="return confirm('Supprimer « <?= htmlspecialchars($album['titre']) ?> » et toutes ses photos ?')"
                 title="Supprimer">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/>
                </svg>
              </a>
            </div>

          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>

  </div>

</div>
</div>

<script>
function copyCode(code, el) {
  navigator.clipboard.writeText(code).then(() => {
    const span = el.querySelector('.album-card-code-copied');
    span.style.display = 'inline';
    setTimeout(() => span.style.display = 'none', 2000);
  });
}
</script>

 // GetNbphotos : retourne le nombre de photos dans un album donné
 
 
<?php foreach ($albums as $album): ?>
  <?php $nbPhotos = $this->getNbPhotos($album['id']); ?>
  <div class="album-card">
    <div class="album-card-body">
      <div class="album-card-title"><?= htmlspecialchars($album['titre']) ?></div>
      <div class="album-card-meta">
        <div class="album-card-meta-item">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="3" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
          </svg>
          <?= $nbPhotos ?> photo<?= $nbPhotos > 1 ? 's' : '' ?>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?> 


<?php require_once __DIR__ . '/../layout/footer.php'; ?>