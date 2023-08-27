<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->date('date_of_birth');
            $table->date('hiring_date')->nullable();
            $table->string('permanent_address');
            $table->string('mailing_address');
            $table->string('bank_account_number');
            $table->string('bank_name');
            $table->enum('gender', ['male', 'female']);
            $table->string('tax_payer_id');
            $table->string('document')->nullable();
            $table->unsignedBigInteger('department_id');
            $table->string('status')->default('pending');
            $table->string('password')->nullable();
            $table->decimal('salary', 10, 2)->nullable();
            $table->enum('tax_filing_status',['single','married']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
