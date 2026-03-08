# Codebase Review: Prioritized Issues & Recommendations

## Critical

1. **Admin Link Visible to All Users**
   - Issue: The "Admin" link was visible to all users in navigation.
   - Fix: Now conditionally rendered for authenticated admin/webmaster users. ✅

2. **Inconsistent Input Validation and Output Escaping**
   - Issue: Some forms (contact, volunteer, donate, index) do not consistently validate/sanitize input or escape output.
   - Fix: Use `filter_var`, regex, and `htmlspecialchars` for all user input/output. Review all form handlers for missing validation.

3. **No CAPTCHA or Rate Limiting on Forms**
   - Issue: Public forms are vulnerable to spam/automated attacks.
   - Fix: Add Google reCAPTCHA and rate limiting to all public forms.

---

## High

4. **Role-Based Permissions Not Fully Implemented**
   - Issue: Some admin pages only check for login, not for specific roles.
   - Fix: Enforce role checks (admin/webmaster) before granting access to sensitive pages.

5. **Session Management**
   - Issue: `session_start` not always called before session usage; no session regeneration on login.
   - Fix: Always call `session_start` at the top; use `session_regenerate_id(true)` on login.

---

## Medium

6. **Accessibility: Navigation and ARIA**
   - Issue: Navigation is keyboard accessible, but ARIA labels could be more descriptive; no skip-to-content link.
   - Fix: Add skip-to-content link; review and improve ARIA labels.

7. **CSS Structure and Redundant Code**
   - Issue: Redundant selectors, orphaned lines, and previous dark mode remnants in CSS.
   - Fix: Clean up CSS, remove unused/duplicate rules, ensure all blocks are closed.

8. **Database Error Handling**
   - Issue: Errors are displayed to users via `die()`, leaking information.
   - Fix: Log errors internally, show generic error messages to users.

---

## Low

9. **Inconsistent Naming and Formatting**
   - Issue: Some files use inconsistent naming conventions or formatting.
   - Fix: Standardize naming (camelCase for PHP, kebab-case for CSS).

10. **Modular Structure Could Be Improved**
    - Issue: Some logic is in public pages instead of modules.
    - Fix: Move business logic to modules for maintainability.

11. **Unused or Redundant Code**
    - Issue: Orphaned lines and old dark mode code in CSS.
    - Fix: Remove all unused code and comments.

---

## Additional Information Needed

- Are all admin/member pages protected by session and role checks?
- Is there a centralized error log for security events?
- Are any AJAX/API endpoints exposed without authentication?
- Are privacy and legal compliance pages up to date?

---

## Summary Table

| Severity   | Issue                                      | File(s)                        | Fix/Improvement                |
|------------|--------------------------------------------|-------------------------------|-------------------------------|
| Critical   | Admin link visible to all                  | header.php                    | Conditional rendering         |
| Critical   | Input validation/output escaping           | contact.php, volunteer.php    | Sanitize/escape everywhere    |
| Critical   | No CAPTCHA/rate limiting                   | All forms                     | Add CAPTCHA/rate limiting     |
| High       | Role-based permissions                     | admin/, auth.php              | Enforce role checks           |
| High       | Session management                         | auth.php, admin login         | Regenerate session ID         |
| Medium     | Accessibility/ARIA                         | app.js, header.php            | Add skip link, review ARIA    |
| Medium     | CSS structure/redundant code               | style.css                     | Clean up CSS                  |
| Medium     | Database error handling                    | db.php                        | Generic user errors           |
| Low        | Naming/formatting                          | Multiple                      | Standardize                   |
| Low        | Modular structure                          | Multiple                      | Move logic to modules         |
| Low        | Unused/redundant code                      | style.css                     | Remove unused code            |

---

Let me know which issues you want to fix next, or if you want a step-by-step remediation plan for the most critical items.
