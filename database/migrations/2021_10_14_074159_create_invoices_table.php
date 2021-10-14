<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->decimal('number_of_hrs', $precision = 8, $scale = 2);
            $table->decimal('sub_total', $precision = 8, $scale = 2);
            $table->decimal('discount', $precision = 8, $scale = 2);
            $table->bigInteger('user_id')->unsigned();
            $table->integer('car_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('invoices', function($table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('car_id')->references('id')->on('tbl_cars')->onDelete('cascade');
        });
     
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
