<!DOCTYPE html>
<html>
<head>
    <title>Rise & Thrive CRM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="/dashboard">Rise & Thrive CRM</a>
            @auth
                <div class="d-flex align-items-center text-white">
                    <span class="me-3">Welcome, {{ Auth::user()->first_name }} ({{ Auth::user()->roles }})</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-sm btn-danger">Logout</button>
                    </form>
                </div>
            @endauth
        </div>
    </nav>
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @yield('content')
    </div>
</body>
</html>