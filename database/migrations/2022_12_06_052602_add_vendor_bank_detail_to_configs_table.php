<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVendorBankDetailToConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumns('configs', ['ac_holder_name', 'ac_number'])) {
            Schema::table('configs', function (Blueprint $table) {
                $table->after('default_payment_method_id', function ($table) {
                    $table->string('ac_holder_name')->nullable();
                    $table->string('ac_number')->nullable();
                    $table->string('ac_type')->nullable();
                    $table->string('ac_routing_number')->nullable();
                    $table->string('ac_swift_bic_code')->nullable();
                    $table->string('ac_iban')->nullable();
                    $table->text('ac_bank_address')->nullable();
                });
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumns('configs', ['ac_holder_name', 'ac_number'])) {
            Schema::table('configs', function (Blueprint $table) {
                $table->dropColumn([
                    'ac_holder_name',
                    'ac_number',
                    'ac_type',
                    'ac_routing_number',
                    'ac_swift_bic_code',
                    'ac_iban',
                    'ac_bank_address'
                ]);
            });
        }
    }
}
