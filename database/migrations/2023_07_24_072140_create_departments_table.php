<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('department')->unique()->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();


            // $departments = \App\Models\Department::all();
            // $counter = 101;

            // foreach ($departments as $department) {
            //     $department->department_id = 'd-' . $counter++;
            //     $department->save();
            // }
            });
    }

    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
