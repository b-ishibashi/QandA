<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConstrainQuestionTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('question_tag', function (Blueprint $table) {
            $table->foreign('question_id')
                ->references('id')
                ->on('questions');
            $table->foreign('tag_id')
                ->references('id')
                ->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('question_tag', function (Blueprint $table) {
            $table->dropForeign('tag_id');
            $table->dropForeign('question_id');
        });
    }
}
