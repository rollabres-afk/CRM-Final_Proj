<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rise & Thrive Fitness CRM</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Google Fonts (Teko for Headings, Roboto for Body) -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Teko:wght@500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --gym-orange: #ff5722; /* Energetic Orange */
            --gym-dark: #212529;    /* Dark Charcoal */
            --gym-gray: #f8f9fa;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f6f8;
        }

        h1, h2, h3, h4, h5, .navbar-brand {
            font-family: 'Teko', sans-serif;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Navbar Styling */
        .navbar {
            background-color: var(--gym-dark) !important;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding-top: 15px;
            padding-bottom: 15px;
        }

        .navbar-brand {
            color: var(--gym-orange) !important;
            font-size: 1.8rem;
            font-weight: 600;
        }

        .navbar-text {
            color: white;
        }

        /* Button Styling */
        .btn-primary {
            background-color: var(--gym-orange);
            border-color: var(--gym-orange);
            font-weight: 500;
            text-transform: uppercase;
        }

        .btn-primary:hover {
            background-color: #e64a19;
            border-color: #e64a19;
        }

        .btn-outline-primary {
            color: var(--gym-orange);
            border-color: var(--gym-orange);
        }

        .btn-outline-primary:hover {
            background-color: var(--gym-orange);
            color: white;
        }

        /* Card Styling */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            transition: transform 0.2s;
        }
        
        .card-header {
            background-color: white;
            border-bottom: 2px solid var(--gym-gray);
            font-family: 'Teko', sans-serif;
            font-size: 1.5rem;
            color: var(--gym-dark);
            padding: 15px 20px;
        }
    </style>
</head>
<body>

    @auth
    <nav class="navbar navbar-expand-lg navbar-dark mb-5">
        <div class="container">
            <a class="navbar-brand" href="/dashboard">
                <i class="bi bi-lightning-charge-fill"></i> Rise & Thrive
            </a>
            
            <div class="d-flex align-items-center">
                <div class="text-white me-4 d-none d-md-block">
                    <small class="text-secondary text-uppercase" style="font-size: 0.7rem;">Logged in as</small><br>
                    <span class="fw-bold">{{ Auth::user()->first_name }}</span> 
                    <span class="badge bg-secondary ms-1">{{ Auth::user()->roles }}</span>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-outline-light btn-sm px-4">Logout</button>
                </form>
            </div>
        </div>
    </nav>
    @endauth

    <div class="container pb-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-start border-success border-5" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show shadow-sm border-start border-danger border-5" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ $errors->first() }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>