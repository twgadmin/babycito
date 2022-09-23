<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOneTimeGiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('one_time_gifts', function (Blueprint $table) {
            $table->id();
            $table->string('sendername')->nullable();
            $table->string('senderemail')->nullable();
			$table->float('amount', 8, 2)->nullable();
            $table->text('message')->nullable();
			$table->integer('vendor_id')->nullable();
            $table->date('gift_deliver_at')->nullable();
            $table->string('receivername')->nullable();
            $table->string('receiveremail')->nullable();
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
        Schema::dropIfExists('one_time_gifts');
    }
}
