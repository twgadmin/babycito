<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCustomServicesTableAddShowAmountColumnAfterName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('custom_services', function (Blueprint $table) {
            $table->unsignedTinyInteger('show_amount')->nullable()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('custom_services', function(Blueprint $table) {
        	$table->dropColumn('show_amount');
        });
    }
}
