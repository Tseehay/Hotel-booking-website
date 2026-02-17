# Hotel Booking Website - Setup and Run Guide

This comprehensive guide will help you set up and run the Addis Hotel Booking Website project on your local machine.

## Table of Contents
1. [Prerequisites](#prerequisites)
2. [Project Overview](#project-overview)
3. [Installation Steps](#installation-steps)
4. [Database Setup](#database-setup)
5. [Configuration](#configuration)
6. [Running the Application](#running-the-application)
7. [Database Schema and Relations](#database-schema-and-relations)
8. [Admin Panel Access](#admin-panel-access)
9. [Project Structure](#project-structure)
10. [Troubleshooting](#troubleshooting)

---

## Prerequisites

Before you begin, ensure you have the following installed on your system:

- **XAMPP** (Recommended) or **WAMP** or **LAMP** server
  - PHP 7.4 or higher
  - MySQL 5.7 or higher
  - Apache Web Server
- **Web Browser** (Chrome, Firefox, Edge, Safari)
- **Text Editor** (VS Code, Sublime Text, or any IDE)
- **Git** (for cloning the repository)

### Recommended Software Versions
- PHP: 7.4+
- MySQL: 5.7+
- Apache: 2.4+

---

## Project Overview

**Addis Hotel** is a full-featured hotel booking website built with PHP and MySQL. The system includes:

### User Features
- User registration and login
- Browse available rooms
- Book hotel rooms with date selection
- Check booking availability
- Manage bookings (view, modify, cancel)
- Provide reviews and ratings
- Secure online payment integration
- Profile management

### Admin Features
- Admin dashboard
- Room management (add, edit, delete rooms)
- User management (view, ban, unban users)
- Booking management
- Features and facilities management
- Carousel management
- Reviews and ratings management
- Settings and configuration
- Website shutdown control

### Technologies Used
- **Frontend**: HTML5, CSS3, JavaScript, Bootstrap 5, AJAX
- **Backend**: PHP (Core PHP)
- **Database**: MySQL
- **Libraries**: 
  - Bootstrap 5
  - Swiper.js (for carousels)
  - Bootstrap Icons
  - Google Fonts (Merienda, Poppins)

---

## Installation Steps

### Step 1: Install XAMPP/WAMP/LAMP

1. **Download XAMPP** from [https://www.apachefriends.org/](https://www.apachefriends.org/)
2. Install XAMPP on your system
3. Start the **Apache** and **MySQL** services from the XAMPP Control Panel

### Step 2: Clone the Repository

Open your terminal/command prompt and navigate to the `htdocs` folder (for XAMPP) or `www` folder (for WAMP):

```bash
# For Windows (XAMPP)
cd C:\xampp\htdocs

# For macOS/Linux (XAMPP)
cd /opt/lampp/htdocs

# Clone the repository
git clone https://github.com/Tseehay/Hotel-booking-website.git

# Navigate into the project directory
cd Hotel-booking-website
```

Alternatively, you can download the ZIP file from GitHub and extract it to the `htdocs` directory.

### Step 3: Verify File Permissions (Linux/macOS)

If you're on Linux or macOS, ensure proper permissions:

```bash
sudo chmod -R 755 /opt/lampp/htdocs/Hotel-booking-website
sudo chown -R www-data:www-data /opt/lampp/htdocs/Hotel-booking-website
```

---

## Database Setup

### Step 1: Create Database

1. Open your web browser and navigate to **phpMyAdmin**:
   ```
   http://localhost/phpmyadmin
   ```

2. Click on **"New"** in the left sidebar to create a new database

3. Enter the database name: `hotel-booking-website`

4. Select collation: `utf8mb4_general_ci` (recommended)

5. Click **"Create"**

### Step 2: Create Database Tables

Execute the following SQL queries in phpMyAdmin to create all necessary tables:

#### 1. Admin Credentials Table
```sql
CREATE TABLE `admin_cred` (
  `sr_no` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(150) NOT NULL,
  `admin_pass` varchar(150) NOT NULL,
  PRIMARY KEY (`sr_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

#### 2. Insert Default Admin (optional)
```sql
INSERT INTO `admin_cred` (`admin_name`, `admin_pass`) 
VALUES ('admin', 'admin123');
```
**Note**: Change the password after first login for security!

#### 3. User Credentials Table
```sql
CREATE TABLE `user_cred` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` varchar(120) NOT NULL,
  `phonenum` varchar(100) NOT NULL,
  `pincode` int(11) NOT NULL,
  `dob` date NOT NULL,
  `profile` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `token` varchar(200) DEFAULT NULL,
  `t_expire` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `datentime` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

#### 4. Rooms Table
```sql
CREATE TABLE `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `area` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `adult` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `description` varchar(350) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `removed` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

#### 5. Features Table
```sql
CREATE TABLE `features` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

#### 6. Facilities Table
```sql
CREATE TABLE `facilities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `icon` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

#### 7. Room Features Junction Table
```sql
CREATE TABLE `room_features` (
  `sr_no` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` int(11) NOT NULL,
  `features_id` int(11) NOT NULL,
  PRIMARY KEY (`sr_no`),
  FOREIGN KEY (`room_id`) REFERENCES `rooms`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`features_id`) REFERENCES `features`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

#### 8. Room Facilities Junction Table
```sql
CREATE TABLE `room_facilities` (
  `sr_no` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` int(11) NOT NULL,
  `facilities_id` int(11) NOT NULL,
  PRIMARY KEY (`sr_no`),
  FOREIGN KEY (`room_id`) REFERENCES `rooms`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`facilities_id`) REFERENCES `facilities`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

#### 9. Room Images Table
```sql
CREATE TABLE `room_images` (
  `sr_no` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `thumb` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`sr_no`),
  FOREIGN KEY (`room_id`) REFERENCES `rooms`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

#### 10. Carousel Table
```sql
CREATE TABLE `carousel` (
  `sr_no` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(150) NOT NULL,
  PRIMARY KEY (`sr_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

#### 11. Contact Details Table
```sql
CREATE TABLE `contact_details` (
  `sr_no` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(50) NOT NULL,
  `gmap` varchar(100) NOT NULL,
  `pn1` bigint(20) NOT NULL,
  `pn2` bigint(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fb` varchar(100) NOT NULL,
  `insta` varchar(100) NOT NULL,
  `tw` varchar(100) NOT NULL,
  `iframe` varchar(300) NOT NULL,
  PRIMARY KEY (`sr_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

#### 12. Settings Table
```sql
CREATE TABLE `settings` (
  `sr_no` int(11) NOT NULL AUTO_INCREMENT,
  `site_title` varchar(50) NOT NULL,
  `site_about` varchar(250) NOT NULL,
  `shutdown` tinyint(1) NOT NULL,
  PRIMARY KEY (`sr_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

#### 13. Team Details Table
```sql
CREATE TABLE `team_details` (
  `sr_no` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `picture` varchar(150) NOT NULL,
  PRIMARY KEY (`sr_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

#### 13. User Queries Table
```sql
CREATE TABLE `user_queries` (
  `sr_no` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`sr_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

---

## Configuration

### Database Configuration

The database configuration is located in:
```
/admin/inc/db_config.php
```

**Default Configuration:**
```php
<?php
$hname = 'localhost';
$uname = 'root';
$pass = '';
$db = 'hotel-booking-website';

$con = mysqli_connect($hname, $uname, $pass, $db);
if (!$con) {
    die("cannot connect to database" . mysqli_connect_error());
}
?>
```

### Modify Configuration (if needed)

If your MySQL setup is different, update the following variables:
- `$hname` - MySQL host (usually `localhost`)
- `$uname` - MySQL username (default: `root`)
- `$pass` - MySQL password (default: empty for XAMPP)
- `$db` - Database name (`hotel-booking-website`)

**Note**: The same configuration is also referenced in:
- `Form.php` (user registration)
- `login.php` (user login)

Make sure all files use consistent database credentials!

---

## Running the Application

### Step 1: Start Services

1. Open **XAMPP Control Panel**
2. Start **Apache** server
3. Start **MySQL** server
4. Ensure both services show "Running" status (green indicator)

### Step 2: Access the Website

Open your web browser and navigate to:

```
http://localhost/Hotel-booking-website/
```

or

```
http://127.0.0.1/Hotel-booking-website/
```

### Step 3: Explore the Website

#### User Side Pages:
- **Home Page**: `http://localhost/Hotel-booking-website/index.php`
- **Rooms**: `http://localhost/Hotel-booking-website/rooms.php`
- **Facilities**: `http://localhost/Hotel-booking-website/facilities.php`
- **Contact**: `http://localhost/Hotel-booking-website/contact.php`
- **About**: `http://localhost/Hotel-booking-website/about.php`
- **Booking**: `http://localhost/Hotel-booking-website/booking.php`

#### User Authentication:
- **Login**: Click "Login" button in header
- **Register**: Click "Register" button in header

---

## Database Schema and Relations

### Entity Relationship Overview

```
┌─────────────┐         ┌──────────────┐         ┌─────────────┐
│   rooms     │◄────────│room_features │────────►│  features   │
│             │         │              │         │             │
│ - id (PK)   │         │- sr_no (PK)  │         │ - id (PK)   │
│ - name      │         │- room_id(FK) │         │ - name      │
│ - area      │         │- features_id │         └─────────────┘
│ - price     │         │    (FK)      │
│ - quantity  │         └──────────────┘
│ - adult     │
│ - children  │         ┌──────────────┐         ┌─────────────┐
│ - desc      │◄────────│room_facilities│───────►│ facilities  │
│ - status    │         │              │         │             │
│ - removed   │         │- sr_no (PK)  │         │ - id (PK)   │
└─────────────┘         │- room_id(FK) │         │ - icon      │
       │                │- facilities_ │         │ - name      │
       │                │   id (FK)    │         │ - desc      │
       │                └──────────────┘         └─────────────┘
       │
       │                ┌──────────────┐
       └────────────────│ room_images  │
                        │              │
                        │- sr_no (PK)  │
                        │- room_id(FK) │
                        │- image       │
                        │- thumb       │
                        └──────────────┘
```

### Key Relationships:

1. **rooms ↔ features** (Many-to-Many via `room_features`)
   - Each room can have multiple features (WiFi, TV, AC, etc.)
   - Each feature can belong to multiple rooms

2. **rooms ↔ facilities** (Many-to-Many via `room_facilities`)
   - Each room can have multiple facilities (Gym, Pool, Spa, etc.)
   - Each facility can belong to multiple rooms

3. **rooms → room_images** (One-to-Many)
   - Each room can have multiple images
   - CASCADE DELETE: Deleting a room deletes all its images

4. **user_cred** (Independent)
   - Stores user registration information
   - Handles authentication

5. **admin_cred** (Independent)
   - Stores admin credentials
   - Handles admin authentication

### Database Operations

The project uses prepared statements for security:

```php
// Example from db_config.php
function select($sql, $values, $datatypes) {
    global $con;
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}
```

**Common Functions:**
- `select()` - SELECT queries with prepared statements
- `insert()` - INSERT queries with prepared statements
- `update()` - UPDATE queries with prepared statements
- `delete()` - DELETE queries with prepared statements
- `selectAll()` - Simple SELECT * queries
- `filteration()` - Sanitize input data

---

## Admin Panel Access

### Accessing Admin Panel

Navigate to the admin login page:
```
http://localhost/Hotel-booking-website/admin/
```

### Default Admin Credentials

After creating the admin account in the database:
- **Username**: `admin`
- **Password**: `admin123`

**⚠️ IMPORTANT SECURITY NOTE**: Change the default password immediately after first login!

### Admin Dashboard Pages

Once logged in, you'll have access to:

1. **Dashboard** (`dashboard.php`)
   - Overview and general settings
   - Site title and description
   - Shutdown website control

2. **Rooms Management** (`rooms.php`)
   - Add new rooms
   - Edit room details (name, area, price, capacity)
   - Add/remove room images
   - Assign features and facilities
   - Delete rooms

3. **Features & Facilities** (`features_facilities.php`)
   - Manage room features (WiFi, TV, etc.)
   - Manage facilities (Pool, Gym, etc.)
   - Add/edit/delete features and facilities

4. **Carousel Management** (`carousel.php`)
   - Upload carousel images
   - Delete carousel images
   - Images appear on homepage

5. **User Management** (`users.php`)
   - View all registered users
   - Ban/unban users
   - Delete user accounts

6. **User Queries** (`user_queries.php`)
   - View contact form submissions
   - Mark queries as seen/unseen
   - Delete queries

7. **Settings** (`settings.php`)
   - General settings
   - Contact details
   - Team member management
   - Social media links

### Admin Features:

- **Room Management**: Complete CRUD operations
- **Image Upload**: Upload room images and carousel images
- **User Control**: Ban/unban problematic users
- **Content Management**: Update site information
- **Booking Overview**: View and manage bookings
- **Review Management**: Monitor user reviews

---

## Project Structure

```
Hotel-booking-website/
├── admin/                          # Admin panel
│   ├── ajax/                       # Admin AJAX handlers
│   │   ├── carousel_crud.php      # Carousel operations
│   │   ├── features_facilities.php # Features/facilities operations
│   │   ├── rooms.php              # Room operations
│   │   ├── settings_crud.php      # Settings operations
│   │   └── users.php              # User operations
│   ├── assets/                    # Admin CSS/JS
│   ├── inc/                       # Admin includes
│   │   ├── db_config.php         # Database configuration
│   │   ├── essentials.php        # Helper functions
│   │   ├── header.php            # Admin header
│   │   ├── links.php             # Admin CSS/JS links
│   │   └── scripts.php           # Admin scripts
│   ├── scripts/                  # Admin JavaScript files
│   ├── carousel.php              # Carousel management page
│   ├── dashboard.php             # Admin dashboard
│   ├── features_facilities.php   # Features/facilities page
│   ├── index.php                 # Admin login
│   ├── rooms.php                 # Rooms management page
│   ├── settings.php              # Settings page
│   ├── user_queries.php          # User queries page
│   └── users.php                 # User management page
├── ajax/                          # User-side AJAX handlers
│   └── login_register.php        # Login/register handler
├── assets/                        # User-side CSS/JS
│   ├── common.css                # Common styles
│   └── script.js                 # Common scripts
├── images/                        # Static images
│   ├── carousel/                 # Homepage carousel images
│   ├── facilities/               # Facility icons/images
│   ├── features/                 # Feature icons
│   └── rooms/                    # Room images
├── inc/                           # User-side includes
│   ├── footer.php                # Footer component
│   ├── header.php                # Header component
│   └── links.php                 # CSS/JS links
├── uploads/                       # User uploaded files
├── about.php                      # About page
├── booking.php                    # Booking page
├── booking_success.php            # Booking confirmation
├── contact.php                    # Contact page
├── facilities.php                 # Facilities page
├── Form.php                       # User registration handler
├── index.php                      # Homepage
├── login.php                      # Login handler
├── logout.php                     # Logout handler
├── room_details.php               # Individual room details
├── rooms.php                      # Rooms listing
├── success.php                    # Success page
└── README.md                      # Project documentation
```

### Key Directories:

- **`/admin`**: All admin panel related files
- **`/inc`**: Reusable PHP components (header, footer, etc.)
- **`/ajax`**: AJAX request handlers
- **`/images`**: Static images for the website
- **`/uploads`**: User-uploaded content (profile pics, etc.)
- **`/assets`**: CSS and JavaScript files

---

## Troubleshooting

### Common Issues and Solutions

#### 1. Database Connection Failed

**Error**: "Cannot connect to database"

**Solutions**:
- Verify MySQL service is running in XAMPP
- Check database credentials in `/admin/inc/db_config.php`
- Ensure database `hotel-booking-website` exists
- Default XAMPP MySQL: username=`root`, password=empty

```bash
# Test MySQL connection
mysql -u root -p
# (Press Enter if no password)

# List databases
SHOW DATABASES;
```

#### 2. Page Not Found (404 Error)

**Error**: "The requested URL was not found"

**Solutions**:
- Verify Apache is running in XAMPP
- Check that project is in correct directory (`htdocs`)
- Access via: `http://localhost/Hotel-booking-website/`
- Check for typos in URL

#### 3. Images Not Loading

**Solutions**:
- Check file permissions on `images/` and `uploads/` directories
- Verify images exist in correct directories
- Check browser console for 404 errors
- Clear browser cache

```bash
# Linux/Mac - Set proper permissions
chmod -R 755 images/
chmod -R 755 uploads/
```

#### 4. PHP Errors Displayed

**Error**: PHP warnings/notices on page

**Solutions**:
- Enable error reporting for debugging (development only):
  ```php
  // Add to top of files
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  ```
- Check PHP version (requires 7.4+)
- Disable error display in production

#### 5. Cannot Login to Admin Panel

**Solutions**:
- Verify `admin_cred` table exists
- Check if admin record exists:
  ```sql
  SELECT * FROM admin_cred;
  ```
- Reset admin password:
  ```sql
  UPDATE admin_cred SET admin_pass='admin123' WHERE admin_name='admin';
  ```

#### 6. Bootstrap/CSS Not Loading

**Solutions**:
- Check internet connection (Bootstrap loaded from CDN)
- Verify `inc/links.php` is included in pages
- Check browser console for errors
- Try clearing browser cache

#### 7. AJAX Requests Failing

**Solutions**:
- Check browser console for JavaScript errors
- Verify AJAX file paths are correct
- Ensure database connection is working
- Check PHP error logs

#### 8. File Upload Issues

**Solutions**:
- Check PHP upload settings in `php.ini`:
  ```ini
  upload_max_filesize = 10M
  post_max_size = 10M
  ```
- Verify directory permissions on `uploads/`
- Check file size limits
- Restart Apache after php.ini changes

#### 9. Session Issues

**Solutions**:
- Ensure `session_start()` is called at top of files
- Check session storage directory permissions
- Clear browser cookies
- Try incognito/private browsing mode

#### 10. Port Already in Use

**Error**: Apache/MySQL won't start - port 80 or 3306 in use

**Solutions**:
- Change Apache port in XAMPP config (httpd.conf)
- Stop other web servers (IIS, Skype, etc.)
- Change MySQL port in my.ini
- Restart XAMPP services

---

## Additional Configuration

### Email Configuration (Optional)

For email functionality (password reset, booking confirmation):
1. Configure SMTP settings in relevant files
2. Use PHPMailer or similar library
3. Update email credentials

### Payment Gateway Integration (Optional)

To enable online payments:
1. Sign up for payment gateway (Stripe, PayPal, etc.)
2. Add API credentials to configuration
3. Implement payment processing in booking flow

### Security Best Practices

1. **Change Default Credentials**: Update admin password immediately
2. **Use Strong Passwords**: Minimum 12 characters with mixed case, numbers, symbols
3. **Enable HTTPS**: Use SSL certificate for production
4. **Regular Backups**: Backup database regularly
5. **Update Dependencies**: Keep PHP and libraries updated
6. **Input Validation**: Already implemented with prepared statements
7. **File Upload Security**: Validate file types and sizes
8. **Error Handling**: Disable error display in production
9. **SQL Injection Prevention**: Using prepared statements (already implemented)
10. **XSS Prevention**: Input filtration implemented in `db_config.php`

---

## Maintenance

### Database Backup

```bash
# Backup database
mysqldump -u root hotel-booking-website > backup.sql

# Restore database
mysql -u root hotel-booking-website < backup.sql
```

### Regular Tasks

- Monitor user queries and respond promptly
- Review and moderate user reviews
- Update room availability and pricing
- Check booking records for conflicts
- Monitor website performance
- Review admin and user activity logs

---

## Support and Contact

For issues or questions:
1. Check the [README.md](README.md) file
2. Review this documentation thoroughly
3. Contact project contributors (listed in README.md)
4. Check GitHub Issues page

---

## License

This project is licensed under the MIT License. See the LICENSE file for details.

---

## Credits

**Project Contributors:**
1. [Faiza Mohammed](https://github.com/72730882)
2. [Rediet Muluken](https://github.com/redu95)
3. [Fenet Damena](https://github.com/Fenet-damena)
4. [Gelila Mihirke](https://github.com/Gelilamihirke)
5. [Tsehay Goremes](https://github.com/tseehay)
6. [Betel B/Meskel](https://github.com/Betel-B)

**Technologies:**
- Bootstrap 5
- Swiper.js
- PHP
- MySQL
- AJAX

---

**Last Updated**: February 2026

For the latest updates, visit: [https://github.com/Tseehay/Hotel-booking-website](https://github.com/Tseehay/Hotel-booking-website)
