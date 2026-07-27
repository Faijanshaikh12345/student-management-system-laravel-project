# 🎓 Student Management System (Laravel)

A complete Student Management System built with Laravel to manage students, teachers, classes, sections, subjects, attendance, fees, exams, and marks through a powerful Admin Dashboard.

---

## 🚀 Features

### Dashboard

* Admin Dashboard
* System Statistics
* Quick Access Modules

### Student Management

* Add Student
* Edit Student
* Delete Student
* View Student Details

### Teacher Management

* Add Teacher
* Edit Teacher
* Delete Teacher
* Teacher Listing

### Academic Management

* Class Management
* Section Management
* Subject Management
* Subject Assignment

### Attendance Management

* Mark Attendance
* View Attendance Records
* Attendance Reports

### Fees Management

* Student Fee Collection
* Fee Records
* Payment Tracking

### Examination Management

* Create Exams
* Manage Marks
* Student Results

### Authentication

* Secure Login
* Admin Access Control
* Logout Functionality

---

## 🛠️ Tech Stack

* Laravel
* PHP
* MySQL
* Blade Template Engine
* AdminLTE
* Bootstrap
* JavaScript
* jQuery

---

## ⚙️ Project Setup (After Downloading from GitHub)

Follow these steps in order after downloading or cloning the project.

---

### ✅ Step 1 — Open Project in VS Code

Open the project folder and open the terminal inside it.

---

### ✅ Step 2 — Create `.env` File

Run:

```bash
cp .env.example .env
```

---

### ✅ Step 3 — Install Vendor Packages

```bash
composer install --ignore-platform-reqs
```

---

### ✅ Step 4 — Generate Application Key

```bash
php artisan key:generate
```

---

### ✅ Step 5 — Configure Database

Open the `.env` file and update the following values:

```env
APP_NAME="Student Management System"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sms
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=database
```

---

### ✅ Step 6 — Run Migrations and Seed Demo Data

```bash
php artisan migrate:fresh --seed
```

---

### ✅ Step 7 — Create Storage Link (If Required)

```bash
php artisan storage:link
```

---

### ✅ Step 8 — Start Laravel Development Server

```bash
php artisan serve
```

---

### ✅ Step 9 — Open in Browser

```text
http://127.0.0.1:8000
```

---

## 🔐 Default Admin Login (Demo)

Use the following credentials after running the seeders:

```text
Email: admin@gmail.com
Password: admin123
```

---

## 📂 Project Modules

* Dashboard
* Students
* Teachers
* Classes
* Sections
* Subjects
* Subject Assignments
* Attendance
* Fees
* Exams
* Marks
* Authentication

---

## 👨‍💻 Author

Faijan Shaikh

---

## 📌 Note

This project was developed for learning and portfolio purposes using Laravel and AdminLTE.

If you encounter any issues during installation or setup, please create an issue in the repository or contact me. I will do my best to help.
