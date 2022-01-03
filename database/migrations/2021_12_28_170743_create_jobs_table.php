<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('company_id');
            $table->string('title');
            $table->string('company');
            $table->string('location');
            $table->string('contact');
            $table->string('logo')->nullable();
            $table->text('content');
            $table->string('salary');
            $table->boolean('is_active')->default(false);
        });
        DB::statement("ALTER TABLE jobs MODIFY COLUMN logo MEDIUMBLOB");
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
