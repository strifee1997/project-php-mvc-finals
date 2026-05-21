# Contact Book MVP - Custom PHP MVC Framework

## Overview
This project is a lightweight, fully functional MVC (Model-View-Controller) PHP framework built completely from scratch. It features a custom routing system, a native PDO database engine, and strictly follows PSR-4 autoloading standards. 

To demonstrate the framework's capabilities, I built a Contact Book MVP that allows users to create, read, update, delete, search, and tag their contacts.

## Key Features
* **Zero External Packages:** Built entirely with native PHP 8.3+ (only using Composer for the PSR-4 autoloader).
* **Front-Controller Pattern:** All traffic is securely routed through `public/index.php`.
* **Server-Side Validation:** Custom framework-level validation that intercepts empty form submissions and returns helpful error messages without relying on browser popups.
* **Tagging & Search:** Users can assign tags to contacts and use the built-in search engine to filter contacts by name.
* **Minimalist UI:** Clean, solid-color styling using raw HTML/CSS for a fast, responsive user experience.

## Setup Instructions
1. **Clone the repository** to your local machine.
2. **Rebuild the Autoloader:** Open your terminal in the project root and run:
   `composer dump-autoload`
3. **Database Setup:** Ensure your local MySQL server is running (default port 3306).
   * Create a new database named `contact_book_mvp`.
   * Run the following SQL to create the table:
     ```sql
     CREATE TABLE contacts (
         id INT AUTO_INCREMENT PRIMARY KEY,
         name VARCHAR(100) NOT NULL,
         email VARCHAR(100) NOT NULL,
         phone VARCHAR(20) NOT NULL,
         tags VARCHAR(255) DEFAULT ''
     );
     ```
4. **Start the Server:** Open your terminal in the project root and start the PHP server
5. **View the App:** Open your browser

## Application Routes
The framework handles the following distinct routes via the `routes/web.php` file:

* `GET /` or `GET /contacts` : View all contacts and the search bar.
* `GET /contacts/create` : View the form to add a new contact.
* `POST /contacts` : Process and save the new contact to the database.
* `GET /contacts/{id}/edit` : View the edit form for a specific contact.
* `POST /contacts/{id}/edit` : Update the specific contact in the database.
* `POST /contacts/{id}/delete` : Delete the specific contact.
