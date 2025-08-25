# SMK Telkom Malang Website

This project is a website for SMK Telkom Malang, designed to provide a responsive and user-friendly experience. The website includes various pages that offer information about the school, its academic programs, admission process, extracurricular activities, and a student graduation information system.

## Quick Start with Docker

### Prerequisites
- Docker installed on your system
- Docker Compose (optional, for development)

### Running with Docker

1. Pull and run the image directly:
```bash
docker run -d -p 80:80 --name smk-telkom danialsmktelkommlg/smk-telkom-web:latest
```

2. Or build and run locally:
```bash
# Clone the repository
git clone https://github.com/danial-smktelkom-mlg/smk-telkom.git
cd smk-telkom

# Build the image
docker build -t smk-telkom-web .

# Run the container
docker run -d -p 80:80 --name smk-telkom smk-telkom-web
```

### Docker Features
- Single container running PHP-FPM and Nginx
- Persistent data volume for assets/data
- Automatic health checks
- Process management with Supervisord
- Proper file permissions and security

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
smk-telkom-malang
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

### Method 1: Using Docker (Recommended)
1. Make sure Docker is installed on your system
2. Run the container as shown in the Quick Start section
3. Access the website at http://localhost

### Method 2: Traditional Setup
1. Clone the repository to your local machine
2. Set up a PHP server environment (e.g., XAMPP, MAMP)
3. Import the graduation database from `assets/data/kelulusan-siswa.csv`
4. Configure database connection in `kelulusan/config.php`
5. Access the website through your PHP server

### Docker Development
For development with Docker:
1. Mount your local directory for live development:
```bash
docker run -d -p 80:80 -v $(pwd):/var/www/html --name smk-telkom-dev smk-telkom-web
```

2. Access logs:
```bash
# View Nginx and PHP-FPM logs
docker logs smk-telkom-dev

# Access container shell
docker exec -it smk-telkom-dev sh
```

3. Container Management:
```bash
# Stop container
docker stop smk-telkom-dev

# Start container
docker start smk-telkom-dev

# Remove container
docker rm smk-telkom-dev
```

## Technical Details

### Website
- Responsive design with custom CSS
- Interactive features with JavaScript
- Clean and modern user interface


### Graduation System
- Secure authentication system
- CSV-based data management
- PDF generation for graduation certificates
- Supports 324 students data:
  - RPL: 108 students (3 classes)
  - TKJ: 104 students (3 classes)
  - PG: 100 students (3 classes)

## Technical Stack

### Website Frontend
- HTML5, CSS3, JavaScript
- Responsive design with custom CSS
- Interactive features with vanilla JavaScript
- Clean and modern user interface

### Backend
- PHP 8.2 with PHP-FPM
- Nginx web server
- CSV-based data storage
- FPDF for PDF generation

### Docker Environment
- Base image: php:8.2-fpm-alpine
- Nginx for web serving
- Supervisord for process management
- Optimized for production use
- Volume support for persistent data

## Maintenance

Last updated: August 25, 2025
Current academic year: 2025/2026
Data format: NIS (20250001-20250312), Name, Class, Score

## Contributing

1. Fork the repository
2. Create your feature branch: `git checkout -b feature/my-new-feature`
3. Commit your changes: `git commit -am 'Add some feature'`
4. Push to the branch: `git push origin feature/my-new-feature`
5. Submit a pull request

## License

This project is licensed under the MIT License - see the LICENSE file for details