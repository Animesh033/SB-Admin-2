<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipt_urls', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('receipt_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            // $table->string('receipt_no');
            $table->string('receipt_no');
            // $table->foreign('receipt_no')->references('receipt_no')->on('receipts')
            // ->onUpdate('cascade')->onDelete('cascade');
            $table->string('receipt_url');
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
        Schema::dropIfExists('receipt_urls');
    }
}
