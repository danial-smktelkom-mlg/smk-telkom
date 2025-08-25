<?php
function generateNav($currentPage = '', $isRoot = false) {
    $prefix = $isRoot ? 'pages/' : '';
    $homePrefix = $isRoot ? '' : '../';
    ?>
    <header class="fixed w-full z-50">
        <nav class="bg-white/90 backdrop-blur-md shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="<?php echo $homePrefix; ?>index.html" class="text-2xl font-bold text-primary hover:text-primary-dark transition duration-300">
                            SMK Telkom Malang
                        </a>
                    </div>
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="<?php echo $homePrefix; ?>index.html" 
                           class="<?php echo $currentPage == 'home' ? 'text-gray-900' : 'text-gray-600'; ?> hover:text-primary px-3 py-2 text-sm font-medium transition duration-300">Home</a>
                        <a href="<?php echo $prefix; ?>about.html" 
                           class="<?php echo $currentPage == 'about' ? 'text-gray-900' : 'text-gray-600'; ?> hover:text-primary px-3 py-2 text-sm font-medium transition duration-300">About</a>
                        <a href="<?php echo $prefix; ?>academic.html" 
                           class="<?php echo $currentPage == 'academic' ? 'text-gray-900' : 'text-gray-600'; ?> hover:text-primary px-3 py-2 text-sm font-medium transition duration-300">Academic</a>
                        <a href="<?php echo $prefix; ?>admission.html" 
                           class="<?php echo $currentPage == 'admission' ? 'text-gray-900' : 'text-gray-600'; ?> hover:text-primary px-3 py-2 text-sm font-medium transition duration-300">Admission</a>
                        <a href="<?php echo $prefix; ?>contact.html" 
                           class="<?php echo $currentPage == 'contact' ? 'text-gray-900' : 'text-gray-600'; ?> hover:text-primary px-3 py-2 text-sm font-medium transition duration-300">Contact</a>

                    </div>
                    <div class="md:hidden flex items-center">
                        <button id="mobile-menu-button" class="text-gray-600 hover:text-gray-900 focus:outline-none">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="hidden md:hidden" id="mobile-menu">
                    <div class="px-2 pt-2 pb-3 space-y-1">
                        <?php
                        $mobileMenuItems = [
                            'home' => 'Home',
                            'about' => 'About',
                            'academic' => 'Academic',
                            'admission' => 'Admission',
                            'contact' => 'Contact',
                            'extracurricular' => 'Extracurricular',
                            'facilities' => 'Facilities',
                            'news' => 'News'
                        ];

                        foreach ($mobileMenuItems as $key => $label) {
                            $link = $key == 'home' ? $homePrefix.'index.html' : $prefix.$key.'.html';
                            $class = $currentPage == $key ? 'text-gray-900' : 'text-gray-600';
                            echo "<a href=\"$link\" class=\"$class hover:text-primary block px-3 py-2 text-base font-medium transition duration-300\">$label</a>";
                        }
                        ?>

                    </div>
                </div>
            </div>
        </nav>
    </header>
<?php
}
?>
