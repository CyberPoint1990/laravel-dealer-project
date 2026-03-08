@extends('layouts.app')

@section('title', 'Dealer Dashboard')

@section('content')
<div class="container-fluid p-4 min-vh-100 bg-light">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-black text-dark mb-0">Dealer Administration</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>
        
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm fw-bold px-3 rounded-pill shadow-sm transition-all hover-scale">
                <i class="bi bi-box-arrow-right me-2"></i>Logout System
            </button>
        </form>
    </div>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden position-relative" style="background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: white;">
                <div class="card-body p-4">
                    <small class="text-white-50 fw-bold text-uppercase tracking-wider">Total Dealers</small>
                    <h2 class="fw-black mt-1 mb-0">{{ \App\Models\Dealer::count() }}</h2>
                    <div class="mt-3 small opacity-75">
                        <i class="bi bi-arrow-up"></i> Registered Network
                    </div>
                </div>
                <i class="bi bi-people position-absolute end-0 bottom-0 m-3 opacity-25 display-4"></i>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 bg-white">
                <div class="card-body p-4">
                    <small class="text-muted fw-bold text-uppercase tracking-wider">Certificates Issued</small>
                    <h2 class="fw-black text-dark mt-1 mb-0">1,185</h2>
                    <div class="mt-3 small text-success">
                        <i class="bi bi-check-circle"></i> 95.5% Accuracy
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 bg-white border-start border-4 border-primary">
                <div class="card-body p-4">
                    <small class="text-muted fw-bold text-uppercase tracking-wider">New This Month</small>
                    <h2 class="fw-black text-dark mt-1 mb-0">+48</h2>
                    <div class="mt-3 small text-primary">
                        <i class="bi bi-graph-up"></i> Growing Network
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 bg-dark text-white">
                <div class="card-body p-4">
                    <small class="text-white-50 fw-bold text-uppercase tracking-wider">System Status</small>
                    <h2 class="fw-black mt-1 mb-0">Stable</h2>
                    <div class="mt-3 small text-info">
                        <i class="bi bi-cpu"></i> PHP 8.2 &bull; Active
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold m-0">Quick Actions</h5>
                    <a href="{{ route('dealers.index') }}" class="btn btn-link text-primary text-decoration-none fw-bold">View All Dealers</a>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('dealers.create') }}" class="btn btn-primary px-4 py-2 rounded-3 fw-bold">Add New Dealer</a>
                    <button class="btn btn-light px-4 py-2 rounded-3 fw-bold border">Bulk Import Excel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .fw-black { font-weight: 900; }
    .rounded-4 { border-radius: 1.25rem; }
    .hover-scale:hover { transform: scale(1.05); }
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
</style>
@endsection