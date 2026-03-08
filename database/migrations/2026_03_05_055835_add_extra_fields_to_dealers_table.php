<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
    Schema::table('dealers', function (Blueprint $table) {
        $table->string('district')->nullable();
        $table->string('state')->nullable();
        $table->string('pincode')->nullable();
        $table->string('gst_no')->nullable();
        $table->string('pan_no')->nullable();
        $table->date('valid_from')->nullable();
        $table->date('valid_till')->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dealers', function (Blueprint $table) {
            //
        });
    }
};
