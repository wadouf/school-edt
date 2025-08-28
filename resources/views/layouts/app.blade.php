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

        <!-- Custom Styles -->
        <style>
            :root {
                --primary-color: #2563eb;
                --secondary-color: #64748b;
                --success-color: #10b981;
                --danger-color: #ef4444;
                --warning-color: #f59e0b;
                --info-color: #06b6d4;
                --light-color: #f8fafc;
                --dark-color: #1e293b;
                --border-radius: 0.5rem;
                --box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            }

            body {
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
                background-color: #f8fafc;
                color: #334155;
                line-height: 1.6;
            }

            .navbar-brand {
                font-weight: 700;
                color: var(--primary-color) !important;
            }

            .btn-primary {
                background-color: var(--primary-color);
                border-color: var(--primary-color);
                border-radius: var(--border-radius);
                font-weight: 500;
                padding: 0.5rem 1rem;
                transition: all 0.2s;
            }

            .btn-primary:hover {
                background-color: #1d4ed8;
                border-color: #1d4ed8;
                transform: translateY(-1px);
            }

            .card {
                border: none;
                border-radius: var(--border-radius);
                box-shadow: var(--box-shadow);
                transition: all 0.2s;
            }

            .card:hover {
                box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
                transform: translateY(-2px);
            }

            .table {
                border-radius: var(--border-radius);
                overflow: hidden;
            }

            .table th {
                background-color: #f1f5f9;
                border: none;
                font-weight: 600;
                color: var(--dark-color);
                padding: 1rem;
            }

            .table td {
                border: none;
                padding: 0.875rem 1rem;
                border-bottom: 1px solid #e2e8f0;
            }

            .badge {
                border-radius: 50px;
                font-weight: 500;
                padding: 0.375rem 0.75rem;
            }

            .btn-outline-primary {
                color: var(--primary-color);
                border-color: var(--primary-color);
                border-radius: var(--border-radius);
            }

            .btn-outline-primary:hover {
                background-color: var(--primary-color);
                border-color: var(--primary-color);
            }

            .form-control, .form-select {
                border-radius: var(--border-radius);
                border: 1px solid #d1d5db;
                padding: 0.625rem 0.875rem;
                transition: all 0.2s;
            }

            .form-control:focus, .form-select:focus {
                border-color: var(--primary-color);
                box-shadow: 0 0 0 0.2rem rgb(37 99 235 / 0.25);
            }

            .stats-card {
                background: linear-gradient(135deg, var(--primary-color) 0%, #3b82f6 100%);
                color: white;
                border-radius: var(--border-radius);
                padding: 1.5rem;
                text-align: center;
                transition: all 0.2s;
            }

            .stats-card:hover {
                transform: translateY(-3px);
                box-shadow: 0 10px 25px rgb(37 99 235 / 0.3);
            }

            .sidebar-nav .nav-link {
                border-radius: var(--border-radius);
                margin-bottom: 0.25rem;
                padding: 0.75rem 1rem;
                transition: all 0.2s;
            }

            .sidebar-nav .nav-link:hover {
                background-color: #e2e8f0;
                color: var(--primary-color);
            }

            .sidebar-nav .nav-link.active {
                background-color: var(--primary-color);
                color: white;
            }

            .alert {
                border: none;
                border-radius: var(--border-radius);
                padding: 1rem 1.25rem;
            }

            .pagination .page-link {
                border-radius: var(--border-radius);
                margin: 0 2px;
                border: 1px solid #d1d5db;
                color: var(--secondary-color);
            }

            .pagination .page-link:hover {
                background-color: var(--primary-color);
                color: white;
                border-color: var(--primary-color);
            }

            .modal-content {
                border: none;
                border-radius: var(--border-radius);
                box-shadow: 0 25px 50px -12px rgb(0 0 0 / 0.25);
            }

            .dropdown-menu {
                border: none;
                border-radius: var(--border-radius);
                box-shadow: var(--box-shadow);
                padding: 0.5rem;
            }

            .dropdown-item {
                border-radius: calc(var(--border-radius) - 2px);
                padding: 0.5rem 0.75rem;
                transition: all 0.2s;
            }

            .dropdown-item:hover {
                background-color: #f1f5f9;
                color: var(--primary-color);
            }

            @media (max-width: 768px) {
                .stats-card {
                    margin-bottom: 1rem;
                }
                
                .card {
                    margin-bottom: 1rem;
                }
                
                .table-responsive {
                    border-radius: var(--border-radius);
                }
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <!-- Bootstrap 5 JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
