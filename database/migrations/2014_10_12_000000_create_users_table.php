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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('name')->nullable();
            $table->string('lrn')->nullable();
            $table->string('profile')->nullable();
            $table->string('grade')->nullable();
            $table->string('section')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('password');
            $table->string('guardian_contact_number')->nullable();
            $table->boolean('isApproved')->default(true);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
