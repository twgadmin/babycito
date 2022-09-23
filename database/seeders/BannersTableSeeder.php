<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Reset the admins table
         */

        if(!(\DB::table('banners')->exists())){
            $banners = array([
                'user_id' => 1,
                'title'      => 'title',
                'description'       => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sit amet purus eu.',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s')
            ],
              
        );
    
            \DB::table('banners')->insert($banners);
        }
    }
}
