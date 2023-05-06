<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('examsgrades', function (Blueprint $table) {
            $table->dropForeign('ExamsGradesCourseId');
            $table->dropForeign('ExamsGradesCycleId');
            $table->dropForeign('ExamsGradesStudentId');
            $table->dropForeign('ExamsGradesTestNo');

            $table->dropColumn(['CourseId', 'CycleId', 'StudentId', 'TestNo']);
        });
        Schema::table('examsgrades', function(Blueprint $table){
            $table->id('GradeId');
            $table->integer('TestNo')->nullable();
            $table->integer('StudentId');

            $table->foreign('TestNo')->references('TestNo')->on('exams')->onDelete('set null');
            $table->foreign('StudentId')->references('StudentId')->on('students')->onDelete('cascade');

        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
