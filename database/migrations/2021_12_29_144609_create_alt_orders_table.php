<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAltOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alt_orders', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->text('address')->nullable();
            $table->text('phone')->nullable();
            $table->text('event')->nullable();
            $table->integer('peoples')->nullable();
            $table->date('date')->nullable();
            $table->string('email')->nullable();
            $table->text('menu')->nullable();
            $table->text('comm')->nullable();
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
        Schema::dropIfExists('alt_orders');
    }
}
