<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class AdminTableUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_user')->insert([
            'foto' => 'logo.png',
            'name' => 'Admin',
            'tempat' => 'Admin',
            'tgl_lahir' => '2022-12-06',
            'jk' => 'Laki-Laki',
            'nohp' => '08523694123',
            'email' => 'admin@email.com',
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'level' => 'admin',
        ]);
    }
}
