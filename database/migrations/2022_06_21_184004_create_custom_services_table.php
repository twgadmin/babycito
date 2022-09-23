<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_services', function (Blueprint $table) {
            $table->id();
            $table->Integer('category_id');        
            $table->string('name')->nullable();
            $table->string('amount')->nullable();
            $table->Integer('vendor_id');        
            $table->string('services_title')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_services');
    }
}
