# SmartSkool

SmartSkool is a simple PHP-based School Management System designed to streamline administrative tasks such as managing students, teachers, classes, and results. Built with XAMPP (Apache, MySQL, PHP), it provides a lightweight solution for small to medium educational institutions.

---

## 🚀 Features
- Student registration and profile management
- Teacher information management
- Class and subject allocation
- Attendance tracking
- Exam results entry and reporting
- Secure login system for admins
- Database-driven backend (MySQL)
- Clean and responsive UI

---

## 🛠️ Tech Stack
- **Backend:** PHP (Core PHP)
- **Frontend:** HTML, CSS, JavaScript
- **Database:** MySQL
- **Server:** Apache (XAMPP)

---

## 📂 Project Structure
/controller        # Core PHP controllers
/css               # Stylesheets
/js                # JavaScript files
/views             # UI templates
/config.php        # Database connection (use .env for secrets)


---

## ⚙️ Installation
1. Clone the repository:
```bash
   git clone https://github.com/Md-Moklesar-Rahman-Bappy/SmartSkool.git
```

2. Move the project to your XAMPP htdocs directory:
```bash
   C:\xampp\htdocs\SmartSkool
```

3. Import the database:
- Open phpMyAdmin
- Create a new database (e.g., smartskool)
- Import the SQL file from /database/smartskool.sql

4. Configure database connection:
```bash
   DB_HOST=localhost
  DB_USER=root
  DB_PASS=
  DB_NAME=smartskool
```

4. Start Apache & MySQL in XAMPP and visit:
```bash
    http://localhost/SmartSkool
```

##🔒 Security Notes
- Do not commit .env or config.php with secrets.
- Add .env and config.php to .gitignore.
- Use environment variables for API keys and passwords.

## 📜 License
This project is licensed under the MIT License. You are free to use, modify, and distribute it with attribution.

## 👨‍💻 Author
Developed by Md Moklesar Rahman (Bappy)  
Web App & Software Developer





