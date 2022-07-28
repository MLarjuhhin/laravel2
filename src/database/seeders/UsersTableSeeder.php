<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $data = [['name'     => 'Автор не известен',
                  'email'    => 'non_auth@asd.ee',
                  'password' => bcrypt('123')],
            ['name'     => 'Автор ',
             'email'    => 'auth@asd.ee',
             'password' => bcrypt('123456')]];
        
        \DB::table('users')
            ->insert($data);
    }
}
