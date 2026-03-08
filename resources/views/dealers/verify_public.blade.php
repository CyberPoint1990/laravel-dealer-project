<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dealer Verification | Khalsa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background: #f4f7f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .verify-card { max-width: 500px; margin: 50px auto; border: none; border-radius: 20px; overflow: hidden; }
        .status-banner { padding: 30px; text-align: center; background: #198754; color: white; }
        .status-banner.inactive { background: #dc3545; }
        .dealer-logo { width: 80px; height: 80px; background: white; border-radius: 50%; display: flex; 
                       align-items: center; justify-content: center; margin: -40px auto 10px; 
                       box-shadow: 0 4px 10px rgba(0,0,0,0.1); font-size: 2rem; color: #1a3a5a; }
        .info-label { font-size: 0.75rem; font-weight: bold; color: #6c757d; text-transform: uppercase; letter-spacing: 1px; }
        .info-value { font-size: 1rem; font-weight: 600; color: #2b3a4a; margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 5px; }
    </style>
</head>
<body>

<div class="container">
    <div class="card verify-card shadow-lg">
        @php $isActive = ($dealer->status == 'active' && \Carbon\Carbon::parse($dealer->valid_till)->isFuture()); @endphp
        
        <div class="status-banner {{ !$isActive ? 'inactive' : '' }}">
            <i class="bi {{ $isActive ? 'bi-patch-check-fill' : 'bi-exclamation-octagon-fill' }} display-4"></i>
            <h3 class="mt-2 fw-bold">{{ $isActive ? 'OFFICIALLY VERIFIED' : 'INVALID / EXPIRED' }}</h3>
            <p class="small mb-0">Dealer Identity Verification System</p>
        </div>

        <div class="card-body bg-white px-4 pb-5">
            <div class="dealer-logo">
                <i class="bi bi-gear-fill"></i>
            </div>

            <div class="text-center mb-4">
                <h4 class="fw-bold mb-0">{{ $dealer->shop_name }}</h4>
                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 rounded-pill mt-2">
                    ID: {{ $dealer->dealer_id_custom }}
                </span>
            </div>

            <div class="row">
                <div class="col-12">
                    <p class="info-label">Authorized Representative</p>
                    <p class="info-value">{{ $dealer->name }}</p>
                </div>
                <div class="col-6">
                    <p class="info-label">GST Number</p>
                    <p class="info-value">{{ $dealer->gst_no ?? 'N/A' }}</p>
                </div>
                <div class="col-6">
                    <p class="info-label">PAN Number</p>
                    <p class="info-value">{{ $dealer->pan_no ?? 'N/A' }}</p>
                </div>
                <div class="col-12">
                    <p class="info-label">Business Location</p>
                    <p class="info-value">{{ $dealer->district }}, {{ $dealer->state }}</p>
                </div>
                <div class="col-12">
                    <p class="info-label">Validity Period</p>
                    <p class="info-value text-primary">
                        {{ date('d M Y', strtotime($dealer->valid_from)) }} — {{ date('d M Y', strtotime($dealer->valid_till)) }}
                    </p>
                </div>
            </div>

            <div class="alert {{ $isActive ? 'alert-success' : 'alert-danger' }} text-center border-0 mt-3">
                <small class="fw-bold">
                    <i class="bi bi-shield-lock-fill me-1"></i>
                    This dealer is an authorized partner of Khalsa (Punjab Engineers).
                </small>
            </div>
            
            <div class="text-center mt-4">
                <a href="https://khalsagro.com" class="btn btn-outline-secondary btn-sm rounded-pill">
                    Visit Official Website
                </a>
            </div>
        </div>
    </div>
    
    <p class="text-center text-muted small">© {{ date('Y') }} Khalsa Punjab Engineers | Secure Verification Portal</p>
</div>

</body>
</html>