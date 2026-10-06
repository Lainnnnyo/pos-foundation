<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DemoTasks extends Seeder
{
    public function run()
    {
        if ($this->db->table('tasks')->countAllResults() > 0) {
            return;
        }

        $today = date('Y-m-d');
        $this->db->table('tasks')->insertBatch([
            ['title' => 'Plan the day', 'status' => 'Completed', 'task_date' => $today, 'is_archived' => 0, 'created_at' => date('Y-m-d H:i:s')],
            ['title' => 'Review project notes', 'status' => 'In Progress', 'task_date' => $today, 'is_archived' => 0, 'created_at' => date('Y-m-d H:i:s')],
            ['title' => 'Finish the next activity', 'status' => 'Pending', 'task_date' => date('Y-m-d', strtotime('+1 day')), 'is_archived' => 0, 'created_at' => date('Y-m-d H:i:s')],
        ]);
    }
}
