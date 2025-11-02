<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $n->titre }}</title>
</head>
<body style="margin:0; padding:0; background-color:#0f172a;">
    <!-- Wrapper -->
    <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background:#0f172a;">
        <tr>
            <td align="center" style="padding:32px 16px;">
                <!-- Card -->
                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="max-width:720px; background:#0b1220; border-radius:24px; overflow:hidden; box-shadow:0 12px 40px rgba(0,0,0,0.35);">
                    <!-- Header / Brand -->
                    <tr>
                        <td style="background:linear-gradient(135deg,#7c3aed,#06b6d4); padding:28px 24px; text-align:left;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td valign="middle">
                                        <div style="display:flex; align-items:center; gap:12px;">
                                            <!-- Logo (fallback au texte si non dispo) -->
                                            <img src="{{ asset('images/logo-footer.PNG') }}" alt="ZEEEMAX" style="height:40px; width:auto; display:block; border:0; outline:none; text-decoration:none;">
                                            <span style="font-family:Arial,Helvetica,sans-serif; font-size:14px; color:#fff; letter-spacing:1px; opacity:.9;">NEWSLETTER</span>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Title / Intro -->
                    <tr>
                        <td style="padding:28px 28px 8px 28px;">
                            <h1 style="margin:0 0 8px 0; font-family:Arial,Helvetica,sans-serif; font-size:26px; line-height:1.25; color:#f1f5f9;">{{ $n->titre }}</h1>
                            @if(!empty($n->categorie))
                            <span style="display:inline-block; margin-top:6px; padding:6px 10px; border-radius:999px; background:#1e293b; color:#93c5fd; font-family:Arial,Helvetica,sans-serif; font-size:12px;">{{ $n->categorie }}</span>
                            @endif
                        </td>
                    </tr>

                    <!-- Cover image -->
                    @if(!empty($n->image_couverture))
                    <tr>
                        <td style="padding:12px 28px 0 28px;">
                            <img src="{{ str_starts_with($n->image_couverture, 'http') ? $n->image_couverture : asset($n->image_couverture) }}" alt="Couverture" style="width:100%; height:auto; border-radius:16px; display:block; border:0;">
                        </td>
                    </tr>
                    @endif

                    <!-- Excerpt -->
                    @if(!empty($n->extrait))
                    <tr>
                        <td style="padding:16px 28px 0 28px;">
                            <p style="margin:0; font-family:Arial,Helvetica,sans-serif; font-size:15px; line-height:1.7; color:#cbd5e1;">{{ $n->extrait }}</p>
                        </td>
                    </tr>
                    @endif

                    <!-- Content -->
                    <tr>
                        <td style="padding:18px 28px 8px 28px;">
                            <div style="font-family:Arial,Helvetica,sans-serif; font-size:15px; line-height:1.75; color:#e2e8f0;">
                                {!! nl2br(e($n->contenu)) !!}
                            </div>
                        </td>
                    </tr>

                    <!-- CTA -->
                    <tr>
                        <td style="padding:12px 28px 24px 28px;">
                            <table role="presentation" cellpadding="0" cellspacing="0" align="left">
                                <tr>
                                    <td bgcolor="#7c3aed" style="border-radius:12px;">
                                        <a href="{{ route('newsletter.show', $n->slug) }}" target="_blank" style="display:inline-block; padding:12px 18px; font-family:Arial,Helvetica,sans-serif; font-size:14px; color:#ffffff; text-decoration:none;">Lire en ligne</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding:18px 24px 28px 24px; background:#0b1220; border-top:1px solid #1f2937;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="text-align:left;">
                                        <p style="margin:0 0 6px 0; font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#94a3b8;">© {{ date('Y') }} ZEEEMAX</p>
                                        <p style="margin:0; font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#64748b;">Cet email vous a été envoyé par ZEEEMAX.</p>
                                    </td>
                                    <td style="text-align:right;">
                                        <a href="mailto:{{ config('mail.from.address') }}" style="font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#93c5fd; text-decoration:none;">Nous contacter</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>


