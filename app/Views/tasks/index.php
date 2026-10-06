<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Task List | Simon Dev</title><link rel="stylesheet" href="/css/site.css?v=tsa2-1"></head>
<body>
    <?= view('partials/navigation') ?>
    <main class="page-content">
        <p class="eyebrow">TASKS FOR TODAY</p><h1>Task List</h1><p>See everything still on your list.</p>
        <?php if (session()->getFlashdata('success')): ?><p class="notice" role="status"><?= esc(session()->getFlashdata('success')) ?></p><?php endif; ?>
        <?php if (session('isLoggedIn')): ?><a class="button-link" href="/tasks/new">+ New task</a><?php endif; ?>
        <?php if ($tasks === []): ?>
            <p class="empty-state">No active tasks found.</p>
        <?php else: ?>
            <div class="table-scroll"><table>
                <thead><tr><th>Title</th><th>Date</th><th>Status</th><?php if (session('isLoggedIn')): ?><th>Actions</th><?php endif; ?></tr></thead>
                <tbody>
                    <?php foreach ($tasks as $task): ?>
                        <tr>
                            <td><?= esc($task['title']) ?></td><td><?= esc($task['task_date']) ?></td><td><?= esc($task['status']) ?></td>
                            <?php if (session('isLoggedIn')): ?>
                                <td class="task-actions"><a href="/tasks/<?= (int) $task['id'] ?>/edit">Edit</a>
                                    <form method="post" action="/tasks/<?= (int) $task['id'] ?>/archive" onsubmit="return confirm('Archive this task?')">
                                        <?= csrf_field() ?><button type="submit" class="text-button">Delete</button>
                                    </form>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table></div>
        <?php endif; ?>
    </main>
</body>
</html>
