<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();
            $table->string('path')->nullable();
            $table->mediumText('approach')->nullable();
            $table->mediumText('approach_principles')->nullable();
            $table->mediumText('scope_audience')->nullable();
            $table->mediumText('scope_audience_tbl')->nullable();
            $table->mediumText('ethical_considerations')->nullable();
            $table->mediumText('limitation')->nullable();
            $table->mediumText('key_evolution_questions')->nullable();
            $table->mediumText('key_evolution_tbl')->nullable();
            $table->mediumText('operational_steps')->nullable();
            $table->mediumText('monitoring_improvement')->nullable();
            $table->mediumText('evaluation_plan')->nullable();
            $table->mediumText('reporting')->nullable();
            $table->mediumText('appendix_one')->nullable();
            $table->mediumText('appendix_two')->nullable();
            $table->mediumText('appendix_three')->nullable();
            $table->mediumText('appendix_four')->nullable();
            $table->mediumText('appendix_five')->nullable();
            $table->mediumText('appendix_six')->nullable();
            $table->mediumText('appendix_seven')->nullable();
            $table->mediumText('appendix_eight')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
