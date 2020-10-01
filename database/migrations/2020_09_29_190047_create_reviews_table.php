<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
						$table->smallInteger('rank');
            $table->timestamps();

						$table->unsignedInteger('reviewer_id');
						$table->foreign('reviewer_id')->references('id')->on('users')->onDelete('cascade');

						$table->unsignedInteger('user_id');
						$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

						$table->unsignedInteger('industry_id');
						$table->foreign('industry_id')->references('id')->on('industries')->onDelete('cascade');

						$table->unsignedInteger('occupation_id');
						$table->foreign('occupation_id')->references('id')->on('occupation_areas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
