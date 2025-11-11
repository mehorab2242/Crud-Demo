---

# CRUD Demo - Notes App

A simple **PHP CRUD application** for managing notes.  
This project demonstrates the basic Create, Read, Update, and Delete operations using:

- **Core PHP** (No frameworks)
- **MySQL Database**
- **HTML / CSS**
- **Prepared Statements** for safer SQL queries

---

## 🚀 Features

- Add a new note
- View all notes
- Edit an existing note
- Delete a note
- Clean and minimal UI
- Uses mysqli prepared statements to prevent SQL injection

---

## 📂 Project Structure

```

Crud-demo/
│
├── api/
│   ├── create.php        # Handles inserting notes into database
│   ├── edit.php          # Handles updating notes
│   └── delete.php        # Handles deleting notes
│
├── css/
│   ├── create.css        # Page styling for Create page
│   └── index.css         # Page styling for listing page
│
├── database/
│   └── db.php            # Database connection file
│
├── pages/
│   ├── createPage.php    # UI for creating a new note
│   ├── editPage.php      # UI for editing a note
│   └── index.php         # Main page listing all notes
│
├── package.json          # (If used for frontend dependencies)
└── package-lock.json

````

---

## 🗄️ Database Setup

1. Create a new MySQL database:

```sql
CREATE DATABASE crud_demo;
````

2. Create the `notes` table:

```sql
CREATE TABLE `notes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
);
```

3. Update your database credentials in:

```
database/db.php
```

Example:

```php
$conn = mysqli_connect("localhost", "root", "", "crud_demo");
```

---

## ▶️ Running the Project

If using **Laragon / XAMPP / WAMP**:

1. Place the project inside the `www/` or `htdocs/` directory.
2. Start Apache and MySQL.
3. Visit in your browser:

```
http://localhost/Crud-demo/pages/index.php
```

---

## 🧠 How It Works

| Action      | File Involved                       | Description                            |
| ----------- | ----------------------------------- | -------------------------------------- |
| Create Note | `createPage.php` & `api/create.php` | Displays form and inserts data into DB |
| List Notes  | `index.php`                         | Shows all saved notes                  |
| Edit Note   | `editPage.php` & `api/edit.php`     | Fetches note data and updates DB       |
| Delete Note | `api/delete.php`                    | Removes note by ID                     |

---

## 💡 Future Improvements

* Add user login system
* Add timestamps for notes
* Improve UI styling
* Convert to MVC architecture
* Add search functionality

---

## 📝 License

This project is open-source and free to use for learning and development.

---

**Happy Coding! 🎉**

```

---

If you want, I can also:

✅ Convert it to **Bootstrap** UI  
✅ Add **Search functionality**  
✅ Convert into **MVC structure**  
✅ Or even migrate to **Laravel / Next.js / Supabase**  

Just tell me 😄
```
