<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('clinics', function (Blueprint $table) {
            $table->string('address')->nullable()->after('license_no');
        });
    }

    public function down()
    {
        Schema::table('clinics', function (Blueprint $table) {
            $table->dropColumn('address');
        });
    }
};
