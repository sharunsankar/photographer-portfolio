<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating Super Admin User
        $superAdmin = User::create([
            'name' => 'Super Admin', 
            'email' => 'admin@portfolio.com',
            'password' => Hash::make('password1234')
        ]);
        $superAdmin->assignRole('Super Admin');

        // Creating Editor
        $editor = User::create([
            'name' => 'Editor', 
            'email' => 'editor@portfolio.com',
            'password' => Hash::make('password1234')
        ]);
        $editor->assignRole('Editor');

        // Creating Content Manager
        $contentManager = User::create([
            'name' => 'Content Manager', 
            'email' => 'content-manager@portfolio.com',
            'password' => Hash::make('password1234')
        ]);
        $contentManager->assignRole('Content Manager');
    }
}
