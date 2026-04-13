# SALN Filing System - Setup Guide

## Overview

A modern, privacy-first web application for completing the Statement of Assets, Liabilities, and Net Worth (SALN) for Filipino government employees. Features a clean, minimalist UI inspired by Google Forms and fullstackopen.

## Key Features

- **User-Friendly Interface**: Easier than filling PDF forms
- **Privacy-First**: Auto-deletes data after 5 days of inactivity
- **Official PDF Generation**: Converts form input to official SALN format
- **Local Data Export**: Export/import as JSON for offline backup
- **Email Authentication**: Secure login with email verification codes

## Tech Stack

- **Backend**: Laravel 11
- **Frontend**: Blade templates with vanilla JavaScript
- **Database**: MySQL/PostgreSQL/SQLite
- **Authentication**: Custom email-based with verification codes

## Installation

### Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js & NPM
- Database (MySQL, PostgreSQL, or SQLite)

### Setup Steps

1. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

2. **Environment Configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Configure Database**
   
   Edit `.env` file:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=saln_db
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

4. **Run Migrations**
   ```bash
   php artisan migrate
   ```

5. **Configure Email (Optional for Production)**
   
   For development, verification codes are logged to `storage/logs/laravel.log`
   
   For production, configure email in `.env`:
   ```env
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.mailtrap.io
   MAIL_PORT=2525
   MAIL_USERNAME=your_username
   MAIL_PASSWORD=your_password
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS=noreply@saln.gov.ph
   MAIL_FROM_NAME="SALN Filing System"
   ```

6. **Build Assets**
   ```bash
   npm run build
   ```

7. **Start Development Server**
   ```bash
   php artisan serve
   ```

8. **Set Up Task Scheduler (Production)**
   
   Add to crontab:
   ```bash
   * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
   ```

## Application Structure

### Routes

- `/` - Landing page
- `/login` - Email authentication
- `/dashboard` - Main SALN form interface
- `/logout` - User logout

### Controllers

- **AuthController**: Handles email verification and authentication
- **FormController**: Manages SALN form CRUD operations and PDF generation

### Models

- **User**: User authentication and activity tracking
- **Form**: SALN form data storage with JSON structure
- **VerificationCodes**: Email verification codes

### Key Features Implementation

#### 1. Email-Based Authentication

Users enter their email → receive a 6-digit code → verify code + set password → login

In development mode (APP_DEBUG=true), verification codes are returned in the API response and logged.

#### 2. Privacy-First Data Management

- User activity tracked via `last_activity_at` timestamp
- Data automatically deleted after 5 days of inactivity
- Scheduled task runs daily: `php artisan users:cleanup-inactive`
- Warning modal shown when user logs in after inactivity

#### 3. Form Management

- **Save**: Auto-saves every 2 minutes, manual save button
- **Export**: Download form data as JSON (local storage)
- **Import**: Upload previously exported JSON
- **New Entry**: Archive current form and start fresh
- **Generate PDF**: Convert form to official SALN PDF (implementation pending)

#### 4. Form Sections

The SALN form includes:
- Form metadata (compliance type, filing type, dates)
- Personal information (name, position, agency, office address)
- Spouse information (optional)
- Children below 18 (repeatable)
- Real properties (repeatable with detailed fields)
- Personal properties (repeatable)
- Liabilities (repeatable)
- Business interests (optional, repeatable)
- Relatives in government (optional, repeatable)
- Certification

### Design Philosophy

**Minimalist & Clean**
- Inspired by fullstackopen design language
- Neutral color palette (white, grays, blue/green accents)
- Generous spacing and clean typography
- No shadows, gradients, or skeuomorphism
- Focus on content and usability

**Accessibility**
- Semantic HTML
- Clear labels and helper text
- Keyboard navigation support
- High contrast ratios
- Responsive design for mobile/tablet

## Development Commands

```bash
# Run development server
php artisan serve

# Watch and compile assets
npm run dev

# Run migrations
php artisan migrate

# Create new migration
php artisan make:migration create_table_name

# Run cleanup command manually
php artisan users:cleanup-inactive

# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## Testing

```bash
# Run PHPUnit tests
php artisan test

# Run specific test
php artisan test --filter=AuthenticationTest
```

## Deployment Checklist

- [ ] Set `APP_ENV=production` in `.env`
- [ ] Set `APP_DEBUG=false` in `.env`
- [ ] Configure proper email service (not log driver)
- [ ] Set up SSL certificate (HTTPS)
- [ ] Configure database connection
- [ ] Run migrations: `php artisan migrate --force`
- [ ] Optimize: `php artisan optimize`
- [ ] Set up cron job for scheduler
- [ ] Configure proper file permissions
- [ ] Set up backups for database
- [ ] Monitor logs: `storage/logs/`

## Security Considerations

- Email verification codes expire after 15 minutes
- Passwords are hashed using bcrypt
- CSRF protection enabled on all forms
- Session security configured
- File upload validation for JSON imports
- SQL injection protection via Eloquent ORM

## Privacy Policy Notes

**What data is collected:**
- Email address (for authentication)
- SALN form data (temporarily, as provided by user)
- Last activity timestamp

**How data is used:**
- Authentication and session management only
- No analytics, tracking, or third-party sharing

**Data retention:**
- Form data deleted after 5 days of inactivity
- Users can export data locally at any time
- No long-term storage or archiving

## Future Enhancements

- [ ] PDF generation implementation using DomPDF or Snappy
- [ ] Email template for verification codes
- [ ] Form field validation against template schema
- [ ] Progress indicator (% complete)
- [ ] Draft auto-save recovery
- [ ] Multi-year SALN comparison
- [ ] Digital signature support
- [ ] Bulk PDF generation for departments

## License

This is an unofficial tool for SALN preparation. Always verify with your agency's official requirements.

## Support

For issues or questions, please contact your system administrator.
