<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title><?= $task === null ? 'New Task' : 'Edit Task' ?> | Simon Dev</title><link rel="stylesheet" href="/css/site.css?v=tsa2-1"></head>
<body>
    <?= view('partials/navigation') ?>
    <main class="page-content">
        <p class="eyebrow">TASKS FOR TODAY</p><h1><?= $task === null ? 'New Task' : 'Edit Task' ?></h1>
        <?php if (session()->getFlashdata('error')): ?><p class="auth-error" role="alert"><?= esc(session()->getFlashdata('error')) ?></p><?php endif; ?>
        <form class="record-form" method="post" action="<?= $task === null ? '/tasks' : '/tasks/' . (int) $task['id'] . '/edit' ?>">
            <?= csrf_field() ?>
            <label for="title">Title</label>
            <input id="title" name="title" maxlength="255" value="<?= esc(old('title', $task['title'] ?? '')) ?>" required>
            <p class="field-error"><?= validation_show_error('title') ?></p>
            <label for="task_date">Task date</label>
            <input id="task_date" name="task_date" type="date" value="<?= esc(old('task_date', $task['task_date'] ?? '')) ?>" required>
            <p class="field-error"><?= validation_show_error('task_date') ?></p>
            <label for="status">Status</label>
            <?php $selectedStatus = old('status', $task['status'] ?? 'Pending'); ?>
            <select id="status" name="status" required>
                <?php foreach (['Pending', 'In Progress', 'Completed'] as $status): ?>
                    <option value="<?= esc($status) ?>" <?= $selectedStatus === $status ? 'selected' : '' ?>><?= esc($status) ?></option>
                <?php endforeach; ?>
            </select>
            <p class="field-error"><?= validation_show_error('status') ?></p>
            <button type="submit"><?= $task === null ? 'Create task' : 'Save changes' ?></button>
            <a class="form-cancel" href="/tasks">Cancel</a>
        </form>
    </main>
</body>
</html>
