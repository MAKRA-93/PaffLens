<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-3">
  <h1>📷 Photos — <?= htmlspecialchars($album['titre']) ?></h1>
  <a href="?action=admin_albums" class="btn btn-outline-secondary">← Albums</a>
</div>

<!-- Formulaire d'upload multiple -->
<div class="card mb-4">
  <div class="card-body">
    <h5 class="card-title">Ajouter des photos</h5>
    <form method="POST" action="?action=admin_photo_upload"
          enctype="multipart/form-data">
      <input type="hidden" name="album_id" value="<?= $album['id'] ?>">
      <div class="mb-3">
        <input type="file" class="form-control" name="photos[]"
               accept="image/jpeg,image/png,image/webp" multiple required>
        <small class="text-muted">JPG, PNG, WebP — Max 10 Mo par photo</small>
      </div>
      <button type="submit" class="btn btn-success">Uploader les photos</button>
    </form>
  </div>
</div>

<!-- Grille des photos -->
<div class="row row-cols-2 row-cols-md-4 g-3">
<?php foreach ($photos as $photo): ?>
  <div class="col">
    <div class="card h-100 <?= $photo['is_cover'] ? 'border-warning border-2' : '' ?>">

      <a href="/lovelens1/public/<?= htmlspecialchars($photo['chemin_fichier']) ?>"
         class="glightbox">
        <img src="/lovelens1/public/<?= htmlspecialchars($photo['chemin_fichier']) ?>"
             class="card-img-top"
             style="height:160px; object-fit:cover"
             alt="photo">
      </a>

      <div class="card-footer p-1 text-center">
        <?php if ($photo['is_cover']): ?>
          <span class="badge bg-warning text-dark">⭐ Couverture</span>
        <?php else: ?>
          <a href="?action=admin_photo_cover&photo_id=<?= $photo['id'] ?>&album_id=<?= $album['id'] ?>"
             class="btn btn-outline-warning btn-sm">Couverture</a>
        <?php endif; ?>
        <a href="?action=admin_photo_delete&id=<?= $photo['id'] ?>&album_id=<?= $album['id'] ?>"
           class="btn btn-outline-danger btn-sm"
           onclick="return confirm('Supprimer cette photo ?')">🗑</a>
      </div>

    </div>
  </div>
<?php endforeach; ?>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>

<?php /* Modifier la vue views/admin/photos.php pour afficher le compteur dans le titre. Exemple de rendu attendu : "📷 Photos — Mariage de Alice et Bob (12 photos)". Gérer le pluriel : '1 photo' sans s, '2 photos' avec s. */ ?>

<h1>📷 Photos — <?= htmlspecialchars($album['titre']) ?> (<?= $nbPhotos ?> <?= $nbPhotos === 1 ? 'photo' : 'photos' ?>)</h1>
