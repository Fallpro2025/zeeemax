<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau message de contact</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f7f7fb; padding:24px;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width:640px; margin:0 auto; background:#ffffff; border-radius:12px; overflow:hidden;">
        <tr>
            <td style="background:#111827; color:#fff; padding:20px 24px; font-size:18px; font-weight:700;">
                Nouveau message de contact
            </td>
        </tr>
        <tr>
            <td style="padding:20px 24px; color:#111827;">
                <p style="margin:0 0 12px 0;">Vous avez reçu un nouveau message de contact depuis le site.</p>
                <ul style="list-style:none; padding:0; margin:16px 0;">
                    <li><strong>Prénom</strong> : {{ $d['first_name'] ?? '' }}</li>
                    <li><strong>Nom</strong> : {{ $d['last_name'] ?? '' }}</li>
                    <li><strong>Email</strong> : {{ $d['email'] ?? '' }}</li>
                    <li><strong>Objet</strong> : {{ $d['subject'] ?? '' }}</li>
                </ul>
                <div style="margin-top:16px; padding:12px 16px; background:#f3f4f6; border-radius:8px; white-space:pre-wrap; line-height:1.6;">
                    {{ $d['message'] ?? '' }}
                </div>
            </td>
        </tr>
        <tr>
            <td style="padding:16px 24px; color:#6b7280; font-size:12px; text-align:center;">
                Message envoyé automatiquement par le site ZEEEMAX.
            </td>
        </tr>
    </table>
</body>
<!-- Email généré automatiquement. -->
</html>


