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
        Schema::table('coursespercycle', function(Blueprint $table){
            $table->dropForeign('CoursesPerCycleCycleId');
            $table->dropColumn(['CycleId']);
        });
        Schema::table('coursespercycle', function(Blueprint $table){
            $table->id('CycleId');
            $table->integer('TeacherId')->nullable()->after('CycleId');
            $table->text('CycleDescription')->nullable();
            $table->foreign('TeacherId')->references('TeacherId')->on('teachers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
};
