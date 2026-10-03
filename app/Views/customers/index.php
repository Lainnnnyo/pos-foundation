<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Accounts</title>
    <link rel="stylesheet" href="/css/site.css">
</head>
<body>
    
   <header class="site-header">
    <a class="brand" href="/">SIMON<span>_DEV</span></a>
    <nav aria-label="Main navigation">
        <a href="/">Home</a>
        <a href="/customers">Customers</a>
        <a href="/users">Users</a>
    </nav>
    </header>

    <h1>Customer Accounts</h1>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?= esc($customer['full_name']) ?></td>
                    <td><?= esc($customer['email']) ?></td>
                    <td><?= esc($customer['phone']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
