<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobOffersTable extends Migration
{
    /*
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_offers', function (Blueprint $table) {
            $table->id();
            $table->integer('idJob');
            $table->integer('idUser');
            $table->string('content');
            $table->string('cv');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE job_offers MODIFY COLUMN cv MEDIUMBLOB");
    }

    /*
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_offers');
    }
}
