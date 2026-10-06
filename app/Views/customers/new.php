<link rel="stylesheet" href="/css/site.css?v=tsa2-1">

<?= view('partials/navigation') ?>

<h1>New Customer</h1>

<form action="/customers" method="post">
    <?= csrf_field() ?>

    <label for="full_name">Full name</label>
    <input id="full_name" name="full_name" value="<?= esc(old('full_name')) ?>" required>
    <?= validation_show_error('full_name') ?>

    <label for="email">Email</label>
    <input id="email" name="email" type="email" value="<?= esc(old('email')) ?>" required>
    <?= validation_show_error('email') ?>
    
    <button type="submit">Save customer</button>
</form>
