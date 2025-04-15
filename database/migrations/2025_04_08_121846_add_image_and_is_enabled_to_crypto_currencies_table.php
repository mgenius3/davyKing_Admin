<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageAndIsEnabledToCryptoCurrenciesTable extends Migration
{
    public function up()
    {
        Schema::table('crypto_currencies', function (Blueprint $table) {
            $table->string('image')->nullable()->after('sell_rate');
        });
    }

    public function down()
    {
        Schema::table('crypto_currencies', function (Blueprint $table) {
            $table->dropColumn(['image']);
        });
    }
}