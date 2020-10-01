<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessionalExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professional_experiences', function (Blueprint $table) {
            $table->increments('id');
						$table->string('company_name', 60);
						$table->date('start_date');
						$table->date('final_date');
						$table->integer('hist_id');
						$table->timestamp('hist_date_hour');
						$table->text('description');
            $table->timestamps();

						$table->unsignedInteger('industry_id');
						$table->foreign('industry_id')->references('id')->on('industries')->onDelete('cascade');

						$table->unsignedInteger('occupation_area_id');
						$table->foreign('occupation_area_id')->references('id')->on('occupation_areas')->onDelete('cascade');

						$table->unsignedInteger('user_id');
						$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('professional_experiences');
    }
}
