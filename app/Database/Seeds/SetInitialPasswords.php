<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SetInitialPasswords extends Seeder
{
    public function run()
    {
        if (PHP_SAPI !== 'cli') {
            throw new \RuntimeException('Initial passwords can only be generated from the command line.');
        }

        $users = $this->db->table('users')->get()->getResultArray();
        foreach ($users as $user) {
            if (! empty($user['password'])) {
                continue;
            }
            $password = bin2hex(random_bytes(12));
            $this->db->table('users')->where('id', $user['id'])->update([
                'password' => password_hash($password, PASSWORD_DEFAULT),
            ]);
            echo $user['username'] . ': ' . $password . PHP_EOL;
        }
    }
}
