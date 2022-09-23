<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterOneTimeGiftsTableAddStripeCodeColumnAfterReceiveremail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('one_time_gifts', function (Blueprint $table) {
            $table->string('stripe_code')->nullable()->after('receiveremail');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('one_time_gifts', function(Blueprint $table) {
        	$table->dropColumn('stripe_code');
        });
    }

}
