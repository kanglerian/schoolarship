<?php

use Illuminate\Database\Seeder;
use App\Participant;

class ParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Participant::insert([
            [
                'code' => '2mUWvPEljF',
                'name' => 'Lerian Febriana',
                'school' => 'SMK Manangga Pratama',
                'major' => 'TKR',
                'presenter' => 'Rudi Hartono',
                'whatsapp' => '081286501015'
            ],
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
