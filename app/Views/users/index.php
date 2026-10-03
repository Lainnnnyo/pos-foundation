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
        </nav>
    </header>

    <h1>User Accounts</h1>

    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Full Name</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= esc($user['username']) ?></td>
                    <td><?= esc($user['full_name']) ?></td>
                    <td><?= esc($user['role']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
