# Applying SOLID Principles to a Custom PHP MVC Framework

Building this custom framework from scratch was a huge learning experience. My main goal was to make sure the code was easy to read, easy to fix, and easy to grow. To do this, I used the five SOLID principles. Here is how I actually applied them in my Contact Book app.

1. Single Responsibility Principle (SRP)
I was very strict about splitting up the work in my framework. For example, my Request class has one job which is looking at the URL and cleaning it up. My Router class has one job, matching that clean URL to the right controller. The Engine class only cares about loading the HTML views. Because every file has just one specific job, if I want to change how my web pages look, I know I can edit the views without accidentally breaking how the URL router works.

2. Open/Closed Principle (OCP)
I used this rule when building my database connection. I created a basic rulebook called DatabaseDriver (an interface) and then built a MySQLDriver to handle my current database. If a client ever tells me they want to switch to a totally different database system like PostgreSQL, I don't have to open up and change my core framework files. I can just create a brand new PostgresDriver file, plug it in, and the app keeps working perfectly.

3. Liskov Substitution Principle (LSP)
I actually ran into this exact rule while coding, My core Model (the parent) had a save method that looked like this: save(array $data = []). When I built my new Contact model (the child), PHP threw a strict error until I made sure the child's save method perfectly matched the parent's, even though the logic inside it was slightly updated for my new ORM. By forcing them to match perfectly, the rest of my framework knows it can trust any model to behave exactly the same way.

4. Interface Segregation Principle (ISP)
Instead of making one massive "Database" interface that forces every class to include 20 different methods, I split them up. I made a Findable interface (for reading data, like find() and all()) and a separate Persistable interface (for editing data, like save() and delete()). Because I split them up, if I ever create a read-only table in the future, it only has to use Findable. It won't be forced to carry around empty, useless save or delete methods.

5. Dependency Inversion Principle (DIP)
This is where my custom Container comes in. Normally, a controller might manually connect to the database or build the model itself. Instead, I set up a Dependency Injection Container. Now, my ContactController just asks for the Contact model in its constructor. The Container acts like a helpful assistant in the background and it connects to the database, builds the model, and hands it perfectly ready to the controller. This keeps the controller lightweight and makes the app much easier to test.
