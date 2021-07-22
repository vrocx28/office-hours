<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimesheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timesheets', function (Blueprint $table) {
            $table->id();
            $table->date('login_date')->format('Y-m-d');
            $table->bigInteger('emp_id')->unsigned();
            $table->foreign('emp_id')->references('id')->on('employees');
            $table->time('login_time');
            $table->string('login_hour');
            $table->time('logout_time')->nullable();
            $table->string('logout_hour')->nullable();
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
        Schema::dropIfExists('timesheets');
    }
}
