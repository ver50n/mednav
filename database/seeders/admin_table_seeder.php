<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class admin_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $admins = [
            [
                'admin_type' => 'super_admin',
                'name' => 'Hendra',
                'username' => 'hendra',
                'email' => 'hendraimz@gmail.com',
                'password' => bcrypt('admin123'),
                'is_active' => 1,
                'created_at' => '2018-09-11 15:08:02',
                'updated_at' => '2018-09-11 15:08:03',
            ],[
                'admin_type' => 'admin',
                'name' => '赤沼 久紀',
                'email' => 'akanuma@medi-navi.co.jp',
                'username' => 'akanuma',
                'password' => bcrypt('admin123'),
                'is_active' => 1,
                'created_at' => '2018-09-11 15:08:02',
                'updated_at' => '2018-09-11 15:08:03',
            ],[
                'admin_type' => 'admin',
                'name' => '尾形 愛実',
                'email' => 'ogata@medi-navi.co.jp',
                'username' => 'manami',
                'password' => bcrypt('admin123'),
                'is_active' => 1,
                'created_at' => '2018-09-11 15:08:02',
                'updated_at' => '2018-09-11 15:08:03',
            ],[
                'admin_type' => 'admin',
                'name' => '矢野 香織',
                'email' => 'yano@medi-navi.co.jp',
                'username' => 'yano',
                'password' => bcrypt('admin123'),
                'is_active' => 1,
                'created_at' => '2018-09-11 15:08:02',
                'updated_at' => '2018-09-11 15:08:03',
            ],[
                'admin_type' => 'admin',
                'name' => '井上 実果穂',
                'email' => 'inoue@medi-navi.co.jp',
                'username' => 'inoue',
                'password' => bcrypt('admin123'),
                'is_active' => 1,
                'created_at' => '2018-09-11 15:08:02',
                'updated_at' => '2018-09-11 15:08:03',
            ]
        ];
        foreach($admins as $admin) {
            $objAdmin = Admin::where('username', $admin['username'])->first();
            if($objAdmin)
                continue;
            $objAdmin = new Admin();
            $objAdmin->fill($admin);
            $objAdmin->save();
        }
    }
}
