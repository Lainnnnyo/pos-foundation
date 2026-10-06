<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simon Andrei | Home</title>
    <link rel="stylesheet" href="/css/site.css?v=tsa2-1">
</head>
<body>
    <?= view('partials/navigation') ?>

    <main class="home">
        <p class="eyebrow">WELCOME TO MY HOMEPAGE</p>
        <h1>Hi, I'm Simon Andrei Dimaculangan.</h1>
        <p>I enjoy learning to code and building projects with HTML, CSS, and Java.</p>

        <section class="project">
            <p class="eyebrow">FEATURED PROJECT</p>
            <h2>Tasks for Today</h2>
            <p>Track what needs doing and keep your work organized.</p>
            <a class="button-link" href="/tasks">View all tasks</a>
            <?php if (session('isLoggedIn')): ?><a class="button-link" href="/tasks/new">+ New task</a><?php endif; ?>
        </section>

        <section class="project">
            <p class="eyebrow">UPCOMING TASKS</p>
            <?php if ($tasks === []): ?>
                <p>No active tasks yet.</p>
            <?php else: ?>
                <ul class="task-preview">
                    <?php foreach ($tasks as $task): ?>
                        <li><span><?= esc($task['title']) ?></span><time datetime="<?= esc($task['task_date']) ?>"><?= esc($task['task_date']) ?></time></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </section>

        <section class="project">
            <p class="eyebrow">MORE PROJECTS</p>
            <h2>Point-of-Sale System</h2>
            <p>My CodeIgniter project for managing customers and users.</p>
            <a class="button-link" href="/customers">Customers</a>
        </section>
    </main>
</body>
</html>
