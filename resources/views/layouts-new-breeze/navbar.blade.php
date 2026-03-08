<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom px-3 shadow-sm">
    <button class="btn btn-light me-3" id="menu-toggle">
        <i class="bi bi-list"></i>
    </button>
    
    <div class="search-container d-none d-md-flex align-items-center">
        <div class="input-group">
            <span class="input-group-text bg-transparent border-0 pe-0">
                <i class="bi bi-search text-muted"></i>
            </span>
            <input type="text" class="form-control border-0 bg-transparent shadow-none ps-2" 
                   placeholder="Search here..." style="width: 250px;">
        </div>
    </div>

    <div class="ms-auto d-flex align-items-center">
        <button class="btn btn-link text-dark p-0 me-3" id="theme-toggle" title="Toggle Theme">
            <i class="bi bi-brightness-high" id="theme-icon"></i>
        </button>

        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle"
                id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://ui-avatars.com/api/?name=Admin&background=448aff&color=fff" 
                     class="rounded-circle" width="30" alt="user">
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" aria-labelledby="profileDropdown">
                <li><h6 class="dropdown-header">Welcome, {{ Auth::user()->name ?? 'Admin' }}</h6></li>
                <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i> My Profile</a></li>
                <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i> Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item text-danger" href="#">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>