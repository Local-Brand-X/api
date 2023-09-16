<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\V1\Employees\Enums\GenderEnum;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->unsignedInteger('employee_id')->unique()->index();
            $table->string('user_name')->index();
            $table->string('name_prefix');
            $table->string('first_name');
            $table->string('middle_initial');
            $table->string('last_name');
            $table->enum('gender', GenderEnum::list());
            $table->string('email')->index();
            $table->date('date_of_birth');
            $table->string('time_of_birth');
            $table->unsignedDouble('age_in_yrs');
            $table->date('date_of_joining');
            $table->unsignedDouble('age_in_company');
            $table->string('phone_number');
            $table->string('place_name');
            $table->string('country');
            $table->string('city');
            $table->unsignedInteger('zip');
            $table->string('region');
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
