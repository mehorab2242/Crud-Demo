# CRUD Demo – Notes App

A polished **PHP + MySQL** notes manager showcasing the CRUD basics with a modern look-and-feel.

The app keeps things lightweight—plain PHP, mysqli prepared statements, and Bootstrap 5 for the interface—while still demonstrating clean patterns such as view separation and safe output handling.

---

## 🚀 Highlights

- Bootstrap 5 UI with glassmorphism styling and responsive layout
- Dedicated create/edit pages plus a server-rendered listing view
- Delete confirmation modal powered by Bootstrap’s JavaScript bundle
- All SQL queries use prepared statements; HTML output is escaped via `htmlspecialchars`
- Background assets served from `public/images/` for easy theming

---

## 📂 Project Structure

```
Crud-demo/
│
├── index.php                  # Entry point – fetches notes and loads the view
├── api/
│   ├── create.php             # Handles inserting notes into the database
│   ├── edit.php               # Updates existing notes
│   └── delete.php             # Deletes notes (POST + prepared statements)
│
├── css/
│   ├── create.css             # Styling shared by create/edit pages
│   └── index.css              # Styling for the notes listing
│
├── database/
│   └── db.php                 # mysqli connection bootstrapper
│
├── pages/
│   ├── createPage.php         # Form for adding a new note
│   ├── editPage.php           # Form for updating an existing note
│   └── indexPage.php          # Bootstrap table with modal delete workflow
│
├── public/
│   └── images/
│       └── notepad.jpg        # Background image used by the CSS
│
├── package.json               # Optional: install Bootstrap locally (`npm install`)
└── package-lock.json
```

---

## 🗄️ Database Setup

1. Create the database:

   ```sql
   CREATE DATABASE crud_demo;
   ```

2. Create the `notes` table:

   ```sql
   CREATE TABLE `notes` (
     `id` INT NOT NULL AUTO_INCREMENT,
     `title` VARCHAR(255) NOT NULL,
     `description` TEXT DEFAULT NULL,
     PRIMARY KEY (`id`)
   );
   ```

3. Update the connection credentials in `database/db.php`:

   ```php
   $conn = mysqli_connect('localhost', 'root', '', 'crud_demo');
   ```

---

## ▶️ Run Locally

1. Copy the project into your local web root (`www/`, `htdocs/`, etc.).
2. Start Apache (or Nginx) and MySQL.
3. Optional: run `npm install` if you want local copies of Bootstrap assets (the app also works with CDN links out of the box).
4. Visit the entry point in your browser:

   ```
   http://localhost/Crud-demo/index.php
   ```

---

## 🧠 How It Works

| Action        | Entry Points / Scripts                     | Notes                                                                 |
|---------------|--------------------------------------------|-----------------------------------------------------------------------|
| List notes    | `index.php` → `pages/indexPage.php`        | Fetches notes, renders Bootstrap table, and wires up the delete modal |
| Create note   | `pages/createPage.php` → `api/create.php`  | Displays a form and inserts the note via prepared statement           |
| Edit note     | `pages/editPage.php` → `api/edit.php`      | Prefills form fields and updates the record                           |
| Delete note   | `pages/indexPage.php` → `api/delete.php`   | Modal posts note ID (validated) to delete handler                     |

---

## 💡 Future Enhancements

- User authentication and per-user note ownership
- Created/updated timestamps with sorting
- Search and filtering in the listing view
- API endpoints for SPA/mobile integrations

---

## 📝 License

Open-source and free to use for learning or bootstrapping your own CRUD projects.

---

**Happy Coding! 🎉**
