<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestFormsTable extends Migration
{
    public function up()
    {
        Schema::create('request_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key for user_id
            $table->string('user_type');
            $table->string('document_type');
            $table->string('first_name');  // Add first_name column
            $table->string('last_name');   // Add last_name column
            $table->string('middle_name')->nullable(); // Add middle_name column (nullable if not always provided)
            $table->string('student_number');
            $table->string('email');
            $table->string('contact');
            $table->enum('dry_seal', ['yes', 'no']);
            $table->string('status')->default('Pending'); // Default status
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('request_forms');
    }
}
