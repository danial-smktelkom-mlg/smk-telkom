<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<header class="fixed w-full z-50">
    <nav class="bg-white/90 backdrop-blur-md shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="../index.html" class="text-2xl font-bold" style="color:#001BB7; transition:color 0.3s;">
                        SMK Telkom Malang
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="../index.html" class="<?= $currentPage == 'index.html' ? 'text-gray-900' : 'text-gray-600' ?> hover:text-primary px-3 py-2 text-sm font-medium transition duration-300">Home</a>
                    <a href="about.html" class="<?= $currentPage == 'about.html' ? 'text-gray-900' : 'text-gray-600' ?> hover:text-primary px-3 py-2 text-sm font-medium transition duration-300">About</a>
                    <a href="academic.html" class="<?= $currentPage == 'academic.html' ? 'text-gray-900' : 'text-gray-600' ?> hover:text-primary px-3 py-2 text-sm font-medium transition duration-300">Academic</a>
                    <a href="admission.html" class="<?= $currentPage == 'admission.html' ? 'text-gray-900' : 'text-gray-600' ?> hover:text-primary px-3 py-2 text-sm font-medium transition duration-300">Admission</a>
                    <a href="contact.html" class="<?= $currentPage == 'contact.html' ? 'text-gray-900' : 'text-gray-600' ?> hover:text-primary px-3 py-2 text-sm font-medium transition duration-300">Contact</a>
                    <a href="extracurricular.html" class="<?= $currentPage == 'extracurricular.html' ? 'text-gray-900' : 'text-gray-600' ?> hover:text-primary px-3 py-2 text-sm font-medium transition duration-300">Extracurricular</a>
                    <a href="extracurricular-registration.php" class="<?= $currentPage == 'extracurricular-registration.php' ? 'text-gray-900' : 'text-gray-600' ?> hover:text-primary px-3 py-2 text-sm font-medium transition duration-300">Registration</a>
                    <a href="manage-registration.php" class="<?= $currentPage == 'manage-registration.php' ? 'text-gray-900' : 'text-gray-600' ?> hover:text-primary px-3 py-2 text-sm font-medium transition duration-300">Manage Registration</a>
                    <a href="facilities.html" class="<?= $currentPage == 'facilities.html' ? 'text-gray-900' : 'text-gray-600' ?> hover:text-primary px-3 py-2 text-sm font-medium transition duration-300">Facilities</a>
                    <a href="news.html" class="<?= $currentPage == 'news.html' ? 'text-gray-900' : 'text-gray-600' ?> hover:text-primary px-3 py-2 text-sm font-medium transition duration-300">News</a>
                    <a href="ai-chat.html" class="text-white px-3 py-2 text-sm font-medium rounded-md transition duration-300" style="background-color:#001BB7;" onmouseover="this.style.backgroundColor='#001090'" onmouseout="this.style.backgroundColor='#001BB7'">AI Chat</a>
                </div>
                <div class="md:hidden flex items-center">
                    <button class="text-gray-600 hover:text-gray-900 focus:outline-none" id="mobile-menu-button">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
            <!-- Mobile menu -->
            <div class="hidden md:hidden" id="mobile-menu">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="../index.html" class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-primary transition duration-300">Home</a>
                    <a href="about.html" class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-primary transition duration-300">About</a>
                    <a href="academic.html" class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-primary transition duration-300">Academic</a>
                    <a href="admission.html" class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-primary transition duration-300">Admission</a>
                    <a href="contact.html" class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-primary transition duration-300">Contact</a>
                    <a href="extracurricular.html" class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-primary transition duration-300">Extracurricular</a>
                    <a href="extracurricular-registration.php" class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-primary transition duration-300">Registration</a>
                    <a href="facilities.html" class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-primary transition duration-300">Facilities</a>
                    <a href="news.html" class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-primary transition duration-300">News</a>
                    <a href="ai-chat.html" class="block px-3 py-2 text-base font-medium text-white rounded-md transition duration-300" style="background-color:#001BB7;">AI Chat</a>
                </div>
            </div>
        </div>
    </nav>
</header>

<script>
    // Mobile menu toggle
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>