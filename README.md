# SMK BOE Malang Website

This project is a website for SMK BOE Malang, designed to provide a responsive and user-friendly experience. The website includes various pages that offer information about the school, its academic programs, admission process, extracurricular activities, and a student graduation information system.

## Project Features

1. **School Information Website**
   - Complete school profile and information
   - Academic programs details for RPL, TKJ, and PG departments
   - Information about facilities and extracurricular activities
   - News and updates section
   - Contact information and admission details

2. **Student Graduation Information System**
   - Secure admin dashboard for data management
   - Student graduation data management
   - PDF export functionality
   - User-friendly interface for students to check their results
   - Supports 324 students across 9 classes (3 departments × 3 classes)

## Project Structure

```
# SMK BOE Malang Website

Website resmi SMK BOE Malang yang menyediakan informasi sekolah, pendaftaran ekstrakurikuler, dan sistem kelulusan siswa.

## Fitur

### 1. Informasi Sekolah
- Halaman Beranda (`index.html`)
- Tentang Sekolah (`pages/about.html`)
- Program Akademik (`pages/academic.html`)
- Fasilitas (`pages/facilities.html`)
- Jurusan
  - Pengembangan Game (`pages/departments/pg.html`)
  - Rekayasa Perangkat Lunak (`pages/departments/rpl.html`)
  - Teknik Komputer dan Jaringan (`pages/departments/tkj.html`)

### 2. Pendaftaran Ekstrakurikuler
- Form Pendaftaran (`pages/extracurricular-registration.php`)
- Kelola Pendaftaran (`pages/manage-registration.php`)
- Daftar Ekstrakurikuler (`pages/extracurricular.html`)
- Data tersimpan dalam CSV (`assets/data/pendaftaran-ekskur.csv`)

### 3. Sistem Kelulusan
- Halaman Utama (`kelulusan/home.php`)
- Dashboard Admin (`kelulusan/admin-dashboard.php`)
- Input Data (`kelulusan/admin-input.php`)
- Lihat Data (`kelulusan/list.php`)
- Export PDF (`kelulusan/export-pdf.php`)
- Data tersimpan dalam CSV (`assets/data/kelulusan-siswa.csv`)

### 4. Area Admin
- Dashboard (`pages/admin/dashboard.php`)
- Edit Data (`pages/admin/edit.php`)
- Login/Logout (`pages/admin/login.php`, `pages/admin/logout.php`)

## Teknologi yang Digunakan

- HTML5 & CSS3
- Tailwind CSS untuk styling
- JavaScript
- PHP untuk backend
- CSV untuk penyimpanan data

## Struktur Folder

```
smk-boe/
├── assets/
│   ├── css/
│   ├── data/
│   ├── font/
│   └── js/
├── components/
├── includes/
├── kelulusan/
├── pages/
│   ├── admin/
│   └── departments/
└── index.html
```

## Cara Menjalankan

1. Pastikan server web (Apache) dan PHP sudah terinstall
2. Clone repository ini ke folder htdocs:
   ```bash
   git clone https://github.com/danial-smktelkom-mlg/smk-boe.git
   ```
3. Buka browser dan akses:
   ```
   http://localhost/smk-boe
   ```

## Pengembangan

- Website menggunakan Tailwind CSS untuk styling
- Menyimpan data dalam format CSV
- Implementasi sistem login untuk admin
- Validasi form dan keamanan data
- Responsif untuk berbagai ukuran layar

## Kontribusi

1. Fork repository
2. Buat branch baru: `git checkout -b fitur-baru`
3. Commit perubahan: `git commit -am 'Menambah fitur baru'`
4. Push ke branch: `git push origin fitur-baru`
5. Submit pull request

## Lisensi

© 2025 SMK BOE Malang. All rights reserved.
├── index.html               # Main entry point of the website
├── assets/
│   ├── css/
│   │   └── style.css       # Custom styles for the website
│   ├── data/
│   │   └── kelulusan-siswa.csv  # Student graduation database
│   ├── font/               # Font files for PDF generation
│   └── js/
│       └── config.js       # JavaScript configurations
├── kelulusan/              # Graduation System
│   ├── admin-dashboard.php # Admin control panel
│   ├── admin-input.php     # Data input interface
│   ├── config.php         # System configuration
│   ├── export-pdf.php     # PDF export functionality
│   ├── fpdf.php          # PDF generation library
│   ├── home.php          # System home page
│   ├── list.php          # Graduation list
│   ├── login.php         # Authentication
│   ├── logout.php        # Session management
│   └── user-view.php     # Student result view
├── pages/
│   ├── about.html        # School information
│   ├── academic.html     # Academic programs
│   ├── admission.html    # Admission process
│   ├── ai-chat.html      # AI Chat assistant
│   ├── contact.html      # Contact information
│   ├── departments/
│   │   ├── pg.html      # Game Development
│   │   ├── rpl.html     # Software Engineering
│   │   └── tkj.html     # Computer Networking
│   ├── extracurricular.html
│   ├── facilities.html
│   └── news.html
└── README.md             # Project documentation
```

## Setup Instructions

1. Clone the repository to your local machine
2. Set up a PHP server environment (e.g., XAMPP, MAMP)
3. Import the graduation database from `assets/data/kelulusan-siswa.csv`
4. Configure database connection in `kelulusan/config.php`
5. Access the website through your PHP server

## Technical Details

### Website
- Responsive design with custom CSS
- Interactive features with JavaScript
- Clean and modern user interface
- AI-powered chat assistant for student inquiries

### Graduation System
- Secure authentication system
- CSV-based data management
- PDF generation for graduation certificates
- Supports 324 students data:
  - RPL: 108 students (3 classes)
  - TKJ: 104 students (3 classes)
  - PG: 100 students (3 classes)

## Maintenance

Last updated: August 13, 2025
Current academic year: 2025/2026
Data format: NIS (20250001-20250312), Name, Class, Score
