<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        if(!(\DB::table('services')->exists())){

       $services = array([
            'title'      => 'our services',
            'body'       => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer hendrerit iaculis tempus. Suspendisse cursus tellus at ultricies ornare. Sed tincidunt enim justo. Morbi bibendum turpis metus',
            'created_at'      => date('Y-m-d H:i:s'),
            'updated_at'      => date('Y-m-d H:i:s')
        ],
        [
            'title'      => 'family support services',
            'body'       => 'babycito is an inclusive online community for parents and caregivers in Northern Virginia. We educate parents about essential family support services* and provide them with trusted referrals to local providers. Not sure what you need or where to start? Join our community!',
            'created_at'      => date('Y-m-d H:i:s'),
            'updated_at'      => date('Y-m-d H:i:s')
        ],
        [
            'title'      => 'how it works?',
            'body'       => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In teger hendrerit iaculis tempus. Suspendisse cursus tellus at ultricies ornare. Sed tincidunt enim justo.',
            'created_at'      => date('Y-m-d H:i:s'),
            'updated_at'      => date('Y-m-d H:i:s')
        ],
        [
            'title'      => 'recent blogs',
            'body'       => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'created_at'      => date('Y-m-d H:i:s'),
            'updated_at'      => date('Y-m-d H:i:s')
        ],
        [
            'title'      => 'what our clients say!',
            'body'       => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer hendrerit iaculis tempus.',
            'created_at'      => date('Y-m-d H:i:s'),
            'updated_at'      => date('Y-m-d H:i:s')
        ]     
    );

        \DB::table('services')->insert($services);
        
    }
    }
}
