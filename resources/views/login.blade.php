@extends('layout')

@section('content')
<style>
    /* Custom Background Style for Login Page */
    body {
        /* Dark Fallback */
        background-color: #1a1a1a;
        /* Gym Background Image with Dark Overlay */
        background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.9)), 
                          url('https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=1470&auto=format&fit=crop');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        min-height: 100vh;
        
        /* Flexbox to center the card */
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0;
    }

    /* Override Layout Container margins for Login Page */
    .container {
        margin-top: 0 !important;
        padding-top: 0 !important;
    }

    /* Card Styling */
    .login-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        border: none;
    }

    /* Typography */
    .brand-title {
        font-family: 'Teko', sans-serif;
        font-size: 3.5rem;
        color: #ffffff;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        margin-bottom: 0;
        line-height: 1;
    }
    
    .brand-subtitle {
        color: rgba(255, 255, 255, 0.8);
        letter-spacing: 2px;
        font-weight: 300;
        text-transform: uppercase;
        font-size: 0.9rem;
        margin-top: 10px;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
    }
</style>

<div class="row justify-content-center w-100">
    <div class="col-md-6 col-lg-4">
        
        <!-- Header Section -->
        <div class="text-center mb-4">
            <h1 class="brand-title fw-bold">
                <i class="bi bi-lightning-charge-fill" style="color: #ff5722;"></i> RISE & THRIVE
            </h1>
            <p class="brand-subtitle">Customer Relationship Management System</p>
        </div>

        <!-- Login Card -->
        <div class="card login-card p-4">
            <div class="card-body">
                <h5 class="text-center mb-4 fw-bold text-dark text-uppercase">Sign In</h5>
                
                <form method="POST" action="/login">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">EMAIL ADDRESS</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-primary">
                                <i class="bi bi-envelope-fill"></i>
                            </span>
                            <input type="email" name="email" class="form-control border-start-0 ps-0" required placeholder="name@gym.com">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-secondary">PASSWORD</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-primary">
                                <i class="bi bi-lock-fill"></i>
                            </span>
                            <input type="password" name="password" class="form-control border-start-0 ps-0" required placeholder="Enter password">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 fw-bold rounded-pill shadow-sm text-uppercase" style="background-color: #ff5722; border: none;">
                        Login <i class="bi bi-arrow-right-short"></i>
                    </button>

                    @if($errors->any())
                        <div class="alert alert-danger mt-3 d-flex align-items-center small" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <div>{{ $errors->first() }}</div>
                        </div>
                    @endif
                </form>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="text-center mt-4 text-white-50 small">
            &copy; {{ date('Y') }} Rise & Thrive Fitness. Authorized Personnel Only.
        </div>

    </div>
</div>
@endsection