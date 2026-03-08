<div aria-live="polite" aria-atomic="true" class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080;">
    
    {{-- Success Alert --}}
    @if(session('success'))
    <div class="alert alert-success border-0 shadow-lg rounded-4 d-flex align-items-center mb-2 animate__animated animate__slideInUp" role="alert">
        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="min-width: 35px; height: 35px;">
            <i class="bi bi-check-lg"></i>
        </div>
        <div class="me-4">
            <strong class="d-block small fw-bold">Success!</strong>
            <span class="small">{{ session('success') }}</span>
        </div>
        <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- Error Alert --}}
    @if(session('error') || $errors->any())
    <div class="alert alert-danger border-0 shadow-lg rounded-4 d-flex align-items-center mb-2 animate__animated animate__shakeX" role="alert">
        <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="min-width: 35px; height: 35px;">
            <i class="bi bi-exclamation-triangle"></i>
        </div>
        <div class="me-4">
            <strong class="d-block small fw-bold">Error Occurred</strong>
            <span class="small">
                @if(session('error'))
                    {{ session('error') }}
                @else
                    Please fix the form errors.
                @endif
            </span>
        </div>
        <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

</div>

<style>
    /* Agar Animate.css use nahi kar rahe toh ye simple transition kaam karegi */
    .animate__slideInUp {
        animation: slideUp 0.5s ease-out;
    }
    @keyframes slideUp {
        from { transform: translateY(100%); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    
    /* Toast look for Alert */
    .alert {
        min-width: 300px;
        max-width: 400px;
    }
</style>

<script>
    // 5 seconds baad auto-close logic
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            let alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                let bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    });
</script>