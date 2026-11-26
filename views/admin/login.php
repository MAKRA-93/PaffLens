<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="row justify-content-center">
  <div class="col-md-4">
    <div class="card shadow">
      <div class="card-body p-4">

        <h2 class="card-title text-center mb-4">
          🔐 Administration
        </h2>

        <form method="POST" action="?action=admin_auth">

          <div class="mb-3">
            <label for="login" class="form-label">Login</label>
            <input type="text"
                   class="form-control"
                   id="login"
                   name="login"
                   placeholder="admin"
                   required autofocus>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password"
                   class="form-control"
                   id="password"
                   name="password"
                   placeholder="••••••••"
                   required>
          </div>

          <button type="submit" class="btn btn-dark w-100">
            Se connecter
          </button>

        </form>

      </div>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>