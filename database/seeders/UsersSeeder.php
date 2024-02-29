<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function run(): void
    {
        $users = [
            [
                'name' => 'Mark',
                'email' => 'mark@email.com',
                'password' => Hash::make('mark123'),
                'role_id' => 1,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'name' => 'Bill',
                'email' => 'bill@email.com',
                'password' => Hash::make('bill123'),
                'role_id' => 2,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'name' => 'Jeff',
                'email' => 'jeff@email.com',
                'password' => Hash::make('jeff123'),
                'role_id' => 2,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ]
        ];

        $this->user->insert($users);
    }
}
