<?php
// controllers/PublicController.php

require_once __DIR__ . '/../lib/PHPMailer/PHPMailer.php';
require_once __DIR__ . '/../lib/PHPMailer/SMTP.php';
require_once __DIR__ . '/../lib/PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class PublicController {

    public function home(): void {
        $db   = (new Database())->getConnection();
        $stmt = $db->query(
            'SELECT id, titre, date_mariage, image_couverture
             FROM albums
             WHERE image_couverture IS NOT NULL
             ORDER BY date_mariage DESC
             LIMIT 12'
        );
        $albums = $stmt->fetchAll();

        $stmt2 = $db->query(
            'SELECT auteur, contenu FROM testimonials
             WHERE approuve = 1
             ORDER BY created_at DESC LIMIT 6'
        );
        $testimonials = $stmt2->fetchAll();

        require_once __DIR__ . '/../views/public/home.php';
    }

    public function photographe(): void {
        $db   = (new Database())->getConnection();
        // Témoignages pour la page photographe
        $stmt = $db->query(
            'SELECT auteur, contenu FROM testimonials
             WHERE approuve = 1
             ORDER BY created_at DESC LIMIT 3'
        );
        $testimonials = $stmt->fetchAll();
        require_once __DIR__ . '/../views/public/photographe.php';
    }

    public function galerie(): void {
        $db   = (new Database())->getConnection();
        $stmt = $db->query(
            'SELECT id, titre, date_mariage, image_couverture
             FROM albums
             WHERE image_couverture IS NOT NULL
             ORDER BY date_mariage DESC'
        );
        $albums = $stmt->fetchAll();
        require_once __DIR__ . '/../views/public/galerie.php';
    }

    public function forfaits(): void {
        require_once __DIR__ . '/../views/public/forfaits.php';
    }

    public function contact(): void {
        $success = false;
        $error   = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom     = trim($_POST['nom']     ?? '');
            $email   = trim($_POST['email']   ?? '');
            $date    = trim($_POST['date']    ?? '');
            $lieu    = trim($_POST['lieu']    ?? '');
            $message = trim($_POST['message'] ?? '');

            if (empty($nom) || empty($email) || empty($message)) {
                $error = 'Veuillez remplir tous les champs obligatoires.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'Adresse email invalide.';
            } else {

                // ── PHPMailer + Mailtrap ──────────────────────────────────
                try {
                    $mail = new PHPMailer(true);

                    // Config SMTP Mailtrap : identifiants lus dans config/mail.php (exclu de Git)
                    $smtp = require __DIR__ . '/../config/mail.php';
                    $mail->isSMTP();
                    $mail->Host       = $smtp['host'];
                    $mail->SMTPAuth   = true;
                    $mail->Username   = $smtp['username'];
                    $mail->Password   = $smtp['password'];
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port       = $smtp['port'];
                    $mail->CharSet    = 'UTF-8';

                    // Expéditeur & destinataire
                    $mail->setFrom('noreply@lovelens.fr', 'LoveLens — Formulaire Contact');
                    $mail->addAddress('contact@lovelens.fr', 'Sophie Martin');
                    $mail->addReplyTo($email, $nom);

                    // Contenu HTML
                    $mail->isHTML(true);
                    $mail->Subject = 'Nouveau message de ' . $nom;
                    $mail->Body    = '
<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"></head>
<body style="font-family:Georgia,serif; background:#F7F3EE; padding:2rem; margin:0;">
  <div style="max-width:600px; margin:0 auto; background:white; padding:2.5rem; border-top:4px solid #B89B6A;">
    <h2 style="font-family:Georgia,serif; font-style:italic; color:#1C1C1C; margin-bottom:1.5rem; font-weight:400;">
      Nouveau message de ' . htmlspecialchars($nom) . '
    </h2>
    <table style="width:100%; border-collapse:collapse; font-size:0.95rem;">
      <tr style="border-bottom:1px solid #F7F3EE;">
        <td style="padding:0.7rem 0; color:#7A7570; width:120px; font-size:0.8rem; letter-spacing:0.08em; text-transform:uppercase;">Nom</td>
        <td style="padding:0.7rem 0; color:#1C1C1C;">' . htmlspecialchars($nom) . '</td>
      </tr>
      <tr style="border-bottom:1px solid #F7F3EE;">
        <td style="padding:0.7rem 0; color:#7A7570; font-size:0.8rem; letter-spacing:0.08em; text-transform:uppercase;">Email</td>
        <td style="padding:0.7rem 0;">
          <a href="mailto:' . htmlspecialchars($email) . '" style="color:#B89B6A;">' . htmlspecialchars($email) . '</a>
        </td>
      </tr>
      <tr style="border-bottom:1px solid #F7F3EE;">
        <td style="padding:0.7rem 0; color:#7A7570; font-size:0.8rem; letter-spacing:0.08em; text-transform:uppercase;">Date</td>
        <td style="padding:0.7rem 0; color:#1C1C1C;">' . (empty($date) ? 'Non précisée' : htmlspecialchars($date)) . '</td>
      </tr>
      <tr style="border-bottom:1px solid #F7F3EE;">
        <td style="padding:0.7rem 0; color:#7A7570; font-size:0.8rem; letter-spacing:0.08em; text-transform:uppercase;">Lieu</td>
        <td style="padding:0.7rem 0; color:#1C1C1C;">' . (empty($lieu) ? 'Non précisé' : htmlspecialchars($lieu)) . '</td>
      </tr>
    </table>
    <div style="margin-top:1.5rem; padding:1.2rem; background:#F7F3EE; border-left:3px solid #B89B6A;">
      <p style="color:#7A7570; font-size:0.75rem; margin-bottom:0.5rem; text-transform:uppercase; letter-spacing:0.1em;">Message</p>
      <p style="color:#1C1C1C; line-height:1.8; margin:0;">' . nl2br(htmlspecialchars($message)) . '</p>
    </div>
    <p style="margin-top:2rem; font-size:0.72rem; color:#C9C4BE; text-align:center;">
      Envoyé depuis le formulaire LoveLens
    </p>
  </div>
</body>
</html>';

                    // Version texte
                    $mail->AltBody =
                        "Nom : $nom\n" .
                        "Email : $email\n" .
                        "Date : " . (empty($date) ? 'Non précisée' : $date) . "\n" .
                        "Lieu : " . (empty($lieu) ? 'Non précisé' : $lieu) . "\n\n" .
                        "Message :\n$message";

                    $mail->send();
                    $success = true;

                } catch (Exception $e) {
                    $error = 'L\'envoi a échoué. Veuillez réessayer ou nous contacter directement.';
                    error_log('PHPMailer Error: ' . $e->getMessage());
                }
            }
        }

        require_once __DIR__ . '/../views/public/contact.php';
    }
}