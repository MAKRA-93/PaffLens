<?php // views/admin/album_form.php
require_once __DIR__ . '/../layout/header.php';
 
// Déterminer si on crée ou modifie
$isEdit  = isset($album);
$formUrl = $isEdit
    ? '?action=admin_album_edit&id=' . $album['id']
    : '?action=admin_album_create';
?>
 
<div class="row justify-content-center">
  <div class="col-md-7">
    <h1><?= $isEdit ? 'Modifier' : 'Créer' ?> un Album</h1>
 
    <form method="POST" action="<?= $formUrl ?>">
      <div class="mb-3">
        <label class="form-label">Titre *</label>
        <input type="text" class="form-control" name="titre"
               value="<?= htmlspecialchars($album['titre'] ?? '') ?>" required>
      </div>
 
      <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea class="form-control" name="description"
                  rows="3"><?= htmlspecialchars($album['description'] ?? '') ?></textarea>
      </div>
 
      <div class="mb-3">
        <label class="form-label">Date du Mariage</label>
        <input type="date" class="form-control" name="date_mariage"
               value="<?= $album['date_mariage'] ?? '' ?>">
      </div>
 
      <?php if (!$isEdit): ?>
        <div class="mb-3">
          <label class="form-label">Code Client</label>
          <input type="text" class="form-control" name="code_client"
                 placeholder="Laisser vide pour génération automatique">
          <small class="text-muted">Le code est généré automatiquement si vide.</small>
        </div>
      <?php endif; ?>
 
      <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="?action=admin_albums" class="btn btn-secondary">Annuler</a>
      </div>
    </form>
  </div>
</div>
 
<?php require_once __DIR__ . '/../layout/footer.php'; ?>
