<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data= [

            [
                'name'      => 'No author',
                'email'     => 'no@loc.le',
                'password'  => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password

            ],
            [
                'name'      => 'Maksim',
                'email'     => 'local@loc.ee',
                'password'  => Hash::make('12345678'),
            ]
        ];

        DB::table('users')->insert($data);
    }
}
