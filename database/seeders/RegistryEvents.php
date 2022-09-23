<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RegistryEvents extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //
        if(!(\DB::table('registry_event')->exists())){
            $registry_event = array([
                'name'      => 'Baby Shower',
                'icon_image'       => 'bullet-baby.png',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s')
            ],
            [
                'name'      => 'Sprinkle',
                'icon_image'       => 'bullet-hat.png',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s')
            ],
            [
                'name'      => 'Due Date',
                'icon_image'       => 'bullet-baby.png',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s')
            ],
            [
                'name'      => "Baby's Birthday",
                'icon_image'       => 'bullet-hat.png',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s')
            ],
            [
                'name'      => 'Adoption Date',
                'icon_image'       => 'bullet-hat.png',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s')
            ]
            );


            \DB::table('registry_event')->insert($registry_event);

        }
    }
}
