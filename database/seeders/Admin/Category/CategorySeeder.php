<?php

namespace Database\Seeders\Admin\Category;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =  array(
            array('id' => 1, 'name' => 'store', '_lft' => 1, '_rgt' => 20,'user_id'=> 1,'status'=> 0, 'parent_id' => null),
                array('id' => 2, 'name' => 'notebooks', '_lft' => 2, '_rgt' => 7,'user_id'=> 1,'status'=> 0, 'parent_id' => 1),
                    array('id' => 3, 'name' => 'apple', '_lft' => 3, '_rgt' => 4,'user_id'=> 1,'status'=> 0, 'parent_id' => 2),
                    array('id' => 4, 'name' => 'lenovo', '_lft' => 5, '_rgt' => 6,'user_id'=> 1,'status'=> 0, 'parent_id' => 2),
                array('id' => 5, 'name' => 'mobile', '_lft' => 8, '_rgt' => 19,'user_id'=> 1,'status'=> 0, 'parent_id' => 1),
                    array('id' => 6, 'name' => 'nokia', '_lft' => 9, '_rgt' => 10,'user_id'=> 1,'status'=> 0, 'parent_id' => 5),
                    array('id' => 7, 'name' => 'samsung', '_lft' => 11, '_rgt' => 14,'user_id'=> 1,'status'=> 0, 'parent_id' => 5),
                        array('id' => 8, 'name' => 'galaxy', '_lft' => 12, '_rgt' => 13,'user_id'=> 1,'status'=> 0, 'parent_id' => 7),
                    array('id' => 9, 'name' => 'sony', '_lft' => 15, '_rgt' => 16,'user_id'=> 1,'status'=> 0, 'parent_id' => 5),
                    array('id' => 10, 'name' => 'lenovo', '_lft' => 17, '_rgt' => 18,'user_id'=> 1,'status'=> 0, 'parent_id' => 5),
            array('id' => 11, 'name' => 'store_2', '_lft' => 21, '_rgt' => 22,'user_id'=> 1,'status'=> 0,    'parent_id' => null),
        );

        DB::table('categorys')->insert($data);
    }
}
