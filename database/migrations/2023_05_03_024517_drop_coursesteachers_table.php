<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::dropIfExists('courseteachers');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement(<<<SQL

            CREATE TABLE `courseteachers` (
            `CourseId` int DEFAULT NULL,
            `CycleId` int DEFAULT NULL,
            `TeacherId` int DEFAULT NULL,
            KEY `TeacherId_idx` (`TeacherId`),
            KEY `CourseId_idx` (`CourseId`),
            KEY `CycleId_idx` (`CycleId`),
            CONSTRAINT `CourseTeachersCourseId` FOREIGN KEY (`CourseId`) REFERENCES `courses` (`CourseId`) ON DELETE RESTRICT ON UPDATE CASCADE,
            CONSTRAINT `CourseTeachersCycleId` FOREIGN KEY (`CycleId`) REFERENCES `cycles` (`CycleId`) ON DELETE RESTRICT ON UPDATE CASCADE,
            CONSTRAINT `CourseTeachersTeacherId` FOREIGN KEY (`TeacherId`) REFERENCES `teachers` (`TeacherId`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3

        SQL);
    }
};
