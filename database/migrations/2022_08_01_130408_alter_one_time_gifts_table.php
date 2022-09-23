<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterOneTimeGiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('one_time_gifts', function (Blueprint $table) {
            DB::statement('ALTER TABLE one_time_gifts CHANGE vendor_id vendor VARCHAR(191) NULL;');
            $table->text('url')->nullable()->after('stripe_code');
            $table->boolean('paid')->nullable()->after('url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
         Schema::table('one_time_gifts', function (Blueprint $table) {
            $table->dropColumn('url');
            $table->dropColumn('paid');
        });
    }
}
