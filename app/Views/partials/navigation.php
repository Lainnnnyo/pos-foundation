<header class="site-header">
    <a class="brand" href="/index.php">SIMON<span>_DEV</span></a>
    <nav aria-label="Main navigation">
        <a href="/index.php">Home</a>
        <a href="/tasks">Tasks</a>
        <a href="/profile">Profile</a>
        <a href="/about">About</a>
        <a href="/customers">Customers</a>
        <a href="/users">Users</a>
        <?php if (session('isLoggedIn')): ?>
            <form class="nav-logout" method="post" action="/logout"><?= csrf_field() ?><button type="submit">Log out</button></form>
        <?php else: ?>
            <a href="/login">Log in</a>
        <?php endif; ?>
    </nav>
</header>
