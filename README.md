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
smk-boe
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
