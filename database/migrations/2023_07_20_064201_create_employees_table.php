<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            // $table->string('emp_id')->unique()->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('phone');
            $table->date('date_of_birth');
            $table->text('address');
            $table->string('bank_account_number');
            $table->string('bank_name');
            $table->enum('gender',['male', 'female'])->default('male');
            $table->string('tax_payer_id');
            $table->string('status')->default('pending');
            $table->timestamps();
            // $table->unsignedBigInteger('department_id')->nullable();

            // $table->foreign('department_id')
            //       ->references('id')
            //       ->on('departments')
            //       ->onDelete('set null');


        //     $employees = \App\Models\Employee::all();
        // $counter = 101;
        // foreach ($employees as $employee) {
        //     $employee->emp_id = 'E-' . $counter++;
        //     $employee->save();
        // }
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }

}

