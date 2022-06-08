<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class callcenter_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ini_set('max_execution_time', 0);
        $dataDirectory = resource_path("data");
        $row = 0;
        $max = 10;
        if (($handle = fopen($dataDirectory.'/cc-june.csv', "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $row++;
                if($row == 1)
                    continue;

                $name = $data[0];
                $email = $data[9];
                $emailUnique = explode('@', $data[9]);
                $unique = ($email) ? $emailUnique[0] : uniqid();

                $user = new User();
                $user->name = $name;
                $user->username = $unique;
                $user->email = $email;
                $user->password = bcrypt('staff123');
                $user->is_active = 1;
                $user->save();

                // if($row > $max)
                //     break;
            }
            fclose($handle);
        }
    }
}
