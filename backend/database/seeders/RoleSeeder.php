<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'name' => 'Production Manager',
                'deskripsi' => 'Dapat membuat dan mengelola work order',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Operator',
                'deskripsi' => 'Dapat mengupdate status work order yang ditugaskan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
