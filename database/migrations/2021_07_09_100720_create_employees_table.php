<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('personal_email')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('designation')->nullable();
            $table->string('employee_id')->unique();
            $table->string('department')->nullable();
            $table->date('joining_date')->nullable();
            $table->enum('status', ['0', '1'])->comment('0 fo Inactive and 1 for Active')->nullable();
            $table->longText('profile_pic')->nullable();
            $table->string('grad_college_name')->nullable();
            $table->string('grad_degree')->nullable();
            $table->year('grad_passing_year')->nullable();
            $table->string('grad_state')->nullable();
            $table->string('grad_city')->nullable();
            $table->string('mas_college_name')->nullable();
            $table->string('mas_degree')->nullable();
            $table->year('mas_passing_year')->nullable();
            $table->string('mas_state')->nullable();
            $table->string('mas_city')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
