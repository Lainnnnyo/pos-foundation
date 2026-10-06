<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Customer | Simon Dev</title><link rel="stylesheet" href="/css/site.css?v=tsa2-1">
</head>
<body>
    <?= view('partials/navigation') ?>
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
