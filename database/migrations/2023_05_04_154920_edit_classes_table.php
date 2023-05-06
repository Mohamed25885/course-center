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
        Schema::table('classes', function(Blueprint $table){
            $table->dropForeign('ClassesCourseId');
            $table->dropForeign('ClassesCycleId');
            $table->dropForeign('ClassesTeacherId');

            $table->dropColumn(['CourseId', 'CycleId', 'TeacherId', 'ClassDate']);
        });

        Schema::table('classes', function(Blueprint $table){
            $table->bigInteger('CycleId', unsigned:true)->after('ClassNo');
            $table->smallInteger('ClassDay', unsigned:true)->after('ClassTitle');


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
