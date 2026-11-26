# PaffLens (LoveLens)

Site web d'une photographe de mariage, réalisé en formation (BTS SIO option SLAM, H3 Hitema, 2026).
Le site affiche le nom **LoveLens**.

Application PHP orientée objet, architecture MVC, base MySQL (PDO).

## Fonctionnalités

- **Pages publiques** : accueil, présentation de la photographe, galerie, forfaits, contact.
- **Contact** : formulaire qui envoie un e-mail avec PHPMailer (serveur SMTP de test Mailtrap).
- **Espace client** : chaque couple accède à son album privé avec un code, consulte ses photos
  et télécharge l'album complet en archive ZIP.
- **Administration** : connexion administrateur (mot de passe vérifié avec `password_verify`),
  création, modification et suppression d'albums, envoi de photos avec vérification du type de fichier,
  choix de la photo de couverture, gestion des témoignages.

## Sécurité

- Requêtes préparées PDO pour toutes les requêtes qui reçoivent une donnée saisie.
- Échappement des affichages avec `htmlspecialchars`.
- `.htaccess` : accès direct bloqué aux dossiers `config/`, `models/`, `controllers/`, `views/`, `lib/`,
  en-têtes de sécurité HTTP.
- Les identifiants SMTP sont dans `config/mail.php`, exclu du dépôt.

## Installation (WAMP)

1. Placer le dossier dans `C:\wamp64\www\lovelens1` (les chemins des feuilles de style utilisent `/lovelens1/`).
2. Créer la base `lovelens_db` dans phpMyAdmin (paramètres dans `config/database.php`).
3. Copier `config/mail.example.php` en `config/mail.php` et y mettre ses identifiants SMTP.
4. Ouvrir http://localhost/lovelens1/

Les photos envoyées (`public/uploads/`) ne sont pas versionnées.

## Technologies

PHP 8, MySQL, PDO, HTML, CSS, JavaScript, Bootstrap 5, PHPMailer.
