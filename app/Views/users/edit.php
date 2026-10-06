<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit User | Simon Dev</title><link rel="stylesheet" href="/css/site.css?v=tsa2-1">
</head>
<body>
    <?= view('partials/navigation') ?>
    <h1>Edit User</h1>
    <form class="record-form" method="post" action="/users/<?= (int) $user['id'] ?>/edit">
        <?= csrf_field() ?>
        <?php if (session()->getFlashdata('error')): ?><p class="auth-error" role="alert"><?= esc(session()->getFlashdata('error')) ?></p><?php endif; ?>
        <label for="username">Username</label><input id="username" name="username" minlength="4" maxlength="50" value="<?= esc(old('username', $user['username'])) ?>" required>
        <?= validation_show_error('username') ?>
        <label for="full_name">Full name</label><input id="full_name" name="full_name" maxlength="100" value="<?= esc(old('full_name', $user['full_name'])) ?>" required>
        <?= validation_show_error('full_name') ?>
        <label for="role">Role</label><select id="role" name="role" required>
            <?php foreach (['Administrator', 'Manager', 'Cashier', 'Staff'] as $role): ?>
                <option value="<?= esc($role) ?>" <?= old('role', $user['role']) === $role ? 'selected' : '' ?>><?= esc($role) ?></option>
            <?php endforeach; ?>
        </select>
        <?= validation_show_error('role') ?>
        <label for="password">New password (leave blank to keep current)</label><input id="password" name="password" type="password" minlength="12" autocomplete="new-password">
        <?= validation_show_error('password') ?>
        <button type="submit">Save changes</button>
    </form>
</body>
</html>
