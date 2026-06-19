<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name'  => 'Bali Traveler',
                'email' => 'user@trvl.com',
            ],
            [
                'name'  => 'Sarah Johnson',
                'email' => 'sarah@trvl.com',
            ],
            [
                'name'  => 'Mike Chen',
                'email' => 'mike@trvl.com',
            ],
            [
                'name'  => 'Lisa Dewi',
                'email' => 'lisa@trvl.com',
            ],
            [
                'name'  => 'James Wilson',
                'email' => 'james@trvl.com',
            ],
            [
                'name'  => 'Anna Putri',
                'email' => 'anna@trvl.com',
            ],
        ];

        foreach ($users as $data) {
            $user = User::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => Hash::make('password'),
            ]);

            $user->assignRole('user');
        }

        $this->command->info('Seeded ' . count($users) . ' users.');
    }
}