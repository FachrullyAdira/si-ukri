# SI_UKRI

![Logo SI UKRI](/public/images/logo-si-ukri.png)

## Overview

**SI_UKRI** (Sistem Informasi UKRI) is a Laravel‑based web application designed to manage university‑level activities, courses, tasks, and student data.  It provides a clean admin panel (Filament) for staff, teachers, and students to interact with the system.

## Features

- **User Management** – Admin, Dosen, Mahasiswa roles with permission policies.
- **Course & Schedule** – Manage classes, schedules, and academic calendars.
- **Task & Assignment** – Create, submit, and grade assignments.
- **Media Library** – Store images, PDFs and other resources using Laravel Media‑Library.
- **Responsive UI** – Built with Tailwind CSS and Filament components.

## Installation

```bash
# Clone the repository
git clone https://github.com/FachrullyAdira/si-ukri.git
cd si-ukri

# Install PHP dependencies
composer install

# Install JS dependencies
npm install && npm run dev

# Copy env file and generate key
cp .env.example .env
php artisan key:generate

# Run migrations and seeders
php artisan migrate --seed

# Serve the application
php artisan serve
```

> **Note**: The repository uses **PHP 8.2**, **Laravel 10**, and **Node 20**. Adjust versions if required.

## Configuration

- Set up your database credentials in the `.env` file.
- Configure mail settings if you need email notifications.
- Optionally adjust the `APP_URL` and `APP_ENV` variables.

## Usage

Visit `http://127.0.0.1:8000` in your browser.  Log in with the seeded admin account (check the `PengaturanSitusSeeder` for default credentials) and explore the Filament admin panel.

## Logo Explanation

- **`public/images/logo-himasi.svg`** – The main logo of the Himpunan Mahasiswa Sistem Informasi (HIMASI). It is used throughout the navigation bar and the login page.
- **`public/images/logo-kampus.png`** – The university‑wide logo displayed on the footer and some public pages.

Both logos are stored in the `public/images` folder so they can be served directly by the web server.  The SVG logo scales without loss of quality, while the PNG logo is a raster image used where vector support is not required.

## Contributing

1. Fork the repository.
2. Create a feature branch (`git checkout -b feature/your-feature`).
3. Commit your changes (`git commit -m "Add …"`).
4. Push to your fork (`git push origin feature/your-feature`).
5. Open a Pull Request against `main`.

## License

This project is licensed under the **MIT License** – see the `LICENSE` file for details.
