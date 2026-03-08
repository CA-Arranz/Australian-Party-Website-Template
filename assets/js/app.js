
// app.js - Campaign Control Platform
// Accessibility enhancements: keyboard navigation, ARIA, and focus management for improved usability.

document.addEventListener('DOMContentLoaded', function() {
    // Enable keyboard navigation for main navigation links
    const navLinks = document.querySelectorAll('.nav a');
    navLinks.forEach(link => {
        link.addEventListener('keydown', function(e) {
            // Allow Enter or Space to activate links
            if (e.key === 'Enter' || e.key === ' ') {
                link.click();
            }
        });
    });

    // Focus main content area when Tab is pressed from body
    const main = document.getElementById('main-content');
    if (main) {
        document.body.addEventListener('keydown', function(e) {
            // If Tab is pressed and focus is on body, move focus to main content
            if (e.key === 'Tab' && document.activeElement === document.body) {
                main.focus();
            }
        });
    }
});
