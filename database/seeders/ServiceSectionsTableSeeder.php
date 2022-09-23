<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceSectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        if(!(\DB::table('service_sections')->exists())){
            $service_sections = array([
                'service_id' => 1,
                'title'      => 'providers',
                'body'       => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sit amet purus eu.',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s')
            ],
            [
                'service_id' => 1,
                'title'      => 'registry',
                'body'       => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sit amet purus eu.',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s')
            ],
            [
                'service_id' => 2,
                'title'      => 'anticipation',
                'body'       => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sit amet purus eu lorem tristique luctus sed sed quam.',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s')
            ],
            [
                'service_id' => 2,
                'title'      => 'birth',
                'body'       => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sit amet purus eu lorem tristique luctus sed sed quam.',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s')
            ],
            [
                'service_id' => 2,
                'title'      => 'continued care',
                'body'       => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sit amet purus eu lorem tristique luctus sed sed quam.',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s')
            ],
            [
                'service_id' => 3,
                'title'      => '1',
                'body'       => 'lorem ipsum dolor sit amet',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s')
            ],
            [
                'service_id' => 3,
                'title'      => '2',
                'body'       => 'lorem ipsum dolor sit amet',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s')
            ],
            [
                'service_id' => 3,
                'title'      => '3',
                'body'       => 'lorem ipsum dolor sit amet',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s')
            ]     
        );
    
            \DB::table('service_sections')->insert($service_sections);
        }
        
    }
}
