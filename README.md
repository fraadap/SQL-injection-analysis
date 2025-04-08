# 🔒 SQL Injection: Vulnerability Analysis & Secure Implementation

![GitHub](https://img.shields.io/badge/PHP-7.4.33-777BB4?logo=php)
![GitHub](https://img.shields.io/badge/PostgreSQL-13.14-4169E1?logo=postgresql)
![GitHub](https://img.shields.io/badge/Apache-2.4-D22128?logo=apache)

A comprehensive academic project demonstrating **SQL Injection (SQLi)** attacks, their impact on the CIA triad (Confidentiality, Integrity, Availability), and robust countermeasures. Built with PHP, PostgreSQL, and Apache, this project includes **two versions**: a **vulnerable system** for attack demonstrations and a **secure system** implementing best practices.

---

## 📖 Table of Contents
- [Key Features](#-key-features)
- [Attack Demonstrations](#-attack-demonstrations)
- [Prevention Measures](#-prevention-measures)
- [Installation](#-installation)
- [Usage](#-usage)
- [Experimental Results](#-experimental-results)
- [Technologies Used](#-technologies-used)
- [License](#-license)

---

## 🚀 Key Features
- **Dual System Architecture**:
  - **Vulnerable Version**: Intentionally insecure to demonstrate SQLi attacks.
  - **Secure Version**: Implements defenses like parameterized queries, RBAC, and password hashing.
- **CIA Triad Analysis**: Shows how SQLi compromises Confidentiality, Integrity, and Availability.
- **Interactive Web Interface**: Login, registration, and real-time article search with AJAX.
- **Blind SQLi Script**: Automated script (`blindInjection.js`) for inferring table/column names via time-based or inferred-data attacks.

---

## 💥 Attack Demonstrations
### 1. **Tautology Attack**
   - **Goal**: Bypass login authentication using always-true conditions.
   - **Input**: `' OR '1'='1` in username/password fields.
   - **Query**: 
     ```sql
     SELECT * FROM users WHERE username = '' OR '1'='1' AND password = '' OR '1'='1';
     ```

### 2. **End-of-Line Comment Attack**
   - **Goal**: Ignore password checks by truncating queries.
   - **Input**: `' OR id=4 --` in the username field.
   - **Query**:
     ```sql
     SELECT * FROM users WHERE username = ' ' OR id=4 -- AND password = 'any';
     ```

### 3. **Piggybacked Query Attack**
   - **Goal**: Execute additional malicious queries (e.g., delete tables, extract data).
   - **Input**: `'; DELETE FROM users; --` in search fields.
   - **Result**: Drops all user data.

### 4. **Blind SQL Injection**
   - **Time-Based**: Uses `pg_sleep(1)` to infer table/column names.
   - **Inferred-Data**: Analyzes HTML responses to guess names recursively.

---

## 🛡️ Prevention Measures
### 1. **Parameterized Queries**
   - Uses PostgreSQL's `pg_prepare()` and `pg_execute()` to separate SQL logic from user input.
   - Example:
     ```php
     $result = pg_prepare($connection, "login_query", "SELECT * FROM users WHERE username = $1");
     $result = pg_execute($connection, "login_query", array($username));
     ```

### 2. **Password Hashing**
   - **BCrypt** hashing with random salts via PHP’s `password_hash()` and `password_verify()`.

### 3. **Role-Based Access Control (RBAC)**
   - Three roles with least-privilege access:
     - **`user_role`**: `SELECT` on articles, `INSERT` on users.
     - **`shop_role`**: `INSERT`/`DELETE` on shops/articles.
     - **`admin_role`**: Full privileges.

### 4. **Output Sanitization**
   - Escapes HTML characters using `htmlspecialchars()` to prevent XSS.

---

## 📥 Installation
1. **Clone the Repository**:
   ```bash
   git clone https://github.com/yourusername/sql-injection-demo.git
   cd sql-injection-demo

2. **Set Up Apache & PostgreSQL**:
    
    bash
    
    Copy
    
    sudo apt update
    sudo apt install apache2 postgresql php libapache2-mod-php
    sudo systemctl start apache2 postgresql
    
3. **Initialize the Database**:
    
    bash
    
    Copy
    
    cd db-scripts
    sudo sh create.sh  # Creates tables, test data, and roles
    
4. **Configure Permissions**:
    
    - Update database credentials in PHP files (e.g., `check-login.php`).
        

---

## 🖥️ Usage

1. **Access the Web Interface**:
    
    - Navigate to `http://localhost/login.php`.
        
    - Test attacks on the **vulnerable version** or explore the **secure version**.
        
2. **Run Blind SQLi Script**:
    
    - Use `blindInjection.js` for automated attacks:
        
        javascript
        
        Copy
        
        // Mode 0: Find table names | Mode 1: Find column names
        blindInjection(0, true, "article");
        

---

## 📊 Experimental Results

|Attack Type|Mode|Time (Seconds)|
|---|---|---|
|Inferred-Data (Tables)|0|135.588|
|Inferred-Data (Columns)|1|170.964|
|Time-Based (Tables)|0|44.698|
|Time-Based (Columns)|1|59.606|

---

## 🛠️ Technologies Used

- **Backend**: PHP 7.4.33
    
- **Database**: PostgreSQL 13.14
    
- **Web Server**: Apache2
    
- **Frontend**: HTML, CSS, Bootstrap, AJAX
    
- **OS**: Debian 11 (bullseye)
    

---

**👨💻 Author**: Francesco D’Aprile   
**🎓 Academic Year**: 2023/2024