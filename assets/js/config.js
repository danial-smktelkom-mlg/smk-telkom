/**
 * Configuration file for website functionality
 * @version 1.0.0
 */

// Tailwind configuration
tailwind.config = {
    theme: {
        extend: {
            colors: {
                primary: 'var(--primary)',
                'primary-dark': 'var(--primary-dark)',
                'primary-light': 'var(--primary-light)',
                'primary-bg': 'var(--primary-bg)',
                success: 'var(--success)',
                warning: 'var(--warning)',
                error: 'var(--error)',
                info: 'var(--info)'
            },
            backgroundColor: {
                'header': 'var(--header-bg)',
                'footer': 'var(--footer-bg)',
                'card': 'var(--card-bg)'
            },
            textColor: {
                default: 'var(--text)',
                light: 'var(--text-light)'
            },
            borderColor: {
                default: 'var(--border)'
            },
            fontFamily: {
                sans: ['Inter', 'sans-serif']
            },
            spacing: {
                '72': '18rem',
                '84': '21rem',
                '96': '24rem'
            }
        }
    }
};

// Global website configuration
const websiteConfig = {
    animationDuration: 800,
    scrollOffset: 100,
    mobileBreakpoint: 768,
    apiEndpoint: '/api',
    imageLoadingPlaceholder: '/assets/images/placeholder.jpg',
    contactEmail: 'info@smktelkom-mlg.sch.id'
};

// Initialize website features
document.addEventListener('DOMContentLoaded', () => {
    // Initialize AOS
    AOS.init({
        duration: websiteConfig.animationDuration,
        offset: websiteConfig.scrollOffset,
        once: true
    });

    // Initialize mobile menu
    initializeMobileMenu();

    // Initialize lazy loading
    initializeLazyLoading();

    // Initialize form validation
    initializeFormValidation();
});

/**
 * Initialize mobile menu functionality
 */
function initializeMobileMenu() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }
}

/**
 * Initialize lazy loading for images
 */
function initializeLazyLoading() {
    const images = document.querySelectorAll('img[loading="lazy"]');
    images.forEach(img => {
        img.onerror = () => {
            img.src = websiteConfig.imageLoadingPlaceholder;
        };
    });
}

/**
 * Initialize form validation
 */
function initializeFormValidation() {
    const forms = document.querySelectorAll('form[data-validate]');
    forms.forEach(form => {
        form.addEventListener('submit', (e) => {
            if (!validateForm(form)) {
                e.preventDefault();
            }
        });
    });
}

/**
 * Validate form inputs
 * @param {HTMLFormElement} form Form element to validate
 * @returns {boolean} Whether form is valid
 */
function validateForm(form) {
    let isValid = true;
    const inputs = form.querySelectorAll('input[required], select[required], textarea[required]');
    
    inputs.forEach(input => {
        if (!input.value.trim()) {
            isValid = false;
            showInputError(input, 'Field ini wajib diisi');
        } else {
            clearInputError(input);
        }
    });

    return isValid;
}

/**
 * Show error message for input
 * @param {HTMLElement} input Input element
 * @param {string} message Error message
 */
function showInputError(input, message) {
    const errorDiv = document.createElement('div');
    errorDiv.className = 'text-error text-sm mt-1';
    errorDiv.textContent = message;
    input.classList.add('border-error');
    input.parentNode.appendChild(errorDiv);
}

/**
 * Clear error message for input
 * @param {HTMLElement} input Input element
 */
function clearInputError(input) {
    input.classList.remove('border-error');
    const errorDiv = input.parentNode.querySelector('.text-error');
    if (errorDiv) {
        errorDiv.remove();
    }
}

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