<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $seedList = [
            'admin',
            'user',
            //'place'
        ];
        if(in_array('admin', $seedList))
            $this->call(admin_table_seeder::class);
        if(in_array('user', $seedList))
            $this->call(user_table_seeder::class);
        if(in_array('place', $seedList))
            $this->call(place_table_seeder::class);
    }
}
