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
        Schema::table('enrollments', function (Blueprint $table) {
            $table->dropForeign('EnrollmentsCourseId');
            $table->dropForeign('EnrollmentsStudentId');
            $table->dropForeign('EnrollmentsCycleId');

            $table->dropColumn(['CourseId', 'StudentId', 'CycleId']);
        });
        Schema::table('enrollments', function (Blueprint $table) {
           $table->id('EnrollmentID');

            $table->bigInteger('CycleId', unsigned: true);
            $table->integer('StudentId');
            $table->foreign('StudentId')->references('StudentId')->on('students')->onDelete('cascade');
            $table->foreign('CycleId')->references('CycleId')->on('coursespercycle')->onDelete('cascade');


            $table->unique(['StudentId', 'CycleId']);
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
