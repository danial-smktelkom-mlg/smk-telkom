// Tailwind configuration
tailwind.config = {
    theme: {
        extend: {
            colors: {
                primary: '#001BB7',
                'primary-dark': '#001694'
            }
        }
    }
};

// AOS initialization
document.addEventListener('DOMContentLoaded', function() {
    AOS.init({
        duration: 800,
        offset: 100,
        once: true
    });

    // Mobile menu functionality (if exists)
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }
});
