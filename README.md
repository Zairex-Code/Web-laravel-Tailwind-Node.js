# 📢 Programming Q&A Forum (Laravel 12)

Welcome to the "Programming Forum" project! This is a Q&A platform built with **Laravel 12**, **Tailwind CSS v4**, and **Blade Components**.

It serves as a learning base for understanding core Laravel concepts like:
- **Models & Relationships** (One-to-Many)
- **Database Seeders & Factories**
- **Route Model Binding**
- **Eager Loading vs Lazy Loading** (`with` vs `load`)
- **Blade Layouts & Components**

---

## 🎓 Learning Resources

Check out the `GUIA_DIDACTICA.md` file in this repository for a detailed explanation of the code using analogies (House Construction, Restaurant, Traffic Control).

---

## 🛠️ Installation Guide (Windows)

This guide is designed for setting up the project on a Windows machine (e.g., at university) after cloning it from GitHub.

### 1. Prerequisites
Ensure the computer has the following installed:
- **PHP** (v8.2 or higher)
- **Composer** (Dependency Manager for PHP)
- **Node.js** (v18 or higher) & **NPM**
- **Git**
- A database server (MySQL/MariaDB via XAMPP, Laragon, or standalone)

### 2. Clone the Repository
Open your terminal (PowerShell, Git Bash, or CMD) and run:
```bash
git clone <YOUR_REPOSITORY_URL>
cd web-laravel
```

### 3. Install Backend Dependencies
Download the PHP libraries required by Laravel:
```bash
composer install
```

### 4. Install Frontend Dependencies
Download the JavaScript libraries for Tailwind CSS and Vite:
```bash
npm install
```

### 5. Environment Configuration
Copy the example environment file to create your own `.env`:
```bash
cp .env.example .env
```
*Note: On Windows CMD, use `copy .env.example .env` instead.*

Open the `.env` file and configure your database settings:
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_forum  <-- Create this empty database in your MySQL (phpMyAdmin/HeidiSQL)
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Generate App Key
This key secures your user sessions and encrypted data:
```bash
php artisan key:generate
```

### 7. Run Migrations & Seeders
Build the database structure and fill it with fake data:
```bash
php artisan migrate --seed
```

### 8. Launch the Application
You need two terminals running simultaneously:

**Terminal 1 (Backend Server):**
```bash
php artisan serve
```

**Terminal 2 (Frontend Build/Watch):**
```bash
npm run dev
```

Visit `http://localhost:8000` in your browser. Happy coding! 🚀

---

## 🐧 Installation (Linux/Mac)
Same steps as above, generally relying on your installed package managers (`apt`, `brew`, etc).

## 🤝 Contributing
Feel free to fork this project and submit Pull Requests to improve the learning material!


In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
