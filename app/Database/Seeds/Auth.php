<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Auth extends Seeder
{
    public function run()
    {
        $auth_groups = [
            [
                'name' => 'owner',
                'description' => 'pemilik',
            ],
            [
                'name' => 'admin',
                'description' => 'administrator',
            ],
            [
                'name' => 'pegawai',
                'description' => 'kepegawaian'
            ]
        ];
        $this->db->table('auth_groups')->insertBatch($auth_groups);

        $auth_permissions = [
            [
                'name' => 'manage-users',
                'description' => 'Manage All Users'
            ],
            [
                'name' => 'manage-profile',
                'description' => "Manage user's profile",
            ],
            [
                'name' => 'manage-supplier',
                'description' => 'Manage data supplier'
            ]
        ];
        $this->db->table('auth_permissions')->insertBatch($auth_permissions);

        $auth_groups_permissions = [
            [
                'group_id' => 1,
                'permission_id' => 1,
            ],
            [
                'group_id' => 1,
                'permission_id' => 2,
            ],
            [
                'group_id' => 1,
                'permission_id' => 3,
            ],
            [
                'group_id' => 2,
                'permission_id' => 2,
            ],
            [
                'group_id' => 2,
                'permission_id' => 3,
            ],
            [
                'group_id' => 3,
                'permission_id' => 2,
            ]
        ];
        $this->db->table('auth_groups_permissions')->insertBatch($auth_groups_permissions);

        $users = [
            [
                'email' => 'owner@gmail.com',
                'username' => 'owner',
                'user_image' => 'default.png',
                'password_hash' => '$2y$10$o1DT/NUHm4BTujdvLA7rFewbB/IgBRsPQifXQIWTke3nJxY7.NusC', //Qwertyuiop@1234
                'active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'email' => 'admin@gmail.com',
                'username' => 'admin',
                'user_image' => 'default.png',
                'password_hash' => '$2y$10$o1DT/NUHm4BTujdvLA7rFewbB/IgBRsPQifXQIWTke3nJxY7.NusC', //Qwertyuiop@1234
                'active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'email' => 'pegawai@gmail.com',
                'username' => 'pegawai',
                'user_image' => 'default.png',
                'password_hash' => '$2y$10$o1DT/NUHm4BTujdvLA7rFewbB/IgBRsPQifXQIWTke3nJxY7.NusC', //Qwertyuiop@1234
                'active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];
        $this->db->table('users')->insertBatch($users);

        $auth_groups_users = [
            [
                'group_id' => 1,
                'user_id' => 1,
            ],
            [
                'group_id' => 2,
                'user_id' => 2,
            ],
            [
                'group_id' => 3,
                'user_id' => 3,
            ]
        ];
        $this->db->table('auth_groups_users')->insertBatch($auth_groups_users);
    }
}
