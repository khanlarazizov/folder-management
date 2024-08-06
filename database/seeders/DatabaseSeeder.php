<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Company;
use App\Models\Contract;
use App\Models\Folder;
use App\Models\Project;
use App\Models\Protocol;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'user123',
            'email' => 'user@gmail.com',
            'password' => bcrypt(12345),
        ]);
        // \App\Models\User::factory(10)->create();
//        Protocol::factory(1000)->create();
//        Folder::factory(500)->create();
//        Contract::factory(1000)->create();
//        Company::factory(10)->create();
//        Project::factory(200)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
