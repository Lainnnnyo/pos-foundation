<?php

namespace App\Controllers;

use App\Models\TaskModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Tasks extends BaseController
{
    private const RULES = [
        'title' => 'required|max_length[255]',
        'task_date' => 'required|valid_date[Y-m-d]',
        'status' => 'required|in_list[Pending,In Progress,Completed]',
    ];

    public function index(): string
    {
        return view('tasks/index', [
            'tasks' => (new TaskModel())->where('is_archived', 0)->orderBy('task_date', 'ASC')->findAll(),
        ]);
    }

    public function new(): string
    {
        helper('form');
        return view('tasks/form', ['task' => null]);
    }

    public function create()
    {
        $data = $this->request->getPost();
        if (! $this->validateData($data, self::RULES)) {
            return redirect()->back()->withInput();
        }

        $validated = $this->validator->getValidated();
        $validated['title'] = trim($validated['title']);
        if ($validated['title'] === '') {
            return redirect()->back()->withInput()->with('error', 'Title is required.');
        }
        (new TaskModel())->insert($validated);

        return redirect()->to('/tasks')->with('success', 'Task created.');
    }

    public function edit(int $id): string
    {
        $task = $this->activeTask($id);
        helper('form');
        return view('tasks/form', ['task' => $task]);
    }

    public function update(int $id)
    {
        $this->activeTask($id);
        $data = $this->request->getPost();
        if (! $this->validateData($data, self::RULES)) {
            return redirect()->back()->withInput();
        }

        $validated = $this->validator->getValidated();
        $validated['title'] = trim($validated['title']);
        if ($validated['title'] === '') {
            return redirect()->back()->withInput()->with('error', 'Title is required.');
        }
        (new TaskModel())->update($id, $validated);

        return redirect()->to('/tasks')->with('success', 'Task updated.');
    }

    public function archive(int $id)
    {
        $this->activeTask($id);
        (new TaskModel())->update($id, ['is_archived' => 1]);

        return redirect()->to('/tasks')->with('success', 'Task archived.');
    }

    private function activeTask(int $id): array
    {
        $task = (new TaskModel())->where('is_archived', 0)->find($id);
        if (! $task) {
            throw PageNotFoundException::forPageNotFound();
        }

        return $task;
    }
}
