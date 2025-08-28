<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Font Awesome -->
        <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.0/css/all.min.css" rel="stylesheet">

        <!-- Custom Login Styles -->
        <style>
            body {
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 2rem 1rem;
            }

            .login-container {
                background: white;
                border-radius: 1rem;
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
                padding: 2.5rem;
                width: 100%;
                max-width: 450px;
                margin: auto;
            }

            .school-logo {
                width: 80px;
                height: 80px;
                background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 2rem;
                margin: 0 auto 1.5rem;
            }

            .form-control {
                border-radius: 0.5rem;
                border: 2px solid #e5e7eb;
                padding: 0.75rem 1rem;
                transition: all 0.3s;
                font-size: 0.95rem;
            }

            .form-control:focus {
                border-color: #2563eb;
                box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
            }

            .btn-primary {
                background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
                border: none;
                border-radius: 0.5rem;
                padding: 0.75rem 2rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                transition: all 0.3s;
            }

            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 25px rgba(37, 99, 235, 0.3);
            }

            .demo-accounts {
                background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
                border: 1px solid #0ea5e9;
                border-radius: 0.75rem;
                padding: 1rem;
            }

            .demo-account {
                background: white;
                border-radius: 0.5rem;
                padding: 0.75rem;
                margin: 0.25rem 0;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
                transition: all 0.2s;
            }

            .demo-account:hover {
                transform: translateY(-1px);
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .text-primary {
                color: #2563eb !important;
            }

            .text-muted {
                color: #6b7280 !important;
            }

            .form-check-input:checked {
                background-color: #2563eb;
                border-color: #2563eb;
            }

            @media (max-width: 576px) {
                .login-container {
                    padding: 2rem 1.5rem;
                    margin: 1rem;
                }
                
                .demo-accounts .row > div {
                    margin-bottom: 0.5rem;
                }
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="login-container">
            {{ $slot }}
        </div>

        <!-- Bootstrap 5 JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
