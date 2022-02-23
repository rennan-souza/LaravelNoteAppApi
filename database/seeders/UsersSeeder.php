<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Stephanie',
            'last_name' => 'Tanner',
            'email' => 'stephanie_admin@email.com.br',
            'password' => Hash::make('123456'),
            'is_admin' => true,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'first_name' => 'Steve',
            'last_name' => 'Green',
            'email' => 'steve_user@email.com.br',
            'password' => Hash::make('123456'),
            'is_admin' => false,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'first_name' => 'Joe',
            'last_name' => 'Purple',
            'email' => 'joe_purple@email.com.br',
            'password' => Hash::make('123456'),
            'is_admin' => false,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
