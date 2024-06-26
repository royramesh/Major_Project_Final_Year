<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Bed_info', function (Blueprint $table) {
            $table->string('hos_id')->primary();
            $table->string('m1',10);
            $table->string('m2',10);
            $table->string('m3',10);
            $table->string('m4',10);
            $table->string('m5',10);
            $table->string('f1',10);
            $table->string('f2',10);
            $table->string('f3',10);
            $table->string('f4',10);
            $table->string('f5',10);
            $table->timestamps();

            // $table->string('hos_name',60);
            // $table->bigInteger('hos_contactno');
            // $table->string('hos_email',60);
            // $table->longText('hos_password');
            // $table->string('hos_address',100);
            // $table->string('hos_state',30);
            // $table->string('hos_district',30);
            // $table->string('hos_city',50);
            // $table->integer('hos_pincode');
            // $table->float('hos_lat');
            // $table->float('hos_long');
            // $table->integer('hos_male_bed_available');
            // $table->integer('hos_female_bed_available');
            // $table->integer('hos_bed_charge');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
