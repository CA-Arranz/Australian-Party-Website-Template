# Political Campaign Platform Migration Plan

## Directory Structure Proposal

```
/public/                # Public-facing pages (Home, About, Policies, Candidates, News, Events, Volunteer, Donate, Contact, Transparency)
/member/                # Party member portal (registration, login, dashboard, profile, export)
/admin/                 # Admin control panel (management tools, authentication, role-based access)
/modules/               # Modular campaign systems (membership, volunteers, donations, candidates, policies, news, events, compliance)
/auth/                  # Authentication, session, CSRF, CAPTCHA, rate limiting
/database/              # SQL schema, migration scripts, backup tools
/api/                   # REST endpoints for integration, automation, AJAX
/assets/                # Static assets (css, js, images, branding)
/docs/                  # Documentation, compliance, legal, party constitution, privacy, terms
/includes/              # Shared PHP includes (header, footer, config, db, helpers)
```

---

## Migration Plan

### Phase 1: Structure & Security Foundation
- Move public pages to `/public/`
- Move member pages to `/member/`
- Move admin pages to `/admin/`
- Create `/modules/` for campaign systems (membership, volunteers, donations, candidates, policies, news, events, compliance)
- Move authentication, session, CSRF, CAPTCHA, rate limiting logic to `/auth/`
- Move SQL schema and migration scripts to `/database/`
- Move static assets to `/assets/`
- Move documentation and legal files to `/docs/`
- Move shared includes to `/includes/`

### Phase 2: Membership System Upgrade
- Expand member registration to include suburb, state, postcode, status, join date, verification.
- Add member dashboard, profile management, export tools for compliance.
- Implement verification workflow and membership status tracking.

### Phase 3: Volunteer Management Expansion
- Add volunteer admin interface, role assignment, skills, availability, preferred roles.
- Enable volunteer coordination and export.

### Phase 4: Donation Management Upgrade
- Add donation tracking, payment method, disclosure status, financial summaries.
- Implement admin tools for donation management and public disclosure.

### Phase 5: Candidate & Policy Management
- Create candidate profile management (photo, electorate, biography, priorities, contact).
- Add policy publishing workflow, categories, admin controls.

### Phase 6: News, Events, Transparency
- Add news/media admin publishing tools.
- Expand event registration, admin management, export.
- Enhance transparency section with downloadable compliance reports, finance summaries.

### Phase 7: Admin Control Panel & Security
- Build secure admin panel with role-based permissions.
- Hide admin access from public navigation.
- Add CAPTCHA, rate limiting, improved input validation.
- Implement audit logging and compliance reporting UI.

### Phase 8: User Experience & Legal Compliance
- Add campaign hero section, branding, candidate/policy cards, responsive design, call-to-action buttons.
- Add legal compliance pages: Privacy Policy, Terms of Use, Party Constitution, Donation Policy.

---

## Best Practices

- Use prepared SQL statements, password hashing, CSRF protection, input validation, output escaping.
- Modularize code for maintainability and scalability.
- Implement secure session management and role-based access.
- Ensure compliance with Australian electoral and privacy laws.

---

## Internal System Assessment

**1. Structure & Coverage**
- Organized as a self-hosted PHP/MySQL website with modular includes and clear separation of concerns.
- Public pages: Home, About, Policies, Candidates, News, Events, Volunteer, Donate, Contact, Transparency.
- Admin pages: user management, compliance, party registration, webmaster tools.
- Membership, volunteer, donation, candidate, policy, news, event, and transparency systems are present, but some are basic and lack advanced management features.

**2. Security**
- Uses prepared SQL statements, password hashing, CSRF protection, and session management.
- Input validation and output escaping are present but should be more consistent.
- Admin access is visible in public navigation (should be hidden).
- No CAPTCHA or rate limiting on forms (should be added).
- Role-based permissions are not fully implemented.

**3. Usability**
- Responsive CSS and dark mode are implemented.
- Navigation is clear, but lacks campaign branding, hero section, and call-to-action buttons.
- Candidate and policy cards are present but could be improved for clarity and engagement.
- No member dashboard or advanced admin control panel.

**4. Architectural Weaknesses**
- Directory structure is flat; lacks modular separation (e.g., /modules, /api, /auth).
- Membership system is basic; does not support full electoral export or verification workflows.
- Volunteer and donation systems lack admin management interfaces.
- No API endpoints for integration or automation.
- No audit logging or compliance reporting UI.

**5. Missing Systems**
- Full party membership management (with export, verification, status, suburb/state/postcode).
- Volunteer admin interface and role assignment.
- Donation tracking, disclosure, and financial summaries.
- Candidate profile management and admin editing.
- Policy publishing workflow and admin controls.
- News/media admin publishing tools.
- Event registration management and admin controls.
- Transparency: downloadable compliance reports, finance summaries.
- Admin control panel with role-based permissions.
- Security upgrades: CAPTCHA, rate limiting, improved validation.

**6. Legal Compliance**
- Authorisation statement is present.
- Privacy Policy and Terms of Use pages exist.
- Party Constitution and Donation Policy pages are missing.

---

## Lead Architect Plan

1. Propose a new modular directory structure.
2. Upgrade membership, volunteer, donation, candidate, policy, news, event, and transparency systems.
3. Implement admin control panel with role-based permissions.
4. Enhance security (CAPTCHA, rate limiting, validation).
5. Improve UX (branding, hero, call-to-action).
6. Add legal compliance pages.

---

## Conversation Summary

- Primary Objectives: Build a compliant political party website, enable admin login and authentication, create a compliant membership system, update database schema for legal requirements.
- Session Context: Focused on implementing compliance-driven features, troubleshooting authentication, and building a legally compliant membership system.
- Technical Foundation: PHP, MySQL (XAMPP/MariaDB), HTML, CSS, JS. Session-based authentication, password hashing, secure database connection. SQL schema management for users and members tables.
- Codebase Status: admin/login.php, admin/add-user.php, includes/auth.php, includes/db.php/config.php, database/schema.sql, tools/generate-admin-password.php. Recent changes: password hash generation, admin user creation, members table schema update.
- Problem Resolution: Admin login failed due to truncated password hash (VARCHAR too short). Fixed by altering users table to VARCHAR(255), deleting and re-inserting admin user. Membership system requirements and schema provided for legal compliance.
- Progress Tracking: Completed Tasks: Admin authentication, party registration, compliance checklist, user management, dark mode, password hash generation, database schema update. Partially Complete Work: Membership registration form, user management pages, CSV export logic. Validated Outcomes: Admin user creation, members table schema update confirmed via terminal.
- Active Work State: Current Focus: Updating database schema to support compliant party membership registration. Recent Context: Last exchanges involved creating the members table via run_in_terminal, confirming schema update. Working Code: SQL for members table, password hash generation, admin user creation.
- Recent Operations: Last Agent Commands: run_in_terminal to create members table in campaign_platform database. Tool Results Summary: Table created successfully; previous commands confirmed admin user creation and schema update. Pre-Summary State: Agent was actively updating database schema for compliant membership registration. Operation Context: These operations directly support the user's goal of building a legally compliant party website.
- Continuation Plan: Pending Task 1: Build membership registration form and login system using new schema. Pending Task 2: Implement user management pages and CSV export logic for compliance. Priority Information: Ensure legal compliance, secure authentication, and exportable membership data. Next Action: Provide PHP form code for membership registration and login, implement user management and CSV export.

---

## Architect's Recommendation

Begin Phase 1: Directory restructuring and security foundation, then proceed through migration phases as outlined above. This will ensure a scalable, secure, and compliant campaign platform for real-world political operations in Australia.
