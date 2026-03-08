ROLE

You are a senior full-stack engineer, cybersecurity engineer, accessibility engineer, and civic-tech architect.

Your task is to generate a **complete offline-first political campaign platform** that runs on:

Linux
XAMPP (Apache + PHP + MySQL)
HTML
CSS
JavaScript

The system must be designed for **Australian political campaigns** and include transparency and authorisation requirements.

Output must be **fully runnable locally**.

No placeholders. No TODO comments.

---

PROJECT NAME

campaign-control-platform

---

CORE PURPOSE

Build a full political campaign platform that allows a political party or independent candidate to manage:

• website
• volunteers
• events
• voter outreach
• campaign messaging
• policy publishing
• candidate pages
• donation tracking
• compliance reporting
• media releases

The platform should work for:

federal elections
state elections
local elections

---

TECH STACK

Frontend
HTML5
CSS3
Vanilla JavaScript

Backend
PHP 8+

Database
MySQL / MariaDB

Server
Apache (XAMPP)

Environment
Linux

---

MAJOR SYSTEM MODULES

1. Public Website
2. Campaign Dashboard
3. Volunteer Management
4. Event Management
5. Policy Publishing System
6. Candidate Profiles
7. News / Media Releases
8. Donation Tracking
9. Voter Outreach CRM
10. Email Campaign System
11. Compliance & Transparency System
12. Analytics Dashboard
13. Admin Panel
14. Security Audit Logs

---

PUBLIC WEBSITE FEATURES

Home
About the Party
Policies
Candidates
News
Events
Volunteer Signup
Donate
Contact
Transparency
Privacy Policy
Terms of Use

Mandatory authorisation statement example:

"Authorised by [Name], [Campaign Name], [Address], Australia"

---

VOLUNTEER MANAGEMENT SYSTEM

Volunteer registration form

Fields:

name
email
phone
postcode
skills
availability

Admin dashboard allows:

view volunteers
assign roles
export volunteer lists
contact volunteers

---

EVENT MANAGEMENT

Create campaign events such as:

town halls
community meetings
fundraisers
volunteer training

Event features:

event calendar
location map
RSVP system
attendance tracking

---

CANDIDATE MANAGEMENT

Candidate profile system with:

photo
electorate
biography
policy positions
social media links

---

POLICY MANAGEMENT

Policy publishing system that allows:

structured policy pages
policy categories
policy search

Example categories:

economy
environment
health
education
technology
national security

---

DONATION TRACKING SYSTEM

Track donations internally.

Fields:

donor name
amount
date
payment method
public disclosure flag

Generate exportable reports for compliance with:

Australian Electoral Commission donation reporting requirements.

---

EMAIL CAMPAIGN SYSTEM

Simple campaign communication tool.

Admin can:

create mailing lists
send campaign updates
send volunteer alerts

---

VOTER OUTREACH CRM

Store outreach interactions.

Fields:

name
postcode
electorate
contact history
issues raised
support level

Used for:

door knocking
phone outreach
community engagement

---

ANALYTICS DASHBOARD

Dashboard charts showing:

volunteer growth
donations
event attendance
policy page views

---

SECURITY REQUIREMENTS

Implement:

prepared SQL statements
password hashing using password_hash()
password_verify()
CSRF tokens
secure PHP sessions
input validation
XSS protection

Prevent:

SQL injection
XSS
CSRF
session hijacking

---

ACCESSIBILITY

Follow WCAG 2.1 guidelines.

Include:

semantic HTML
ARIA labels
keyboard navigation
screen reader compatibility
large clickable buttons

---

DATABASE TABLES

users
volunteers
donations
candidates
policies
events
event_rsvps
news_posts
contact_messages
voters
outreach_logs
email_lists
email_campaigns
audit_logs

---

FILE STRUCTURE

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

---

INSTALLATION INSTRUCTIONS

Provide instructions for:

installing XAMPP on Linux

creating MySQL database

importing schema.sql

placing project in:

/opt/lampp/htdocs/

running Apache + MySQL

accessing the site in browser

---

DESIGN STYLE

Clean
professional
government-style

Colours:

navy blue
white
gold accent

Typography:

clear sans-serif fonts

---

OUTPUT REQUIREMENTS

Output must include:

1. Folder tree
2. Full source code for every file
3. SQL schema
4. Setup instructions
5. Security explanation

Everything must run on Linux + XAMPP without modification.

---

GOAL

Create a secure, transparent, accessible campaign management platform suitable for a real Australian political campaign.
