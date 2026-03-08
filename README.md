# Campaign Control Platform

A complete offline-first political campaign platform for Australian elections, built for Linux + XAMPP (Apache, PHP, MySQL).

## Features
- Public website (home, about, policies, candidates, news, events, volunteer, donate, contact, transparency)
- Admin dashboard
- Volunteer management
- Event management
- Policy publishing
- Candidate profiles
- News/media releases
- Donation tracking
- Voter outreach CRM
- Email campaign system
- Compliance & transparency
- Analytics dashboard
- Security audit logs

## Installation Instructions

### 1. Install XAMPP on Linux
- Download XAMPP from https://www.apachefriends.org/index.html
- Run: `sudo chmod +x xampp-linux-x64-*.run`
- Install: `sudo ./xampp-linux-x64-*.run`
- Start XAMPP: `sudo /opt/lampp/lampp start`

### 2. Create MySQL Database
- Open phpMyAdmin: http://localhost/phpmyadmin/
- Create a new database: `campaign_platform`

### 3. Import Database Schema
- In phpMyAdmin, select `campaign_platform`
- Go to Import tab
- Import `database/schema.sql`

### 4. Place Project Files
- Copy the `campaign-control-platform` folder to `/opt/lampp/htdocs/`

### 5. Set Permissions
- Ensure Apache user can read/write files as needed

### 6. Run Apache & MySQL
- Start XAMPP: `sudo /opt/lampp/lampp start`

### 7. Access the Site
- Open browser: http://localhost/campaign-control-platform/

## Security Explanation
- All database queries use prepared statements to prevent SQL injection
- Passwords are hashed using `password_hash()` and verified with `password_verify()`
- CSRF tokens are used for all forms
- Secure PHP sessions are implemented
- Input validation and XSS protection on all user input
- Audit logs track admin actions

## Accessibility
- WCAG 2.1 compliant
- Semantic HTML, ARIA labels, keyboard navigation, screen reader support
- Large clickable buttons, clear sans-serif fonts

## Authorisation Statement Example
"Authorised by [Name], [Campaign Name], [Address], Australia"

## File Structure
```
campaign-control-platform
│
├── index.php
├── about.php
├── policies.php
├── candidates.php
├── news.php
├── events.php
├── volunteer.php
├── donate.php
├── contact.php
├── transparency.php
│
├── admin
│   ├── login.php
│   ├── dashboard.php
│   ├── volunteers.php
│   ├── events.php
│   ├── candidates.php
│   ├── policies.php
│   ├── donations.php
│   ├── outreach.php
│   ├── emails.php
│   └── analytics.php
│
├── assets
│   ├── css
│   │   └── style.css
│   ├── js
│   │   └── app.js
│   └── images
│
├── includes
│   ├── config.php
│   ├── db.php
│   ├── header.php
│   ├── footer.php
│   ├── auth.php
│   └── csrf.php
│
├── database
│   └── schema.sql
│
└── README.md
```
