<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterRegistriesTableAddQtyColumnAfterServicesId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registries', function (Blueprint $table) {
            $table->Integer('qty')->nullable()->after('services_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('registries', function(Blueprint $table) {
        	$table->dropColumn('qty');
        });
    }

}
