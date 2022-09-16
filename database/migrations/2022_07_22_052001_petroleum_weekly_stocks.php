<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PetroleumWeeklyStocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petroleum_weekly_stocks', function (Blueprint $table) {
            $table->id();
            $table->date('period');
            $table->integer('value');

            $table->foreignId('area_id')->constrained('area');
            $table->foreignId('product_id')->constrained('product');
            $table->foreignId('process_id')->constrained('process');
            $table->foreignId('units_id')->constrained('units');
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
    }
}
