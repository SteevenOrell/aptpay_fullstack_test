<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisbursementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disbursements', function (Blueprint $table) {
            $table->increments('id');
            $table->double('amount');
            $table->string('currency',3);
            $table->string('transactionType');
            $table->string('paymentType',3);
            $table->string('disbursementNumber')->nullable();
            $table->integer('instrumentId')->nullable();
            $table->string('expirationDate')->nullable();
            $table->string('network')->nullable();
            $table->integer('payeeId');
            $table->integer('mode')->default(0)->nullable();
            $table->string('descriptor')->nullable();
            $table->string('status');
            $table->string('date')->default(date('Y-m-d'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disbursements');
    }
}
