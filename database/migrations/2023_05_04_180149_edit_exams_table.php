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
        Schema::table('exams', function (Blueprint $table) {
            $table->dropForeign('ExamsCourseId');
            $table->dropForeign('ExamsCycleId');

            $table->dropColumn(['CourseId', 'CycleId']);
        });

        Schema::table('exams', function (Blueprint $table) {
            $table->after('TestNo', function (Blueprint $table) {
                $table->unsignedBigInteger('CycleId');
                $table->string('TestTitle', 255)->nullable();
                $table->unsignedInteger('MinGrade');
            });
            $table->unsignedMediumInteger('TestDuration')->after('TestTime');

            $table->foreign('CycleId')->references('CycleId')->on('coursespercycle')->onDelete('cascade');
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
