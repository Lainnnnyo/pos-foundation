<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Profile | Simon Dev</title><link rel="stylesheet" href="/css/site.css?v=tsa2-1"></head>
<body>
    <?= view('partials/navigation') ?>
    <main class="page-content"><p class="eyebrow">PROFILE</p><h1>Simon Andrei Dimaculangan</h1>
        <section class="project"><h2>About me</h2><p>I enjoy learning to code and building projects with HTML, CSS, and Java.</p></section>
        <?php if ($user): ?><section class="project"><h2>Your account</h2><p>Signed in as <?= esc($user['full_name']) ?> (<?= esc($user['username']) ?>).</p></section><?php endif; ?>
    </main>
</body>
</html>
