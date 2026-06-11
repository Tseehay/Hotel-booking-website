# Hawassa Tourism & Hotel Booking Website

A dynamic web application tailored to the Ethiopian context, focused on tourism and hotel booking in Hawassa.

## Project Scope
- Promote tourism destinations in and around Hawassa
- Let users browse rooms, view facilities, and book online
- Allow administrators to manage rooms, amenities, content, and users

## Requirement Coverage
- **Responsive UI (HTML/CSS):** Bootstrap-based mobile-friendly pages for home, rooms, facilities, contact, booking, and admin screens.
- **Client-side interactivity (JavaScript):** Form handling, modal workflows, DOM updates, and multiple asynchronous `XMLHttpRequest`/fetch operations.
- **Server-side logic (PHP):** Session-based auth, booking and profile workflows, request handling, and admin business logic.
- **Data persistence (MySQL):** CRUD operations across interconnected tables such as `user_cred`, `rooms`, `room_images`, `features`, `facilities`, `room_features`, `room_facilities`, `settings`, and `contact_details`.
- **Security awareness:** Input filtering/sanitization, prepared statements in shared DB helpers, password hashing during registration, and password verification during login.

## Core Features
### User
- Account registration and login
- Browse room inventory and room details
- Submit booking requests
- View hotel facilities and contact information

### Admin
- Manage rooms and room images
- Manage room features and facilities
- Update website settings, contacts, and carousel
- Manage user-related records

## Technology Stack
- HTML5
- CSS3
- Bootstrap 5
- JavaScript (AJAX/fetch)
- PHP
- MySQL (mysqli)

## Local Setup
1. Place the project in your PHP server root (for example, XAMPP `htdocs`).
2. Create a MySQL database named `hotel-booking-website`.
3. Update database credentials in:
   - `admin/inc/db_config.php`
4. Start Apache and MySQL.
5. Open the app in your browser.

## Contributors
1. [Tsehay Goremes](https://github.com/tseehay)

