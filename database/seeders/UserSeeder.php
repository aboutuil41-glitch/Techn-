<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ── Admin ─────────────────────────
        $admin = User::firstOrCreate(
            ['email' => 'admin@techne.test'],
            [
                'username' => 'admin',
                'password' => Hash::make('password'),
                'xp'       => 1000,
                'level'    => 10,
                'title'    => 'Master',
            ]
        );
        $admin->assignRole('admin');

        // ── Main user (you) ───────────────
        $user = User::firstOrCreate(
            ['email' => 'w.boutuil@gmail.com'],
            [
                'username' => 'Walid Boutuil',
                'password' => Hash::make('12345678'),
                'xp'       => 300,
                'level'    => 3,
                'title'    => 'Artist',
            ]
        );
        $user->assignRole('member');

        // ── Demo users ────────────────────
        $users = [
            ['name' => 'SketchKid', 'email' => 'sketch@test.com'],
            ['name' => 'PixelMaster', 'email' => 'pixel@test.com'],
            ['name' => 'InkWizard', 'email' => 'ink@test.com'],
            ['name' => 'ColorMage', 'email' => 'color@test.com'],
            ['name' => 'ShadowArtist', 'email' => 'shadow@test.com'],
        ];

        foreach ($users as $u) {
            $newUser = User::firstOrCreate(
                ['email' => $u['email']],
                [
                    'username' => $u['name'],
                    'password' => Hash::make('password'),
                    'xp'       => rand(0, 500),
                    'level'    => rand(1, 5),
                    'title'    => 'Beginner',
                ]
            );

            $newUser->assignRole('member');
        }
    }
}