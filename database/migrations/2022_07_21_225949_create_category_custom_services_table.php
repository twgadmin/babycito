<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryCustomServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       

        Schema::create('category_custom_services', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('custom_service_id');
            $table->softDeletes();
            $table->timestamps();
        });

        $custom_services = \DB::table('custom_services')->whereNull('deleted_at')->get();
            foreach($custom_services as $key=>$value){
                \DB::table('category_custom_services')->insert([
                    'category_id' => $value->category_id,
                    'custom_service_id' => $value->id,
                    'created_at' => $value->created_at
                ]);
            }

            Schema::table('custom_services', function (Blueprint $table) {
                $table->dropColumn('category_id');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
