<?php

use Illuminate\Database\Seeder;
use App\Schoolarship;

class SchoolarshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schoolarship::insert([
            [
                'code' => 'cqn6gR5KRd',
                'name' => 'Muhammad Kamaludin A. Rigai',
                'school' => 'SMA Negeri Wolwal',
                'major' => 'IPA',
                'presenter' => 'Ahyar',
                'whatsapp' => '089888222333'
            ],[
                'code' => 'EpmdA8qW40',
                'name' => 'Sopyan Sauri',
                'school' => 'SMK Bina Putra Mandiri',
                'major' => 'TKJ',
                'presenter' => 'Lilip',
                'whatsapp' => '087222333444'
            ],
        ]);
    }
}
