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
        Schema::table('teachers', function (Blueprint $table) {
            $table->string('email', 255)->unique()->change();
            $table->dropColumn(['TeacherName']);
            $table->after('TeacherId', function ($table) {
                $table->string('FirstName', 45);
                $table->string('LastName', 45);
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->string('TeacherName', 45)->after('TeacherId');
            $table->string('email', 45)->change();
        });
    }
};
