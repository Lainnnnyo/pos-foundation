<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer Accounts</title>
    <link rel="stylesheet" href="/css/site.css?v=tsa2-1">
</head>
<body>
    <?= view('partials/navigation') ?>

    <h1>Customer Accounts</h1>
    <a class="button-link add-customer" href="/customers/new">+ New Customer</a>

    <table>
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?= esc($customer['full_name']) ?></td>
                    <td><?= esc($customer['email']) ?></td>
                    <td><?= esc($customer['phone']) ?></td>
                    <td><a href="/customers/<?= (int) $customer['id'] ?>/edit">Edit</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
