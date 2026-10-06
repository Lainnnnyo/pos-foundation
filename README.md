# Tasks for Today + Simon Dev POS (CodeIgniter 4)

This project extends the supplied POS site with the Tasks for Today TSA2 features while retaining its dark design and existing customer/user pages. Public pages: Home `/`, Task List `/tasks`, Profile `/profile`, About `/about`, and Login `/login`. A signed-in user may create, edit, or archive tasks. Customers and Users still require login.

## Requirements

PHP 8.2+, Composer, MySQL/MariaDB, and the PHP extensions required by CodeIgniter 4. The server must be able to write to `writable/session`.

## Local setup

1. In the project root, run `composer install`.
2. Create a MySQL database named `pos_database`. For a **new** database, import `app/Database/pos_database.sql`. For an **existing** POS database, leave its existing tables and data alone.
3. Create a private `.env` file (do not commit it):

   ```ini
   CI_ENVIRONMENT = development
   app.baseURL = 'http://localhost:8080/'
   database.default.hostname = localhost
   database.default.database = pos_database
   database.default.username = YOUR_DB_USER
   database.default.password = YOUR_DB_PASSWORD
   database.default.DBDriver = MySQLi
   ```

   Existing deployments can also use the `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USERNAME`, and `DB_PASSWORD` variables supported by `app/Config/Database.php`. Set `app.baseURL` to the site's HTTPS address on Wasmer; otherwise the app defaults to the original Wasmer address in `app/Config/App.php`.

4. Run `php spark migrate`. This creates `tasks` (or adds `is_archived` to an existing tasks table) and adds `users.password` if needed. **Run it against the hosted database too after uploading new files.** A ZIP upload or Git push does not update a MySQL database by itself.
5. If your existing `admin01` account already works, keep its current password: migrations do not change it. On a fresh import, run `php spark db:seed SetInitialPasswords` **privately** to generate passwords for users without one. The command prints the new passwords once; save the output securely. It never replaces an existing hash. Alternatively use the user's existing password management flow. Do not publish login passwords, `.env`, or real database exports with private data.
6. Optionally run `php spark db:seed DemoTasks` to add three example tasks to an empty task table. Run `php spark serve` and open `http://localhost:8080/`.

## Hosted setup / testing

Deploy this project to the same Wasmer app and configure its hosted MySQL connection and `app.baseURL` in Wasmer. Run `php spark migrate` in the deployed environment (or against the same hosted database from a CLI with its connection details). Make sure `writable/session` is writable. If the server has no PHP CLI, use the `CREATE TABLE tasks ...` SQL in `app/Database/tasks_setup.sql` in phpMyAdmin **for a new tasks table only**; also ensure `users.password` exists from the POS setup. The SQL script is not needed if the migration succeeded.

Test these URLs logged out: `/`, `/tasks`, `/profile`, and `/about` should load; `/tasks/new` and `/tasks/1/edit` should redirect to `/login` (edit requires a task with ID 1). Sign in with your existing account, add a task, edit its title/date/status, then click Delete. The task should disappear from Home and Task List but remain in MySQL with `is_archived = 1`. Log out and confirm protected pages redirect again. Invalid title/date and wrong passwords should be rejected.

Routes explicitly protect all task modifications, including POST routes, through `AuthFilter`; automatic routing is disabled. POST forms include CSRF tokens. Passwords are verified using `password_verify()` against stored hashes. The existing POS pages remain available.

## Submission

Push the raw project files, including `app/Database/Migrations`, `app/Database/Seeds`, and `app/Database/tasks_setup.sql`, to GitHub. Submit that repository link and the separately deployed, working Wasmer link. No account password or `.env` belongs in GitHub.
