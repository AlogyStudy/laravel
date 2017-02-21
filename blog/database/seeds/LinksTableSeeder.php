<?php

use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [[
            'link_name' => 'Lin',
            'link_title' => 'link',
            'link_url' => 'http://www.linxingzhang.com',
            'link_order' => 1
        ],[
            'link_name' => 'Xing',
            'link_title' => 'xings',
            'link_url' => 'http://www.linxingzhang.com',
            'link_order' => 2
        ],[
            'link_name' => 'Zhang',
            'link_title' => 'zhangs',
            'link_url' => 'http://www.linxingzhang.com',
            'link_order' => 3
        ]];

        DB::table('links')->insert($data);
    }
}
