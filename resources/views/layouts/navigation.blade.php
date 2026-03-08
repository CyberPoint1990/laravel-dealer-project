<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom px-4 shadow-sm sticky-top">
    <div class="d-flex align-items-center">
        <button class="btn btn-light border-0 rounded-circle me-3 shadow-sm hover-scale" id="menu-toggle">
            <i class="bi bi-list fs-5"></i>
        </button>
        
        <div class="search-container d-none d-lg-flex align-items-center bg-light rounded-pill px-3 py-1 border">
            <i class="bi bi-search text-muted me-2"></i>
            <input type="text" class="form-control border-0 bg-transparent shadow-none p-1 text-sm" 
                   placeholder="Quick search..." style="width: 200px; font-size: 0.85rem;">
        </div>
    </div>

    <div class="ms-auto d-flex align-items-center">
        <button class="btn btn-link text-dark p-2 me-3 rounded-circle hover-bg-light" id="theme-toggle" title="Toggle Theme">
            <i class="bi bi-moon-stars" id="theme-icon"></i>
        </button>

        <div class="me-3 position-relative">
            <button class="btn btn-link text-dark p-2 rounded-circle hover-bg-light">
                <i class="bi bi-bell"></i>
                <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
            </button>
        </div>

        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle gap-2 p-1 rounded-pill hover-bg-light"
               id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="avatar-wrapper position-relative">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Admin') }}&background=0d6efd&color=fff&bold=true" 
                         class="rounded-circle border border-2 border-white shadow-sm" width="35" alt="user">
                    <span class="position-absolute bottom-0 end-0 p-1 bg-success border border-white rounded-circle"></span>
                </div>
                <div class="d-none d-md-block text-start leading-tight">
                    <p class="mb-0 small fw-bold text-dark">{{ Auth::user()->name ?? 'Administrator' }}</p>
                    <p class="mb-0 text-muted" style="font-size: 0.7rem;">System Root</p>
                </div>
            </a>
            
            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-3 p-2 rounded-4 animate slideIn" aria-labelledby="profileDropdown">
                <li><h6 class="dropdown-header text-uppercase tracking-wider fw-bold text-[10px] text-muted">User Controls</h6></li>
                <li><a class="dropdown-item rounded-3 py-2" href="{{ route('profile.edit') }}"><i class="bi bi-person-circle me-3"></i>My Profile</a></li>
                <li><a class="dropdown-item rounded-3 py-2" href="#"><i class="bi bi-shield-check me-3"></i>Security</a></li>
                <li><hr class="dropdown-divider opacity-50"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger rounded-3 py-2 fw-bold">
                            <i class="bi bi-box-arrow-right me-3"></i>Sign Out
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    .hover-scale:hover { transform: scale(1.05); transition: 0.2s; }
    .hover-bg-light:hover { background-color: #f8f9fa; transition: 0.2s; }
    .dropdown-item:hover { background-color: #f0f7ff; color: #0d6efd; }
    .dropdown-item.text-danger:hover { background-color: #fff5f5; color: #dc3545; }
    .rounded-4 { border-radius: 1rem; }
    
    /* Animation for dropdown */
    .animate { animation-duration: 0.2s; -webkit-animation-duration: 0.2s; animation-fill-mode: both; }
    @keyframes slideIn {
        0% { transform: translateY(1rem); opacity: 0; }
        100% { transform: translateY(0rem); opacity: 1; }
    }
    .slideIn { animation-name: slideIn; }
</style>