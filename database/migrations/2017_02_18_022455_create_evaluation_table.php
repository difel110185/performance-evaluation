<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('evaluation_cycle_id');
            $table->unsignedInteger('evaluator_id');
            $table->unsignedInteger('evaluated_id');
            $table->json('result');
            $table->integer('fill_status');
            $table->text('reason_denial');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('updated_by');

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('evaluation_cycle_id')->references('id')->on('evaluation_cycle');
            $table->foreign('evaluator_id')->references('id')->on('employee');
            $table->foreign('evaluated_id')->references('id')->on('employee');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluation');
    }
}
