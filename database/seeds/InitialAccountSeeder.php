<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class InitialAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = Hash::make('admin123');

        DB::table('temp_accounts')->insert([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'username' => 'admin',
            'email' => 'jbfuentebella25@gmail.com',
            'password' => $password,
            'role' => 'admin',
            'verification_status' => 'verified',
            'verification_date' => '2019-02-18',
            'verification_token' => '1234567891234567',
            'created_at' => '1970-01-01 00:00:01',
            'updated_at' => '1970-01-01 00:00:01'
        ]);

        DB::table('accounts')->insert([
            'temp_account_id' => 1,
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'username' => 'admin',
            'email' => 'jbfuentebella25@gmail.com',
            'password' => $password,
            'role' => 'admin',
            'verification_date' => '2019-02-18',
            'slug' => '1234567891234567',
            'updated_by' => 0,
            'created_at' => '1970-01-01 00:00:01',
            'updated_at' => '1970-01-01 00:00:01'
        ]);
    }
}
