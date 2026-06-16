<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DemoUserSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $users = [
            // Project Managers / Executives (P1, P2) - Admin roles
            [
                'name' => 'David Datu Sarmiento',
                'email' => 'david@pureblooms.com',
                'password' => Hash::make('demo123'),
                'role' => 'admin',
                'phone' => '09171111111',
                'is_active' => true,
            ],
            [
                'name' => 'Ruth Joy Valencia',
                'email' => 'ruth@pureblooms.com',
                'password' => Hash::make('demo123'),
                'role' => 'admin',
                'phone' => '09172222222',
                'is_active' => true,
            ],

            // Operations Department - Sellers/Managers (P5, P6)
            [
                'name' => 'John Paul Santos',
                'email' => 'johnpaul@pureblooms.com',
                'password' => Hash::make('demo123'),
                'role' => 'seller',
                'phone' => '09173333333',
                'is_active' => true,
            ],
            [
                'name' => 'Von Eiron Reyes',
                'email' => 'von@pureblooms.com',
                'password' => Hash::make('demo123'),
                'role' => 'seller',
                'phone' => '09174444444',
                'is_active' => true,
            ],

            // Customer Relations - Customer Demo Users (P3, P4)
            [
                'name' => 'Brix Cruz',
                'email' => 'brix@customer.com',
                'password' => Hash::make('demo123'),
                'role' => 'customer',
                'phone' => '09175555555',
                'is_active' => true,
            ],
            [
                'name' => 'Ydel Letice Garcia',
                'email' => 'ydel@customer.com',
                'password' => Hash::make('demo123'),
                'role' => 'customer',
                'phone' => '09176666666',
                'is_active' => true,
            ],

            // Development Department - Developer Users (P7, P8)
            [
                'name' => 'Aaron Jake Lim',
                'email' => 'aaron@pureblooms.com',
                'password' => Hash::make('demo123'),
                'role' => 'admin',
                'phone' => '09177777777',
                'is_active' => true,
            ],
            [
                'name' => 'Novel Tan',
                'email' => 'novel@pureblooms.com',
                'password' => Hash::make('demo123'),
                'role' => 'admin',
                'phone' => '09178888888',
                'is_active' => true,
            ],

            // Additional customer demo accounts for order scenarios
            [
                'name' => 'Maria Santos',
                'email' => 'maria.santos@email.com',
                'password' => Hash::make('demo123'),
                'role' => 'customer',
                'phone' => '09179999999',
                'is_active' => true,
            ],
            [
                'name' => 'Carlos Mendoza',
                'email' => 'carlos.mendoza@email.com',
                'password' => Hash::make('demo123'),
                'role' => 'customer',
                'phone' => '09180000000',
                'is_active' => true,
            ],
            [
                'name' => 'Ana Rodriguez',
                'email' => 'ana.rodriguez@email.com',
                'password' => Hash::make('demo123'),
                'role' => 'customer',
                'phone' => '09181111111',
                'is_active' => true,
            ],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }

        $this->command->info('Demo users seeded: ' . User::count());
        $this->command->table(
            ['Role', 'Count'],
            [
                ['Admin', User::where('role', 'admin')->count()],
                ['Seller', User::where('role', 'seller')->count()],
                ['Customer', User::where('role', 'customer')->count()],
            ]
        );
    }
}