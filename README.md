

# **Product and Sales Management System**

A complete CRUD-based web application for managing categories, products, and sales, with export functionality and user authentication. Built using **Core PHP** and designed with the **Metronic** theme.

---

## **Features**

### **1. Category Management (CRUD)**
- Create, read, update, and delete product categories.
- View all categories in a structured table.

### **2. Product Management**
- Add and manage products associated with categories.
- List all products with details and export functionality.

### **3. Sales Management**
- Record sales transactions, including **sold** and **produced** products.
- View comprehensive sales reports.
- Export sales data to Excel/CSV for analysis.

### **4. User Authentication**
- Secure **login** and **signup** functionality.
- Role-based access control (optional extension).

### **5. Export Functionality**
- Export categories, products, and sales data in various formats (CSV/Excel).

### **5. Server Side Rendering**
- All tables are server side so ou don't have a system load.
    
---

## **Tech Stack**
- **Backend:** Core PHP
- **Database:** MySQL
- **Frontend:** HTML, CSS, JavaScript, jQuery
- **UI Framework:** [Metronic Theme](https://keenthemes.com/metronic) (Bootstrap-based)

---

## **Installation Instructions**

### **Prerequisites**
- **PHP** (7.4 or higher)
- **MySQL**
- **Composer** (optional, for dependency management)
- **Apache/Nginx** server

### **Steps:**

1. **Clone the Repository:**
   ```bash
   git clone [https://github.com/CH-USAMA/POS.git]
   cd POS
   ```

2. **Create MySQL Database:**
   ```sql
   CREATE DATABASE pos;
   POS.sql in the database folder you can import it in your DB Server
   ```

3. **Import Database Schema:**
   Import the `POS.sql` file (provided) into your MySQL server using phpMyAdmin or MySQL CLI.

4. **Configure Database Connection:**
   Update `config.php` with your database credentials:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'your_db_user');
   define('DB_PASS', 'your_db_password');
   define('DB_NAME', 'pos');
   ```

5. **Start the Server:**
   Place the project in your web server's root directory (e.g., `htdocs` for XAMPP) and access it via:
   ```
   http://localhost/pos/
   ```

---

## **Usage**

### **Accessing the System:**
1. **Login:** Use the default credentials (if any) or register a new account.
2. **Manage Categories:** Navigate to the **Categories** tab to add, edit, or delete categories.
3. **Manage Products:** Go to the **Products** section to create and list products.
4. **Sales Records:** Record and monitor sales under the **Sales** tab.
5. **Export Data:** Click the **Export** button on any table to download data in your desired format.

---

## **Screenshots**
![image](https://github.com/user-attachments/assets/bc7506e5-c2c8-4d9d-baac-7e69301b191e)
![image](https://github.com/user-attachments/assets/6cccc6a9-f2aa-4e26-b408-7f98787d4a10)
![image](https://github.com/user-attachments/assets/e66b8e94-fe20-4b64-ae63-357aa36fbf51)


---

## **Contributing**
1. Fork the repository.
2. Create a new branch (`feature/your-feature-name`).
3. Commit your changes.
4. Open a pull request.

---

## **License**
This project is licensed under the **MIT License**. See [LICENSE](LICENSE) for details.

---

## **Contact**
For any queries or suggestions:
- **Email:** [yourname@example.com](mailto:usamamunawar15@gmail.com)
- **GitHub:** [yourusername](https://github.com/CH-USAMA)

---

This should help you set up and understand the system. Happy coding! 🚀
