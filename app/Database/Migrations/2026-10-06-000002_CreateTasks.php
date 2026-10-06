<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTasks extends Migration
{
    public function up()
    {
        if (! $this->db->tableExists('tasks')) {
            $this->forge->addField([
                'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
                'title' => ['type' => 'VARCHAR', 'constraint' => 255],
                'status' => ['type' => 'VARCHAR', 'constraint' => 30, 'default' => 'Pending'],
                'task_date' => ['type' => 'DATE'],
                'is_archived' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
                'created_at' => ['type' => 'DATETIME', 'null' => true],
                'updated_at' => ['type' => 'DATETIME', 'null' => true],
            ]);
            $this->forge->addKey('id', true);
            $this->forge->createTable('tasks');
        } else {
            if (! $this->db->fieldExists('is_archived', 'tasks')) {
                $this->forge->addColumn('tasks', [
                    'is_archived' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
                ]);
            }
            if (! $this->db->fieldExists('created_at', 'tasks')) {
                $this->forge->addColumn('tasks', [
                    'created_at' => ['type' => 'DATETIME', 'null' => true],
                ]);
            }
            if (! $this->db->fieldExists('updated_at', 'tasks')) {
                $this->forge->addColumn('tasks', [
                    'updated_at' => ['type' => 'DATETIME', 'null' => true],
                ]);
            }
        }
    }

    public function down()
    {
        // Keep existing tasks intact when rolling back other migrations.
        if ($this->db->tableExists('tasks') && $this->db->fieldExists('is_archived', 'tasks')) {
            $this->forge->dropColumn('tasks', 'is_archived');
        }
    }
}
