<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('institution_name', 60);
						$table->date('start_date');
						$table->date('final_date');
						$table->integer('hist_id');
						$table->timestamp('hist_date_hour');
						$table->text('description');
						$table->float('grad_grade', 8, 2);
            $table->timestamps();

						$table->unsignedInteger('training_degree_id');
						$table->foreign('training_degree_id')->references('id')->on('training_degrees')->onDelete('cascade');

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
        Schema::dropIfExists('formations');
    }
}
