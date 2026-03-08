@extends('layouts.app')

@section('title', 'Admin Settings')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    :root {
        --admin-primary: #1e40af;
        --admin-dark: #0f172a;
        --admin-bg: #f8fafc;
    }

    body { 
        background-color: var(--admin-bg); 
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #1e293b;
    }

    /* Hero Section */
    .profile-banner {
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        height: 160px;
        border-radius: 24px 24px 0 0;
        position: relative;
    }

    .profile-card {
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 24px;
        background: #ffffff;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    /* Profile Image Styling */
    .avatar-wrapper {
        position: relative;
        display: inline-block;
        margin-top: -80px;
    }

    .avatar-img {
        width: 140px;
        height: 140px;
        border-radius: 32px;
        border: 6px solid #fff;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        object-fit: cover;
    }

    .status-indicator {
        position: absolute;
        bottom: 10px;
        right: -5px;
        width: 28px;
        height: 28px;
        background: #10b981;
        border: 4px solid #fff;
        border-radius: 50%;
    }

    /* Form Styling */
    .glass-input {
        border-radius: 12px;
        padding: 14px 18px;
        border: 1px solid #e2e8f0;
        background-color: #fcfcfc;
        font-size: 0.95rem;
        transition: all 0.2s;
    }

    .glass-input:focus {
        background-color: #fff;
        border-color: var(--admin-primary);
        box-shadow: 0 0 0 4px rgba(30, 64, 175, 0.1);
    }

    .nav-label {
        font-size: 10px;
        font-weight: 800;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 8px;
    }

    /* Button Styling */
    .btn-update {
        background: var(--admin-primary);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 12px;
        font-weight: 700;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 14px 0 rgba(30, 64, 175, 0.3);
        transition: all 0.3s ease;
    }

    .btn-update:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(30, 64, 175, 0.4);
        background: #1e3a8a;
    }

    /* Security Section */
    .security-card {
        background: var(--admin-dark);
        border-radius: 24px;
        border: none;
    }

    .security-input {
        background: rgba(255, 255, 255, 0.05) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        color: #fff !important;
    }

    .security-input:focus {
        border-color: #3b82f6 !important;
        background: rgba(255, 255, 255, 0.08) !important;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-4">
            <div class="profile-card text-center overflow-hidden h-100">
                <div class="profile-banner"></div>
                <div class="avatar-wrapper">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=1e40af&color=fff&size=140&bold=true" 
                         class="avatar-img" alt="Admin">
                    <div class="status-indicator"></div>
                </div>
                
                <div class="px-4 pt-3 pb-5">
                    <h3 class="fw-bold text-dark mb-1">{{ $user->name }}</h3>
                    <p class="text-primary fw-bold small text-uppercase tracking-widest mb-4">Master Control Access</p>
                    
                    <div class="mt-4 space-y-3">
                        <div class="d-flex align-items-center p-3 bg-light rounded-4 mb-2">
                            <i class="bi bi-envelope-at fs-5 text-muted me-3"></i>
                            <div class="text-start">
                                <span class="nav-label d-block m-0">Primary Email</span>
                                <span class="small fw-bold">{{ $user->email }}</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center p-3 bg-light rounded-4">
                            <i class="bi bi-shield-check fs-5 text-success me-3"></i>
                            <div class="text-start">
                                <span class="nav-label d-block m-0">Account Level</span>
                                <span class="small fw-bold">Super Admin (Verified)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="profile-card p-5 mb-4">
                <div class="d-flex align-items-center mb-5">
                    <div class="bg-primary-subtle text-primary rounded-4 p-3 me-3">
                        <i class="bi bi-person-gear fs-4"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold m-0">Identity Settings</h4>
                        <p class="text-muted small m-0">Manage your administrative personal information</p>
                    </div>
                </div>

                <form method="post" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="nav-label">Full Administrator Name</label>
                            <input type="text" name="name" class="form-control glass-input" value="{{ old('name', $user->name) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="nav-label">Official Business Email</label>
                            <input type="email" name="email" class="form-control glass-input" value="{{ old('email', $user->email) }}" required>
                        </div>
                    </div>
                    <div class="mt-5 pt-3 border-top d-flex justify-content-between align-items-center">
                        <span class="text-muted small">Last updated: {{ $user->updated_at->diffForHumans() }}</span>
                        <button type="submit" class="btn btn-update px-5">Save Configuration</button>
                    </div>
                </form>
            </div>

            <div class="security-card p-5 text-white">
                <div class="d-flex align-items-center mb-5">
                    <div class="bg-primary rounded-4 p-3 me-3">
                        <i class="bi bi-shield-lock-fill fs-4 text-white"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold m-0">Vault Access Security</h4>
                        <p class="text-info small m-0 opacity-75">Update your secure authentication keys</p>
                    </div>
                </div>

                <form method="post" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')
                    <div class="mb-4">
                        <label class="nav-label text-info">Current Authentication Password</label>
                        <input type="password" name="current_password" class="form-control glass-input security-input shadow-none">
                    </div>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="nav-label text-info">New Secret Key</label>
                            <input type="password" name="password" class="form-control glass-input security-input shadow-none">
                        </div>
                        <div class="col-md-6">
                            <label class="nav-label text-info">Confirm Access Key</label>
                            <input type="password" name="password_confirmation" class="form-control glass-input security-input shadow-none">
                        </div>
                    </div>
                    <div class="mt-5 pt-3 border-top border-secondary d-flex justify-content-end">
                        <button type="submit" class="btn btn-info text-white fw-bold py-3 px-5 rounded-4 shadow-sm">
                            <i class="bi bi-key me-2"></i>Encrypt New Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection