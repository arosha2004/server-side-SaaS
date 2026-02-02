# 📝 NoteHub System

A modern, feature-rich note-taking web application built with PHP, MySQL, and Tailwind CSS.

---

## 🚀 Features

- ✅ User Authentication (Login/Register)
- ✅ Create, Edit, Delete Notes
- ✅ Set Reminders for Notes
- ✅ Calendar View
- ✅ File Uploads with Download/Delete
- ✅ User Settings & Profile Management
- ✅ Admin Dashboard
- ✅ Premium User Management
- ✅ Responsive Tailwind CSS Design

---

## 📋 Requirements

- **XAMPP** (or any Apache + PHP + MySQL stack)
- **PHP 7.4+** or **PHP 8.x**
- **MySQL 5.7+** or **MariaDB**
- **Node.js** (optional, for Tailwind CSS compilation)

---

## 🛠️ Installation

### 1. Clone or Copy Files
Place the `notehub_system` folder in your XAMPP `htdocs` directory:
```
C:\xampp\htdocs\notehub_system\
```

### 2. Create Database
Open **phpMyAdmin** (http://localhost/phpmyadmin) and run the contents of `database.sql`:

```sql
CREATE DATABASE IF NOT EXISTS notehub_db;
USE notehub_db;
-- (rest of the SQL from database.sql)
```

Or import the file directly via phpMyAdmin → Import.

### 3. Start XAMPP
Start **Apache** and **MySQL** from the XAMPP Control Panel.

### 4. Access the Application
Open your browser and navigate to:
```
http://localhost/notehub_system/
```

---

## 🔐 Default Credentials

### Database Configuration
| Setting | Value |
|---------|-------|
| **Host** | `localhost` |
| **Database Name** | `notehub_db` |
| **Username** | `root` |
| **Password** | *(empty)* |

> 📁 Config file: `config/db.php`

---

### Admin Account
| Field | Value |
|-------|-------|
| **Email** | `admin@notehub.com` |
| **Password** | `password` |
| **Role** | Admin (role_id: 1) |

> ⚠️ **Important:** Change the admin password after first login!

---

### Default User Account
| Field | Value |
|-------|-------|
| **Email** | `user@notehub.com` |
| **Password** | `password` |
| **Role** | User (role_id: 2) |

---

## 📁 Project Structure

```
notehub_system/
├── admin/
│   └── dashboard.php      # Admin panel
├── assets/
│   ├── css/
│   │   ├── src/input.css  # Tailwind source
│   │   └── dist/output.css # Compiled CSS
│   └── logo.png           # Logo image
├── config/
│   └── db.php             # Database connection
├── includes/
│   ├── auth.php           # User authentication
│   ├── admin_auth.php     # Admin authentication
│   ├── sidebar.php        # Navigation sidebar
│   ├── tailwind.php       # Tailwind CSS include
│   └── footer.php         # Page footer
├── notes/
│   ├── index.php          # List all notes
│   ├── create.php         # Create new note
│   ├── edit.php           # Edit note
│   └── delete.php         # Delete note
├── reminders/
│   └── index.php          # Reminders page
├── uploads/
│   └── files/             # Uploaded files storage
├── .htaccess              # Apache security config
├── index.php              # Landing page
├── login.php              # Login page
├── register.php           # Registration page
├── dashboard.php          # User dashboard
├── calendar.php           # Calendar view
├── settings.php           # User settings
├── uploads.php            # File uploads page
├── logout.php             # Logout handler
├── database.sql           # Database schema
├── package.json           # NPM config (Tailwind)
└── tailwind.config.js     # Tailwind configuration
```

---

## 🎨 Tailwind CSS

To modify styles and rebuild Tailwind CSS:

```bash
# Install dependencies (first time only)
npm install

# Watch for changes and rebuild
npm run build
```

---

## 🔒 Security Features

- Session-based authentication
- Password hashing with `bcrypt`
- SQL injection protection (prepared statements)
- XSS protection (`htmlspecialchars`)
- Directory browsing disabled
- Sensitive file protection (`.htaccess`)

---

## 📊 Database Tables

| Table | Description |
|-------|-------------|
| `roles` | User roles (Admin, User) |
| `users` | User accounts |
| `notes` | User notes with reminders |
| `uploads` | Uploaded files tracking |

---

## 🛡️ User Roles

| Role ID | Role Name | Access |
|---------|-----------|--------|
| 1 | Admin | Full access + Admin Dashboard |
| 2 | User | Standard access |

---

## 📝 License

This project is for educational purposes.

---

## 👨‍💻 Author

NoteHub System - Built with ❤️
