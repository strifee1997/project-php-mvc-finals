# Contact Book MVP - Custom PHP MVC Framework

Overview
This project is a lightweight, fully functional MVC (Model-View-Controller) PHP framework built completely from scratch. It features a custom routing system, an Active Record style ORM via a native PDO database engine, and strictly follows PSR-4 autoloading standards.

To demonstrate the framework's capabilities, I built a Contact Book MVP that allows users to create, read, update, delete, search, and tag their contacts.

Key Features
Zero External Packages: Built entirely with native PHP 8.3+ (only using Composer for the PSR-4 autoloader).

Front-Controller Pattern: All traffic is securely routed through public/index.php.

Dependency Injection: Utilizes a custom Container to inject dependencies (like the database connection) directly into controllers at runtime.

Server-Side Validation: Custom framework-level validation that intercepts empty form submissions and returns helpful error messages.

Tagging & Search: Users can assign tags to contacts and use the built-in search engine to filter contacts by name.

Setup Instructions
Clone the repository to your local machine.

Rebuild the Autoloader: Open your terminal in the project root and run:
composer dump-autoload

Configure the Database Connection: Open config/database.php and verify that the username and password match your local MySQL server credentials.

Create the Database: Ensure your local MySQL server is running. Create a new database and run the following SQL to generate the table:

```SQL
CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```
Start the Server
View the App: Open your browser and navigate to http://localhost:8080

Application Routes
The framework handles the following distinct routes via the routes/web.php file:

* GET / or GET /contacts : View all contacts and the search bar.
* GET /contacts/create : View the form to add a new contact.
* POST /contacts : Process and save the new contact to the database.
* GET /contacts/{id}/edit : View the edit form for a specific contact.
* POST /contacts/{id}/edit : Update the specific contact in the database.
* POST /contacts/{id}/delete : Delete the specific contact.
