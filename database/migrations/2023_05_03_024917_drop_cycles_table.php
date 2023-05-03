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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('cycles');
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::disableForeignKeyConstraints();

        DB::statement(<<<SQL

            CREATE TABLE `cycles` (
            `CycleId` int NOT NULL AUTO_INCREMENT,
            `CycleDescription` varchar(45) DEFAULT NULL,
            `CyclesStartDate` date NOT NULL,
            `CyclesEndDate` date NOT NULL,
            PRIMARY KEY (`CycleId`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3

        SQL);
        Schema::enableForeignKeyConstraints();

    }
};
