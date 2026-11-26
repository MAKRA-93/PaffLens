<?php // views/public/login_client.php
require_once __DIR__ . '/../layout/header.php'; ?>

<style>
  /* Navbar forcée sombre sur fond noir */
  .ll-nav { background: rgba(14,14,14,0.95) !important; backdrop-filter: blur(12px); }
  .ll-nav-logo { color: var(--cream) !important; }
  .ll-nav-links a { color: rgba(253,250,247,0.75) !important; }
  .ll-nav-links a:hover { color: var(--gold-light) !important; }
  .ll-nav-cta { border-color: rgba(184,155,106,0.5) !important; color: var(--gold-light) !important; }
  .ll-nav-burger span { background: var(--cream) !important; }
</style>

<div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 100px 1rem 4rem; background: #0E0E0E;">
  <div style="width: 100%; max-width: 420px;">

    <!-- Card login -->
    <div style="background: #1a1a1a; padding: 3rem 2.5rem; border: 1px solid rgba(255,255,255,0.08);">

      <!-- En-tête -->
      <div style="text-align: center; margin-bottom: 2rem;">
        <div style="font-family: var(--font-ui); font-size: 0.68rem; letter-spacing: 0.3em; text-transform: uppercase; color: var(--gold); margin-bottom: 0.8rem; display: flex; align-items: center; justify-content: center; gap: 0.8rem;">
          <span style="width: 20px; height: 1px; background: var(--gold); display: inline-block;"></span>
          Espace client
          <span style="width: 20px; height: 1px; background: var(--gold); display: inline-block;"></span>
        </div>
        <h1 style="font-family: var(--font-display); font-size: 2rem; font-style: italic; font-weight: 400; color: var(--cream); margin-bottom: 0.5rem;">
          Accéder à mon album
        </h1>
        <p style="font-family: var(--font-body); color: rgba(201,196,190,0.6); font-size: 1rem;">
          Saisissez le code reçu par e-mail
        </p>
      </div>

      <!-- Formulaire -->
      <form method="POST" action="?action=client_auth">
        <div style="margin-bottom: 1.4rem;">
          <label for="code_album" style="font-family: var(--font-ui); font-size: 0.68rem; font-weight: 500; letter-spacing: 0.16em; text-transform: uppercase; color: rgba(201,196,190,0.5); display: block; margin-bottom: 0.5rem;">
            Code Album
          </label>
          <input
            type="text"
            id="code_album"
            name="code_album"
            placeholder="Ex : AB12CD34"
            required
            autofocus
            style="width: 100%; padding: 0.85rem 1rem; font-family: var(--font-body); font-size: 1.1rem; text-align: center; text-transform: uppercase; letter-spacing: 0.2em; color: var(--cream); background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.12); outline: none; transition: border-color 0.2s; border-radius: 0;"
            onfocus="this.style.borderColor='var(--gold)'"
            onblur="this.style.borderColor='rgba(255,255,255,0.12)'"
          >
        </div>

        <button
          type="submit"
          style="width: 100%; padding: 1rem; font-family: var(--font-ui); font-size: 0.75rem; font-weight: 500; letter-spacing: 0.18em; text-transform: uppercase; background: var(--gold); color: white; border: none; cursor: pointer; transition: background 0.2s; border-radius: 0;"
          onmouseover="this.style.background='var(--gold-dark)'"
          onmouseout="this.style.background='var(--gold)'"
        >
          Accéder à ma galerie →
        </button>
      </form>

    </div>

    <!-- Lien retour -->
    <div style="text-align: center; margin-top: 1.5rem;">
      <a href="?action=home" style="font-family: var(--font-ui); font-size: 0.68rem; letter-spacing: 0.14em; text-transform: uppercase; color: rgba(255,255,255,0.25); text-decoration: none;">
        ← Retour à l'accueil
      </a>
    </div>

  </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>