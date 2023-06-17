<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PaymentTokenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'payment_tokens',
            function (Blueprint $table) {
                $table->id();
                $table->string('total_amount');
                $table->string('order_number');
                $table->string('token');
                $table->string('link');
                $table->string('order_status_id');
                $table->string('payment_status');
                $table->timestamp('read_at');
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_tokens');
    }
}
