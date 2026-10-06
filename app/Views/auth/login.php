<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Staff Login | Simon Dev</title>
    <link rel="stylesheet" href="/css/site.css?v=tsa2-1">
</head>
<body>
    <?= view('partials/navigation') ?>
    <main class="auth-card">
        <p class="eyebrow">POINT OF SALE</p>
        <h1>Staff Login</h1>
        <?php if (session()->getFlashdata('error')): ?>
            <p class="auth-error" role="alert"><?= esc(session()->getFlashdata('error')) ?></p>
        <?php endif; ?>
        <form method="post" action="/login">
            <?= csrf_field() ?>
            <label for="username">Username</label>
            <input id="username" name="username" autocomplete="username" maxlength="50" value="<?= esc(old('username')) ?>" required>
            <label for="password">Password</label>
            <input id="password" name="password" type="password" autocomplete="current-password" required>
            <button type="submit">Log in</button>
        </form>
    </main>
</body>
</html>
