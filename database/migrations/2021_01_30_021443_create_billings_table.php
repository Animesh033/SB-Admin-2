<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billings', function (Blueprint $table) {
            $table->id();
            $table->string('width')->nullable();
            $table->string('height')->nullable();
            $table->string('shutter')->nullable();
            $table->string('net')->nullable();
            $table->string('sq_feet')->nullable();
            $table->string('rate')->nullable();
            $table->string('amount')->nullable();
            // $table->foreignId('category_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            // $table->foreignId('customer_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            // $table->string('billing_no')->index()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billings');
    }
}