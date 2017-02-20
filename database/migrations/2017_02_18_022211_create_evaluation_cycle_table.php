<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationCycleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation_cycle', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('organization_id');
            $table->unsignedInteger('rating_scale_id');
            $table->dateTime('evaluation_start_date');
            $table->dateTime('evaluation_end_date');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->boolean('colleagues_can_evaluate_each_other');
            $table->boolean('include_reverse_evaluations');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('updated_by');

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('organization_id')->references('id')->on('organization');
            $table->foreign('rating_scale_id')->references('id')->on('rating_scale');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluation_cycle');
    }
}
