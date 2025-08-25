<?php
function generateFooter($isRoot = false) {
    $prefix = $isRoot ? 'pages/' : '';
    $homePrefix = $isRoot ? '' : '../';
    ?>
    <footer class="bg-red-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">SMK Telkom Malang</h3>
                    <p class="text-gray-400">Shaping the future through technology and innovation</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="<?php echo $homePrefix; ?>index.html" class="text-gray-400 hover:text-white transition duration-300">Home</a></li>
                        <li><a href="<?php echo $prefix; ?>about.html" class="text-gray-400 hover:text-white transition duration-300">About</a></li>
                        <li><a href="<?php echo $prefix; ?>academic.html" class="text-gray-400 hover:text-white transition duration-300">Academic</a></li>
                        <li><a href="<?php echo $prefix; ?>admission.html" class="text-gray-400 hover:text-white transition duration-300">Admission</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Programs</h3>
                    <ul class="space-y-2">
                        <li><a href="<?php echo $prefix; ?>departments/rpl.html" class="text-gray-400 hover:text-white transition duration-300">Software Engineering</a></li>
                        <li><a href="<?php echo $prefix; ?>departments/tkj.html" class="text-gray-400 hover:text-white transition duration-300">Computer Networking</a></li>
                        <li><a href="<?php echo $prefix; ?>departments/pg.html" class="text-gray-400 hover:text-white transition duration-300">Game Development</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li>Alamat: Jl. Danau Ranau, Sawojajar, Kec. Kedungkandang, Kota Malang, Jawa Timur 65139</li>
                        <li>Email: info@smktelkom-mlg.sch.id</li>
                        <li>Telepon: 0812-2348-8999</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; <?php echo date('Y'); ?> SMK Telkom Malang. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true
        });

        // Mobile menu functionality
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton?.addEventListener('click', () => {
            mobileMenu?.classList.toggle('hidden');
        });
    </script>
<?php
}
?>
