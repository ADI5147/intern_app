#  Intern App

A mini internship management system built with **PHP** and **MySQL**. This web application provides user authentication, role-based access control, and user management features.

---

##  Features

- ** User Authentication**
  - Secure login with password hashing
  - User registration with email validation
  - Session-based authentication
  - Logout functionality

- ** Role-Based Access Control**
  - Admin role with full access
  - Regular user role with limited access
  - Protected routes based on user roles

- ** Dashboard**
  - Admin dashboard with user management
  - User dashboard for regular users

- ** User Management (Admin)**
  - View all users
  - Add new users
  - Edit existing users
  - Delete users with confirmation

---

##  Project Structure

```
intern_app/
├── Authentication/
│   ├── login.php          # User login page
│   ├── register.php       # User registration page
│   └── logout.php         # Session logout handler
├── Dashboard/
│   ├── admin_dashboard.php    # Admin control panel
│   └── user_dashboard.php     # Regular user dashboard
├── Users/
│   ├── user_add.php       # Add new user form
│   ├── user_edit.php      # Edit user form
│   ├── user_delete.php    # Delete user handler
│   └── user_list.php      # List all users
├── includes/
│   ├── header.php         # HTML head and Bootstrap CSS
│   ├── navbar.php         # Navigation bar component
│   └── footer.php         # Footer component
├── auth.php               # Authentication helper functions
├── config.php             # Database configuration
├── functions.php          # Utility functions
├── index.php              # Home page
└── README.md
```

---

##  Tech Stack

| Technology | Purpose |
|------------|---------|
| PHP | Backend logic & server-side processing |
| MySQL | Database management |
| Bootstrap 5 | Frontend styling & responsive design |
| HTML/CSS | Page structure & styling |

---

##  Installation

### Prerequisites

- **XAMPP**, **WAMP**, or any PHP server with MySQL support
- PHP 7.4 or higher
- MySQL 5.7 or higher

### Setup Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/ADI5147/intern_app.git
   ```

2. **Move to your web server directory**
   ```bash
   # For XAMPP
   mv intern_app /xampp/htdocs/
   
   # For WAMP
   mv intern_app /wamp64/www/
   ```

3. **Create the database**
   
   Create a MySQL database and run the following SQL:
   ```sql
   CREATE DATABASE intern_db;
   USE intern_db;
   
   CREATE TABLE users (
       id INT AUTO_INCREMENT PRIMARY KEY,
       name VARCHAR(100) NOT NULL,
       email VARCHAR(100) UNIQUE NOT NULL,
       password VARCHAR(255) NOT NULL,
       role ENUM('admin', 'user') DEFAULT 'user',
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );
   ```

4. **Configure database connection**
   
   Update `config.php` with your database credentials:
   ```php
   $host = "localhost";
   $username = "your_username";
   $password = "your_password";
   $database = "intern_db";
   ```

5. **Access the application**
   
   Open your browser and navigate to:
   ```
   http://localhost/intern_app/
   ```

---

##  Default Admin Setup

To create an admin user, insert directly into the database:

```sql
INSERT INTO users (name, email, password, role) 
VALUES ('Admin', 'admin@example.com', '$2y$10$...', 'admin');
```

> **Note:** Generate the password hash using PHP's `password_hash()` function.

---

##  Pages Overview

| Page | URL | Description |
|------|-----|-------------|
| Home | `/index.php` | Landing page |
| Login | `/Authentication/login.php` | User login |
| Register | `/Authentication/register.php` | New user signup |
| Admin Dashboard | `/Dashboard/admin_dashboard.php` | Admin control panel |
| User Dashboard | `/Dashboard/user_dashboard.php` | User dashboard |

---

##  Security Features

- ✅ Password hashing using `password_hash()` and `password_verify()`
- ✅ Prepared statements to prevent SQL injection
- ✅ Session-based authentication
- ✅ Role-based access control
- ✅ Delete confirmation dialogs

---

##  License

This project is open source and available for educational purposes.

---

##  Author

**ADI5147**

---

##  Contributing

Contributions, issues, and feature requests are welcome! Feel free to check the [issues page](https://github.com/ADI5147/intern_app/issues).
