<?php // views/admin/testimonials.php
require_once __DIR__ . '/../layout/header.php'; ?>
 
<h1>💬 Témoignages à modérer</h1>
<table class="table table-hover mt-3">
  <thead class="table-dark">
    <tr>
      <th>Auteur</th><th>Album</th><th>Avis</th><th>Statut</th><th>Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($testimonials as $t): ?>
    <tr>
      <td><?= htmlspecialchars($t['auteur']) ?></td>
      <td><?= htmlspecialchars($t['titre'] ?? '—') ?></td>
      <td><?= htmlspecialchars($t['contenu']) ?></td>
      <td>
        <?= $t['approuve']
            ? '<span class="badge bg-success">Approuvé</span>'
            : '<span class="badge bg-warning">En attente</span>' ?>
      </td>
      <td>
        <?php if (!$t['approuve']): ?>
          <a href="?action=admin_testimonial_approve&id=<?= $t['id'] ?>"
             class="btn btn-sm btn-success">Approuver</a>
        <?php endif; ?>
        <a href="?action=admin_testimonial_delete&id=<?= $t['id'] ?>"
           class="btn btn-sm btn-danger"
           onclick="return confirm('Supprimer ce témoignage ?')">Supprimer</a>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
 
<?php require_once __DIR__ . '/../layout/footer.php'; ?>
