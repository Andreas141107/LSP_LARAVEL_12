<?php

namespace Database\Seeders;

use App\Models\Meja;
use App\Models\Menu;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $users = [
            ['name' => 'admin', 'email' => 'admin@example.com', 'role' => 'admin'],
            ['name' => 'waiter', 'email' => 'waiter@example.com', 'role' => 'waiter'],
            ['name' => 'kasir', 'email' => 'kasir@example.com', 'role' => 'kasir'],
            ['name' => 'owner', 'email' => 'owner@example.com', 'role' => 'owner'],
        ];

        foreach ($users as $user) {
            User::factory()->create(array_merge($user, [
                'password' => bcrypt('12341234'),
                'created_at' => now(),
            ]));
        }
        Menu::factory()->create([
            'nama'=>'coffee latte',
            'harga'=>10000,
            
        ]);
        Menu::factory()->create([
            'nama'=>'burger',
            'harga'=>15000,
            
        ]);
        Meja::factory()->create([
            'kapasitas'=>20,
            'status'=>'kosong',
        ]);
    }
}
