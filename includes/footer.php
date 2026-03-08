
<?php
// footer.php
// Shared footer include for all pages. Displays authorisation statement, copyright, and footer navigation.
require_once __DIR__.'/config.php';
?>

</main>

<!-- Site footer -->
<footer role="contentinfo" aria-label="Site Footer">
    <div class="footer-content">
        <!-- Authorisation statement from config -->
        <p><?= htmlspecialchars($AUTHORISATION_STATEMENT) ?></p>
        <!-- Copyright and site name -->
        <p>&copy; <?= date('Y') ?> <?= htmlspecialchars($SITE_NAME) ?>. All rights reserved.</p>
        <!-- Footer navigation links -->
        <nav aria-label="Footer Navigation">
            <ul class="footer-nav">
                <li><a href="/campaign-control-platform/privacy.php">Privacy Policy</a></li>
                <li><a href="/campaign-control-platform/terms.php">Terms of Use</a></li>
            </ul>
        </nav>
    </div>
</footer>
<!-- Site-wide JavaScript -->
<script src="/campaign-control-platform/assets/js/app.js"></script>
</body>
</html>
