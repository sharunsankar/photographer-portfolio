<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Super Admin']);
        $editor = Role::create(['name' => 'Editor']);
        $contentManager = Role::create(['name' => 'Content Manager']);

        $editor->givePermissionTo([
            'list-category',
            'create-category',
            'edit-category',
            'delete-category',

            'list-album',
            'create-album',
            'edit-album',
            'delete-album',
        ]);

        $contentManager->givePermissionTo([
            'list-page',
            'create-page',
            'edit-page',
            'delete-page',
        ]);
    }
}
