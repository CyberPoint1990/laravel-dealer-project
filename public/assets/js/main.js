document.addEventListener("DOMContentLoaded", function() {
    // Selectors
    const wrapper = document.getElementById('wrapper');
    const menuToggle = document.getElementById('menu-toggle');
    const themeToggle = document.getElementById('theme-toggle');
    const themeIcon = document.getElementById('theme-icon');
    const htmlElement = document.documentElement;
    const navLinks = document.querySelectorAll('.list-group-item');
    const collapses = document.querySelectorAll('.collapse');

    // --- 1. DARK MODE LOGIC ---
    function setTheme(theme) {
        htmlElement.setAttribute('data-theme', theme);
        localStorage.setItem('theme', theme);
        
        if (theme === 'dark') {
            themeIcon?.classList.replace('bi-brightness-high', 'bi-moon-stars-fill');
            themeToggle?.classList.replace('text-dark', 'text-warning');
        } else {
            themeIcon?.classList.replace('bi-moon-stars-fill', 'bi-brightness-high');
            themeToggle?.classList.replace('text-warning', 'text-dark');
        }
    }

    if (themeToggle) {
        themeToggle.addEventListener('click', () => {
            const isDark = htmlElement.getAttribute('data-theme') === 'dark';
            setTheme(isDark ? 'light' : 'dark');
        });
    }

    // Initial Theme Load
    setTheme(localStorage.getItem('theme') || 'light');


    // --- 2. SIDEBAR TOGGLE (Desktop & Mobile) ---
    if (menuToggle && wrapper) {
        menuToggle.addEventListener('click', (e) => {
            e.preventDefault();
            wrapper.classList.toggle('toggled');
        });
    }


    // --- 3. ACTIVE CLASS & AUTO-CLOSE (Mobile) ---
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            // Dropdown triggers par active line change nahi hogi
            if (this.hasAttribute('data-bs-toggle')) return;

            navLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
            
            // Mobile par link click karte hi sidebar band ho jaye
            if (window.innerWidth < 992) {
                wrapper.classList.remove('toggled');
            }
        });
    });


    // --- 4. DROPDOWN ANIMATION & STATE ---
    collapses.forEach(collapseEl => {
        collapseEl.addEventListener('show.bs.collapse', function() {
            const parentLink = document.querySelector(`[href="#${this.id}"]`);
            if (parentLink) parentLink.classList.add('menu-open');
        });

        collapseEl.addEventListener('hide.bs.collapse', function() {
            const parentLink = document.querySelector(`[href="#${this.id}"]`);
            if (parentLink) parentLink.classList.remove('menu-open');
        });
    });
});