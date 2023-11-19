<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    

    public function up()
    {

        Schema::create('payments', function (Blueprint $table) {

            $table->id();
            $table->integer('transaction_id');
            $table->double('amount', 8, 2);
            $table->timestamp('paid_on');
            $table->string('details');
            $table->timestamps();
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
