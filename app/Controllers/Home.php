<?php

namespace App\Controllers;

use App\Models\TaskModel;
use App\Models\UserModel;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message', [
            'tasks' => (new TaskModel())->where('is_archived', 0)->orderBy('task_date', 'ASC')->findAll(5),
        ]);
    }

    public function profile(): string
    {
        $user = session('userId') ? (new UserModel())->find((int) session('userId')) : null;

        return view('pages/profile', ['user' => $user]);
    }

    public function about(): string
    {
        return view('pages/about');
    }
}
