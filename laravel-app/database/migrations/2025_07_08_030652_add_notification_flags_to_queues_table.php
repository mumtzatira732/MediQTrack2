<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('queues', function (Blueprint $table) {
            $table->boolean('notified_consultation')->default(false);
            $table->boolean('notified_pharmacy')->default(false);
        });
    }

    public function down()
    {
        Schema::table('queues', function (Blueprint $table) {
            $table->dropColumn('notified_consultation');
            $table->dropColumn('notified_pharmacy');
        });
    }

};
