<div id="sidebar-wrapper">
    <div class="sidebar-heading d-flex align-items-center p-4">
        <div class="brand-logo me-2">
            <i class="bi bi-triangle-fill text-white"></i>
        </div>
        <h5 class="m-0 text-white fw-bold">Khalsa desk</h5>
    </div>

    <div class="list-group list-group-flush" id="sidebarAccordion">
        <small class="nav-title px-4 py-2 d-block">NAVIGATION</small>

        <a href="{{ url('/') }}" class="list-group-item list-group-item-action {{ Request::is('/') ? 'active' : 'collapsed' }}"
            data-bs-toggle="collapse" data-bs-target="#dashDropdown" aria-expanded="{{ Request::is('/') ? 'true' : 'false' }}">
            <i class="bi bi-house-door me-3"></i> Dashboard
            <!-- <i class="bi bi-chevron-down arrow-icon ms-auto"></i> -->
        </a>

        <a href="#empDropdown" class="list-group-item list-group-item-action {{ Request::is('employees*') ? 'active' : 'collapsed' }}"
            data-bs-toggle="collapse" aria-expanded="{{ Request::is('employees*') ? 'true' : 'false' }}">
            <i class="bi bi-people me-3"></i> Employees
            <i class="bi bi-chevron-down arrow-icon ms-auto"></i>
        </a>
        <div class="collapse {{ Request::is('employees*') ? 'show' : '' }}" id="empDropdown" data-bs-parent="#sidebarAccordion">
            <div class="list-group">
                <a href="{{ url('/employees') }}" class="list-group-item sub-menu-item {{ Request::is('employees') ? 'active' : '' }}">
                    <i class="bi bi-person-badge me-2"></i> All Employees
                </a>
                <a href="{{ url('/employees/create') }}" class="list-group-item sub-menu-item {{ Request::is('employees/create') ? 'active' : '' }}">
                    <i class="bi bi-person-plus me-2"></i> Add New
                </a>
            </div>
        </div>

        <a href="#dealerDropdown" class="list-group-item list-group-item-action {{ Request::is('dealers*') ? 'active' : 'collapsed' }}"
    data-bs-toggle="collapse" aria-expanded="{{ Request::is('dealers*') ? 'true' : 'false' }}">
    <i class="bi bi-shop me-3"></i> Dealers
    <i class="bi bi-chevron-down arrow-icon ms-auto"></i>
</a>
<div class="collapse {{ Request::is('dealers*') ? 'show' : '' }}" id="dealerDropdown" data-bs-parent="#sidebarAccordion">
    <div class="list-group">
        <a href="{{ url('/dealers/create') }}" class="list-group-item sub-menu-item {{ Request::is('dealers/create') ? 'active' : '' }}">
            <i class="bi bi-plus-circle me-2"></i> Add Dealers
        </a>
        <a href="{{ url('/dealers') }}" class="list-group-item sub-menu-item {{ Request::is('dealers') ? 'active' : '' }}">
            <i class="bi bi-list-ul me-2"></i> All Dealers
        </a>
        <a href="{{ url('/dealers/certificates') }}" class="list-group-item sub-menu-item {{ Request::is('dealers/certificates') ? 'active' : '' }}">
            <i class="bi bi-patch-check me-2"></i> Certificates
        </a>
        
    </div>
</div>

        <small class="nav-title px-4 py-2 d-block mt-3">HR PANEL</small>

        <a href="#payrollDropdown" class="list-group-item list-group-item-action {{ Request::is('payroll*') ? 'active' : 'collapsed' }}"
            data-bs-toggle="collapse" aria-expanded="{{ Request::is('payroll*') ? 'true' : 'false' }}">
            <i class="bi bi-cash-stack me-3"></i> Payroll
            <!-- <span class="badge badge-pro rounded-pill ms-2">Pro</span> -->
            <i class="bi bi-chevron-down arrow-icon ms-auto"></i>
        </a>
        <div class="collapse {{ Request::is('payroll*') ? 'show' : '' }}" id="payrollDropdown" data-bs-parent="#sidebarAccordion">
            <div class="list-group">
                <a href="{{ url('/payroll/slips') }}" class="list-group-item sub-menu-item {{ Request::is('payroll/slips') ? 'active' : '' }}">
                    <i class="bi bi-receipt me-2"></i> Salary Slips
                </a>
                <a href="{{ url('/payroll/tax') }}" class="list-group-item sub-menu-item {{ Request::is('payroll/tax') ? 'active' : '' }}">
                    <i class="bi bi-bank me-2"></i> Tax Deductions
                </a>
            </div>
        </div>

        <a href="{{ url('/attendance') }}" class="list-group-item list-group-item-action {{ Request::is('attendance') ? 'active' : '' }}">
            <i class="bi bi-calendar-check me-3"></i> Attendance
        </a>

        <small class="nav-title px-4 py-2 d-block mt-3">SYSTEM</small>

        <a href="{{ url('/settings') }}" class="list-group-item list-group-item-action {{ Request::is('settings') ? 'active' : '' }}">
            <i class="bi bi-gear me-3"></i> Settings
        </a>
    </div>

    <div class="sidebar-footer mt-auto border-top border-secondary">
    <div class="list-group list-group-flush pb-2">
        <a href="" 
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="list-group-item list-group-item-action text-danger border-0 py-2 bg-transparent">
            <i class="bi bi-box-arrow-right me-3"></i> <span>Sign Out</span>
        </a>

        <form id="logout-form" action="" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>
</div>