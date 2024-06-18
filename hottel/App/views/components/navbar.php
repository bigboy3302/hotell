<header>
    <nav>
        <a href="/">Home</a>
        <a href="/reviews">Reviews</a>
        <a href="/reserve">Reserved apartments</a>
        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true): ?>
            <a href="/admin">Admin</a>
        <?php endif; ?>
        <a href="/profile">Profile Page</a>
    </nav>
</header>