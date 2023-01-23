<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHideTechnicalDetailsOnProductPageToSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumns('systems', ['hide_technical_details_on_product_page', 'hide_out_of_stock_items'])) {
            Schema::table('systems', function (Blueprint $table) {
                $table->after('show_seo_info_to_frontend', function ($table) {
                    $table->boolean('hide_out_of_stock_items')->nullable()->default(false);
                    $table->boolean('hide_technical_details_on_product_page')->nullable()->default(false);
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
        if (Schema::hasColumns('systems', ['hide_technical_details_on_product_page', 'hide_out_of_stock_items'])) {
            Schema::table('systems', function (Blueprint $table) {
                $table->dropColumn(['hide_technical_details_on_product_page', 'hide_out_of_stock_items']);
            });
        }
    }
}
