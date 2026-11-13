# SMILE AURA DENTIST — PHP/MySQL backend upgrade

This package keeps the existing SMILE AURA website's visual design and adds a server-backed appointment workflow, staff authentication, appointment status management, and an optional OpenAI Responses API connection for the dental assistant.

## Requirements

- XAMPP with PHP 8.2+ and MariaDB/MySQL
- PHP extensions: `pdo_mysql`, `curl` (for live AI responses), and `mbstring`
- Apache with `.htaccess` enabled (`AllowOverride All`)
- Internet access only if you enable the AI API connection

## 1. Install in XAMPP

1. Stop Apache before replacing any existing project files.
2. Copy the complete `smile_aura_backend` folder into `C:\xampp\htdocs\`.
3. Rename the folder to `smile-aura` if desired. The site will then be at `http://localhost/smile-aura/`.
4. Start Apache and MySQL from the XAMPP Control Panel.
5. Open `http://localhost/phpmyadmin/`.
6. Select **Import**, choose `database/schema.sql`, and run it. This creates the `smile_aura_clinic` database and its tables.

If you already have a database with these table names, back it up before importing. This schema is for a fresh installation; it does not migrate existing localStorage bookings into MySQL.

## 2. Configure database access

Open `config/config.php` and confirm the database host, name, username and password. The included defaults are typical for a fresh XAMPP install (`root` with an empty password), but use the credentials configured on your computer. For better secret management, copy `config/config.local.example.php` to `config/config.local.php` and put private overrides there. Do not publish that file.

## 3. Create the first staff account

Open Command Prompt and run:

```bat
cd C:\xampp\htdocs\smile-aura
C:\xampp\php\php.exe scripts\create_staff.php admin admin
```

Replace `admin` after the script name with your preferred username. The second `admin` is the role. Supported roles are `admin`, `receptionist`, and `dentist`. Enter a strong password of at least 12 characters when prompted.

Example for another staff member:

```bat
C:\xampp\php\php.exe scripts\create_staff.php reception1 receptionist
```

The script is CLI-only and the `scripts` directory is blocked from web access. Do not create accounts by placing plain-text passwords in SQL.

## 4. Enable live AI answers (optional)

The assistant continues to provide curated FAQ answers when no API key is configured. To enable generated answers:

1. Create an API key in your OpenAI API account.
2. Add it to the server environment as `OPENAI_API_KEY`, or copy `config/config.local.example.php` to `config/config.local.php` and set `ai.api_key` there.
3. Keep the key server-side. Never paste it into `index.php` or browser JavaScript.
4. Confirm the PHP `curl` extension is enabled and restart Apache.

The backend calls the OpenAI Responses API. The model is configurable in `config/config.php` or `config.local.php`. API usage may incur charges. Do not enter patient-identifying details or sensitive medical records into the public chatbot; it is designed for general education and FAQs, not diagnosis.

Official API reference: https://developers.openai.com/api/docs/quickstart

## 5. What is connected

- Public appointment booking saves to MySQL and returns a booking reference.
- Availability is checked against active slot reservations on the server, so multiple devices see the same slots.
- Staff sign-in uses PHP sessions, password hashes, session ID regeneration and CSRF tokens.
- The staff dashboard loads appointments from MySQL. Administrators and receptionists can change status; dentists can view the list but cannot change status.
- Cancelling an appointment releases its slot; changing a cancelled appointment back to an active status attempts to reserve it again.
- The WhatsApp button continues to use the published clinic number and pre-filled message.
- The dental assistant calls `backend/chat.php`; it uses live AI only when a server-side key is configured, otherwise the built-in FAQ responses are used.

## 6. Important production checks

Before publishing to the public internet:

- Install a valid HTTPS certificate. Secure session cookies are enabled automatically when HTTPS is detected.
- Set a strong database password and use a database account with only the permissions this application needs.
- Keep `config.local.php`, backups and database exports outside public web access.
- Configure server-level rate limiting for public booking and staff login endpoints, plus routine backups and monitoring.
- Add your clinic's privacy notice and consent language before collecting patient contact details.
- Test booking, cancellation, rebooking, staff roles and mobile layout on a staging copy first.
- The reminder channel is currently stored as a preference only; SMS/email reminders are not sent by this package. A real reminder provider and consent workflow are separate integrations.

## Troubleshooting

- **Database connection error:** verify MySQL is running, import `database/schema.sql`, and check `config/config.php`.
- **404 for backend URLs:** ensure the folder is inside `htdocs`, Apache is running, and you are opening the project through `http://localhost/...`, not by double-clicking the PHP file.
- **AI remains in FAQ mode:** check the API key, `curl` extension, model access and Apache error log. Never put the API key in the browser.
- **Staff login rejected:** create an account with the CLI script and check the username, password and active status in `staff_users`.
- **CSRF/session errors:** use the same localhost hostname consistently (do not mix `localhost` and `127.0.0.1`), allow cookies, and refresh the page.

## Existing appointments

Your earlier HTML-only version saved bookings in each visitor's browser `localStorage`. Those records are not automatically available to PHP/MySQL and are not migrated by this package. Export or manually transfer any real bookings before switching the live site to this backend. The new central database is the source of truth going forward.
