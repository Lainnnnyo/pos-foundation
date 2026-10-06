<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Accounts</title>
    <link rel="stylesheet" href="/css/site.css">
</head>
<body>
    <header class="site-header">
        <a class="brand" href="/index.php">SIMON<span>_DEV</span></a>
        <nav aria-label="Main navigation">
            <a href="/index.php">Home</a>
            <a href="/customers">Customers</a>
            <a href="/users">Users</a>
            <form class="nav-logout" method="post" action="/logout"><?= csrf_field() ?><button type="submit">Log out</button></form>
        </nav>
    </header>

    <h1>User Accounts</h1>
    <a class="button-link add-customer" href="/users/new">+ New User</a>

    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Full Name</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= esc($user['username']) ?></td>
                    <td><?= esc($user['full_name']) ?></td>
                    <td><?= esc($user['role']) ?></td>
                    <td><a href="/users/<?= (int) $user['id'] ?>/edit">Edit</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
