<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dealer Directory Report - {{ now()->format('d-m-Y') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; }
        .print-container { background: white; padding: 50px; margin: 20px auto; box-shadow: 0 0 15px rgba(0,0,0,0.05); max-width: 1100px; border-radius: 8px; }
        
        @media print {
            @page { size: A4 landscape; margin: 1cm; }
            body { background: white; }
            .print-container { box-shadow: none; margin: 0; max-width: 100%; width: 100%; padding: 10px; }
            .no-print { display: none !important; }
            .table thead th { background-color: #2b3a4a !important; color: white !important; -webkit-print-color-adjust: exact; }
            .badge-active { color: #198754 !important; }
            .badge-inactive { color: #dc3545 !important; }
        }

        .report-header { border-bottom: 3px solid #2b3a4a; margin-bottom: 25px; padding-bottom: 15px; }
        .table { font-size: 0.85rem; vertical-align: middle; }
        .table thead th { background-color: #2b3a4a; color: white; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.5px; }
        
        .badge-active { color: #198754; font-weight: bold; }
        .badge-inactive { color: #dc3545; font-weight: bold; }
        .company-logo { font-size: 2rem; color: #2b3a4a; font-weight: 800; letter-spacing: -1px; }
    </style>
</head>
<body>

    <div class="container mt-4 no-print text-center">
        <div class="alert alert-info d-inline-block py-2 px-4 shadow-sm">
            <i class="bi bi-info-circle me-2"></i> Best printed in <strong>Landscape</strong> mode.
        </div>
        <div class="mt-2">
            <button onclick="window.print()" class="btn btn-primary px-4 fw-bold shadow">
                <i class="bi bi-printer-fill me-2"></i> Print Report
            </button>
            <button onclick="window.close()" class="btn btn-light px-4 ms-2 border">Close</button>
        </div>
    </div>

    <div class="print-container">
        <div class="report-header d-flex justify-content-between align-items-end">
            <div>
                <div class="company-logo">KHALSA <i class="bi bi-gear-fill"></i></div>
                <h4 class="fw-bold mb-0 text-primary">Dealer Directory Report</h4>
                <p class="text-muted mb-0 small"><i class="bi bi-geo-alt-fill me-1"></i> Global Partner Network</p>
            </div>
            <div class="text-end">
                <h5 class="fw-bold mb-0 text-uppercase">Khalsa Punjab Engineers</h5>
                <p class="mb-0 small text-muted">Baghpat Road, Meerut (U.P.)</p>
                <div class="badge bg-dark mt-2">Report ID: #RP-{{ date('YmdHi') }}</div>
            </div>
        </div>

        <div class="row mb-3 g-2 no-print">
            <div class="col-3">
                <div class="p-2 border rounded bg-light text-center">
                    <small class="text-muted d-block">Total Dealers</small>
                    <span class="fw-bold h5">{{ count($dealers_all) }}</span>
                </div>
            </div>
        </div>

        <table class="table table-striped table-bordered">
            <thead>
                <tr class="text-center">
                    <th>Dealer ID</th>
                    <th>Business Details</th>
                    <th>Tax Info</th>
                    <th>Location</th>
                    <th>Validity</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dealers_all as $dealer)
                <tr>
                    <td class="text-center fw-bold text-primary" style="background: #f8f9ff;">
                        {{ $dealer->dealer_id_custom }}
                    </td>
                    <td>
                        <div class="fw-bold text-dark">{{ $dealer->shop_name }}</div>
                        <div class="small text-muted"><i class="bi bi-person me-1"></i>{{ $dealer->name }}</div>
                        <div class="small text-muted"><i class="bi bi-telephone me-1"></i>{{ $dealer->phone }}</div>
                    </td>
                    <td>
                        <div class="small"><strong>GST:</strong> {{ $dealer->gst_no ?? 'N/A' }}</div>
                        <div class="small"><strong>PAN:</strong> {{ $dealer->pan_no ?? 'N/A' }}</div>
                    </td>
                    <td>
                        <div class="small">{{ $dealer->district }}, {{ $dealer->state }}</div>
                        <div class="text-muted" style="font-size: 0.7rem;">{{ Str::limit($dealer->address, 40) }}</div>
                    </td>
                    <td class="text-center">
                        <div class="small fw-bold text-primary">{{ date('d/m/y', strtotime($dealer->valid_till)) }}</div>
                        @if(\Carbon\Carbon::parse($dealer->valid_till)->isPast())
                            <span class="text-danger" style="font-size: 0.65rem;">Expired</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <span class="{{ $dealer->status == 'active' ? 'badge-active' : 'badge-inactive' }}">
                            <i class="bi {{ $dealer->status == 'active' ? 'bi-check-circle-fill' : 'bi-x-circle-fill' }} me-1"></i>
                            {{ strtoupper($dealer->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted">
                        <i class="bi bi-folder-x display-4 d-block mb-2"></i>
                        No dealer records found in the system.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-5 pt-4 d-flex justify-content-between align-items-end">
            <div class="small text-muted">
                <p class="mb-1"><strong>Generated By:</strong> {{ Auth::user()->name ?? 'System Admin' }}</p>
                <p class="mb-1"><strong>Date & Time:</strong> {{ now()->format('d M, Y | h:i A') }}</p>
                <p class="mb-0 italic"><i class="bi bi-info-circle me-1"></i> This is an auto-generated official document.</p>
            </div>
            
            <div class="text-center" style="width: 250px;">
                <div style="height: 60px;"></div> <div class="border-top pt-2">
                    <p class="mb-0 fw-bold">Authorized Signatory</p>
                    <small class="text-muted">Khalsa Punjab Engineers</small>
                </div>
            </div>
        </div>
    </div>

</body>
</html>