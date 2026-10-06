<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Customer | Simon Dev</title><link rel="stylesheet" href="/css/site.css">
</head>
<body>
    <header class="site-header"><a class="brand" href="/">SIMON<span>_DEV</span></a>
        <nav aria-label="Main navigation"><a href="/">Home</a><a href="/customers">Customers</a><a href="/users">Users</a>
            <form class="nav-logout" method="post" action="/logout"><?= csrf_field() ?><button>Log out</button></form>
        </nav>
    </header>
    <h1>Edit Customer</h1>
    <form class="record-form" method="post" action="/customers/<?= (int) $customer['id'] ?>/edit">
        <?= csrf_field() ?>
        <label for="full_name">Full name</label>
        <input id="full_name" name="full_name" maxlength="100" value="<?= esc(old('full_name', $customer['full_name'])) ?>" required>
        <?= validation_show_error('full_name') ?>
        <label for="email">Email</label>
        <input id="email" name="email" type="email" maxlength="100" value="<?= esc(old('email', $customer['email'])) ?>" required>
        <?= validation_show_error('email') ?>
        <label for="phone">Phone</label>
        <input id="phone" name="phone" maxlength="20" value="<?= esc(old('phone', $customer['phone'] ?? '')) ?>">
        <?= validation_show_error('phone') ?>
        <button type="submit">Save changes</button>
    </form>
</body>
</html>
