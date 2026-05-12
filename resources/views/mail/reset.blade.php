<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - PlanoraAI</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #333333;
            margin: 0;
            padding: 20px;
            line-height: 1.6;
        }
        .email-wrapper {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }
        .email-header {
            background: linear-gradient(135deg, #4F46E5 0%, #6366F1 100%);
            padding: 40px 30px;
            text-align: center;
            position: relative;
        }
        .email-header::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        .email-header::after {
            content: '';
            position: absolute;
            bottom: -30px;
            left: -30px;
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        .logo {
            position: relative;
            z-index: 1;
        }
        .logo h1 {
            color: #ffffff;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }
        .logo p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 14px;
            font-weight: 500;
        }
        .email-body {
            padding: 40px 30px;
            background-color: #ffffff;
        }
        .greeting {
            font-size: 24px;
            font-weight: 600;
            color: #1F2937;
            margin-bottom: 20px;
        }
        .email-body p {
            color: #4B5563;
            font-size: 16px;
            margin-bottom: 16px;
            line-height: 1.8;
        }
        .email-action {
            text-align: center;
            margin: 32px 0;
        }
        .btn-reset {
            display: inline-block;
            background: linear-gradient(135deg, #4F46E5 0%, #6366F1 100%);
            color: #ffffff !important;
            text-decoration-color: #ffffff !important;
            padding: 16px 48px;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 16px;
            box-shadow: 0 4px 14px rgba(79, 70, 229, 0.4);
            transition: all 0.3s ease;
        }
        .btn-reset:hover {
            background: linear-gradient(135deg, #4338CA 0%, #4F46E5 100%);
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.6);
            transform: translateY(-2px);
        }
        .expiry-notice {
            background-color: #FEE2E2;
            padding: 16px;
            margin: 24px 0;
        }
        .expiry-notice p {
            color: #991B1B;
            font-size: 14px;
            margin: 0;
        }
        .expiry-notice .time {
            font-weight: 700;
            color: #DC2626;
        }
        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #E5E7EB, transparent);
            margin: 32px 0;
        }
        .alternative-link {
            background-color: #F9FAFB;
            padding: 20px;
            border-radius: 8px;
            margin-top: 24px;
        }
        .alternative-link p {
            font-size: 13px;
            color: #6B7280;
            margin-bottom: 8px;
        }
        .alternative-link code {
            display: block;
            background-color: #ffffff;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #E5E7EB;
            color: #4F46E5;
            font-size: 12px;
            word-break: break-all;
            font-family: 'Courier New', monospace;
        }

        .no-request-notice {
            background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
            padding: 20px;
            margin-top: 24px;
        }
        .no-request-notice p {
            color: #065F46;
            font-size: 14px;
            margin: 0;
            font-weight: 500;
        }
        .email-footer {
            background-color: #F9FAFB;
            padding: 30px;
            text-align: center;
        }
        .footer-content p {
            color: #6B7280;
            font-size: 14px;
            margin-bottom: 8px;
        }
        .footer-brand {
            font-weight: 600;
            color: #4F46E5;
            font-size: 16px;
            margin-bottom: 12px;
        }
        .footer-links {
            margin-top: 16px;
        }
        .footer-links a {
            color: #4F46E5;
            text-decoration: none;
            font-size: 13px;
            margin: 0 12px;
            font-weight: 500;
        }
        .footer-links a:hover {
            text-decoration: underline;
        }
        .copyright {
            color: #9CA3AF;
            font-size: 12px;
            margin-top: 16px;
        }
        @media only screen and (max-width: 600px) {
            body {
                padding: 10px;
            }
            .email-header {
                padding: 30px 20px;
            }
            .logo h1 {
                font-size: 26px;
            }
            .email-body {
                padding: 30px 20px;
            }
            .greeting {
                font-size: 20px;
            }
            .btn-reset {
                padding: 14px 32px;
                font-size: 15px;
            }
            .email-footer {
                padding: 20px;
            }
            .footer-links a {
                display: block;
                margin: 8px 0;
            }
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <!-- Header -->
        <div class="email-header">
            <div class="logo">
                <h1>PlanoraAI</h1>
                <p>Platform Pembuatan RPP dengan AI</p>
            </div>
        </div>

        <!-- Body -->
        <div class="email-body">
            <div class="greeting">
                Reset Password
            </div>

            <p>Kami menerima permintaan untuk mereset password akun PlanoraAI Anda.</p>

            <p>Jika Anda yang melakukan permintaan ini, silakan klik tombol di bawah untuk membuat password baru:</p>

            <div class="email-action">
                <a href="{{ $url }}" class="btn-reset">Reset Password Saya</a>
            </div>

            <!-- Expiry Notice -->
            <div class="expiry-notice">
                <p>Link ini akan <span class="time">kedaluwarsa dalam 60 menit</span>. Segera reset password Anda sebelum link tidak dapat digunakan lagi.</p>
            </div>

            <div class="divider"></div>

            <!-- Alternative Link -->
            <div class="alternative-link">
                <p><strong>Tombol tidak berfungsi?</strong></p>
                <p>Salin dan tempel tautan berikut ke browser Anda:</p>
                <code>{{ $url }}</code>
            </div>

            <!-- No Request Notice -->
            <div class="no-request-notice">
                <p><strong>Tidak Merasa Melakukan Permintaan?</strong><br>
                Jika Anda tidak merasa melakukan permintaan reset password, abaikan email ini. Password Anda tetap aman dan tidak akan berubah.</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <div class="footer-content">
                <div class="footer-brand">PlanoraAI</div>
                <p>Membuat RPP Berkualitas dengan Bantuan AI</p>

                <div class="footer-links">
                    <a href="https://planora-ai.online">Home</a>
                    <a href="#">Panduan</a>
                    <a href="#">Hubungi Kami</a>
                </div>

                <div class="copyright">
                    © {{ date('Y') }} PlanoraAI. All rights reserved.
                </div>
            </div>
        </div>
    </div>
</body>
</html>
