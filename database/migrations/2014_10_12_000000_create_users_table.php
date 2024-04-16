<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
      $table->string('name');
      $table->string('email')->unique();
      $table->timestamp('email_verified_at')->nullable();
      $table->string('password');
      $table->foreignId('province_id')->nullable()->constrained()->cascadeOnUpdate()->restrictOnDelete();
      $table->foreignId('regency_id')->nullable()->constrained()->cascadeOnUpdate()->restrictOnDelete();
      $table->text('address')->nullable();
      $table->string('phone_number', 15)->nullable();
      $table->enum('roles', ['USER', 'ADMIN'])->default('USER');
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
}
