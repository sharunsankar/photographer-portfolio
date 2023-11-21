<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'create-role',
            'edit-role',
            'delete-role',
            
            'create-user',
            'edit-user',
            'delete-user',

            'list-category',
            'create-category',
            'edit-category',
            'delete-category',

            'list-album',
            'create-album',
            'edit-album',
            'delete-album',

            'list-page',
            'create-page',
            'edit-page',
            'delete-page',
         ];

         foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
          }
    }
}
