<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        $adminRecords = [
            [
                'id'=>'d30ec9f9-7fc8-4271-bc97-0ba230ecca1b',
                'name'=>'admin',
                'type'=>'admin',
                'mobile'=>'05025002030',
                'email'=>'admin@admin.com',
                'password'=>'$2y$10$ELITJV1iH5hJxhwsoz9am.iYM5IzYK8.0EYrSuCJdrg0gJUozmyhe',//123456
                'image'=>'',
                'status'=>1
            ],
        ];
        foreach ($adminRecords as $key=>$record) {
            DB::table('admins')->insert($record);
        }
    }
}
