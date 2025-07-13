@extends('layouts.app')

@section('title', 'Login - KL Mobile DJ & Events')

@section('content')
<div class="auth-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="auth-card">
                    <div class="text-center mb-4">
                        <h2 class="auth-title">Welcome Back</h2>
                        <p class="auth-subtitle">Sign in to continue to your account</p>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('info'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            {{ session('info') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="auth-form">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       placeholder="Enter your email"
                                       required 
                                       autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       id="password" 
                                       name="password" 
                                       placeholder="Enter your password"
                                       required>
                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                    <i class="fas fa-eye"></i>
                                </button>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       name="remember" 
                                       id="remember" 
                                       {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    Remember me
                                </label>
                            </div>
                            <a href="{{ route('password.request') }}" class="forgot-link">
                                Forgot password?
                            </a>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                            <i class="fas fa-sign-in-alt me-2"></i> Sign In
                        </button>

                        <div class="text-center">
                            <p class="mb-0">Don't have an account? 
                                <a href="{{ route('register') }}" class="register-link">
                                    Create one now
                                </a>
                            </p>
                        </div>
                    </form>

                    @if(session()->has('cart') && count(session('cart')) > 0)
                        <div class="alert alert-info mt-3" role="alert">
                            <i class="fas fa-info-circle me-2"></i>
                            You have {{ count(session('cart')) }} item(s) in your cart. 
                            Sign in to continue with checkout.
                        </div>
                    @endif
                </div>

                <div class="auth-footer text-center mt-4">
                    <p class="mb-0">
                        <a href="{{ route('home') }}" class="text-decoration-none">
                            <i class="fas fa-arrow-left me-2"></i>Back to Home
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Import Bebas Neue font */
    @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300;400;500;600;700;800&display=swap');

    .auth-wrapper {
        min-height: calc(100vh - 200px);
        padding: 80px 0;
        background: linear-gradient(135deg, rgba(147, 51, 234, 0.1) 0%, rgba(0, 0, 0, 0.95) 100%);
    }

    .auth-card {
        background: var(--bg-card);
        border: 1px solid var(--border-dark);
        border-radius: 25px;
        padding: 50px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
    }

    .auth-title {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 3rem;
        letter-spacing: 0.03em;
        text-transform: uppercase;
        background: linear-gradient(135deg, var(--primary-purple) 0%, var(--secondary-purple) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 15px;
    }

    .auth-subtitle {
        font-family: 'Inter', sans-serif;
        color: var(--text-gray);
        font-size: 1rem;
        font-weight: 400;
    }

    .form-label {
        font-family: 'Inter', sans-serif;
        color: var(--text-light);
        font-weight: 600;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 0.02em;
        font-size: 0.875rem;
    }

    .input-group-text {
        background: var(--bg-dark);
        border: 1px solid var(--border-dark);
        color: var(--primary-purple);
        padding: 14px 18px;
    }

    .form-control {
        background: var(--bg-dark);
        border: 1px solid var(--border-dark);
        color: var(--text-light);
        padding: 14px 18px;
        font-family: 'Inter', sans-serif;
        font-weight: 500;
        font-size: 1rem;
    }

    .form-control:focus {
        background: var(--bg-dark);
        border-color: var(--primary-purple);
        color: var(--text-light);
        box-shadow: 0 0 0 0.2rem rgba(147, 51, 234, 0.25);
    }

    .form-control::placeholder {
        color: #6B7280;
        opacity: 1;
    }

    /* Autofill styles */
    .form-control:-webkit-autofill,
    .form-control:-webkit-autofill:hover, 
    .form-control:-webkit-autofill:focus {
        background-color: var(--bg-dark) !important;
        -webkit-box-shadow: 0 0 0px 1000px var(--bg-dark) inset !important;
        -webkit-text-fill-color: var(--text-light) !important;
        transition: background-color 5000s ease-in-out 0s;
        border: 1px solid var(--border-dark) !important;
    }

    .toggle-password {
        background: var(--bg-dark);
        border: 1px solid var(--border-dark);
        color: var(--text-gray);
        padding: 14px 18px;
        transition: all 0.3s;
    }

    .toggle-password:hover {
        background: var(--bg-dark);
        border-color: var(--primary-purple);
        color: var(--primary-purple);
    }

    .toggle-password:focus {
        box-shadow: none;
        border-color: var(--primary-purple);
    }

    .form-check-input {
        background-color: var(--bg-dark);
        border-color: var(--border-dark);
        width: 20px;
        height: 20px;
        cursor: pointer;
    }

    .form-check-input:checked {
        background-color: var(--primary-purple);
        border-color: var(--primary-purple);
    }

    .form-check-input:focus {
        box-shadow: 0 0 0 0.2rem rgba(147, 51, 234, 0.25);
    }

    .form-check-label {
        font-family: 'Inter', sans-serif;
        color: var(--text-gray);
        font-weight: 500;
        cursor: pointer;
        margin-left: 8px;
    }

    .forgot-link,
    .register-link {
        font-family: 'Inter', sans-serif;
        color: var(--primary-purple);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s;
    }

    .forgot-link:hover,
    .register-link:hover {
        color: var(--secondary-purple);
        text-decoration: none;
        transform: translateX(2px);
    }

    .btn-primary {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, var(--primary-purple) 0%, var(--accent-violet) 100%);
        border: none;
        padding: 14px 30px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-size: 0.9rem;
        border-radius: 12px;
        transition: all 0.3s;
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(147, 51, 234, 0.4);
        background: linear-gradient(135deg, var(--accent-violet) 0%, var(--primary-purple) 100%);
    }

    .btn-primary:active {
        transform: translateY(-1px);
    }

    .alert {
        background: var(--bg-dark);
        border: 1px solid;
        color: var(--text-light);
        border-radius: 12px;
        font-family: 'Inter', sans-serif;
    }

    .alert-success {
        border-color: var(--success-green);
        background: rgba(34, 197, 94, 0.1);
    }

    .alert-info {
        border-color: var(--primary-purple);
        background: rgba(147, 51, 234, 0.1);
    }

    .btn-close {
        filter: invert(1);
        opacity: 0.8;
    }

    .auth-footer {
        font-family: 'Inter', sans-serif;
        color: var(--text-gray);
    }

    .auth-footer a {
        color: var(--text-gray);
        transition: all 0.3s;
    }

    .auth-footer a:hover {
        color: var(--primary-purple);
        transform: translateX(-5px);
    }

    /* Remove blue outline on focus */
    *:focus {
        outline: none !important;
    }

    @media (max-width: 768px) {
        .auth-card {
            padding: 35px 25px;
        }

        .auth-title {
            font-size: 2.5rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.closest('.input-group').querySelector('input');
            const icon = this.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
</script>
@endpush
@endsection