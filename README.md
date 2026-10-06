# Simon Dev POS — TFA4 Sessions and Authentication

This CodeIgniter 4 project extends the TFA3 customer and user pages with a staff login, session access checks, and logout. The existing dark design is retained. The homepage is public; all customer and user pages, including new/edit forms and their POST actions, require login.

## Requirements

PHP 8.2 or later, Composer, MySQL/MariaDB with PHP's `mysqli` extension, and the PHP extensions required by CodeIgniter. The host must allow writes to `writable/session`.

## Set up locally

1. Run `composer install` from the project root.
2. Create a MySQL database called `pos_database` and import `app/Database/pos_database.sql` (the TFA3 sample database). If you have an existing TFA3 database, retain its data and skip the import.
3. Create `.env` with the values below; keep `.env` out of Git.

   ```ini
   CI_ENVIRONMENT = development
   app.baseURL = 'http://localhost:8080/'
   database.default.hostname = localhost
   database.default.database = pos_database
   database.default.username = YOUR_DB_USER
   database.default.password = YOUR_DB_PASSWORD
   database.default.DBDriver = MySQLi
   ```

   Existing deployments may use `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USERNAME`, and `DB_PASSWORD`, already supported by `app/Config/Database.php`.

   `app/Config/App.php` defaults to the Wasmer URL and omits `index.php` from generated links. Set `app.baseURL` in your local `.env` to use your own localhost address. If the hosted domain changes, set `app.baseURL` in Wasmer's app settings to the new HTTPS URL.

4. Run `php spark migrate` to add the `users.password` column.
5. Run `php spark db:seed SetInitialPasswords` **from a private command line**. It generates a different random password for each existing user without a password, stores only a hash, and prints each username/password once. Save that output privately. Running it again will not replace passwords already set.
6. Run `php spark serve` and visit `http://localhost:8080/login`.

New users created in the UI receive a password hash automatically. Existing users cannot log in until their passwords have been provisioned in step 5. Do not commit the seeder's output or a database export containing actual credentials or customer data.

## Hosted deployment

Configure a reachable hosted MySQL database, point the web server at `public/`, and make `writable/session` writable. Apply the migration and run the seeder against the hosted database from a private CLI before checking the login. Set hosted `app.baseURL` to the site's HTTPS URL. Deploying this ZIP alone does not update the hosted database or Wasmer site. A local `localhost` MySQL database is not reachable from Wasmer.

## Access check

1. Log out, then open `/customers`, `/users`, `/customers/new`, `/users/new`, and an existing `/customers/1/edit` or `/users/1/edit`: each should redirect to `/login`.
2. Sign in with a generated password, then repeat: each should load normally.
3. Log out and retry a protected URL: it should redirect to `/login` again.
4. Test an incorrect password and confirm that it stays on the login page.

The authentication filter is applied to explicit route groups. Auto routing is disabled in `app/Config/Routing.php` to prevent alternate controller URLs bypassing the filter. POST forms include CSRF tokens.
