# 🌱 Plants PHP Web System

A PHP-based web application for managing plant-related records and information.

---

# 📥 Installation Guide

## 1. Clone the Repository

Open your terminal or Git Bash and run:

```bash
git clone https://github.com/your-username/your-repository.git
```

Example:

```bash
git clone https://github.com/johndoe/plants-web.git
```

---

## 2. Move Project to Web Server Directory

Move the cloned folder to your web server directory.

### XAMPP
```txt
C:\xampp\htdocs\
```

### Laragon
```txt
C:\laragon\www\
```

### Linux Apache
```txt
/var/www/html/
```

---

## 3. Import the Database

1. Open **phpMyAdmin**
2. Create a new database

Example:

```sql
plants_db
```

3. Click the newly created database
4. Go to the **Import** tab
5. Select the provided `.sql` file from the project
6. Click **Import**

---

## 4. Configure Database Connection

Open the database configuration file.

Example:

```txt
config/database.php
```

Update the database credentials:

```php
<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "plants_db";

$conn = mysqli_connect($host, $user, $password, $database);

?>
```

---

# ▶️ Running the Project

Start Apache and MySQL from your control panel.

Open your browser and visit:

```txt
http://localhost/plants-web
```

---

# 🔑 Default Login

```txt
Username: admin
Password: admin123
```

> Change the default password after first login.

---

# 📁 Project Structure

```txt
plants-web/
│
├── assets/
├── config/
├── database/
├── includes/
├── pages/
├── uploads/
├── index.php
└── README.md
```