<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('transactions', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
      $table->foreignId('service_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
      $table->string('code');
      $table->string('brand');
      $table->string('option');
      $table->text('detail')->nullable();
      $table->integer('amount');
      $table->date('order_date');
      $table->integer('price');
      $table->integer('total_price');
      $table->enum('payment_status', ['UNPAID', 'PENDING', 'PAID'])->default('UNPAID');
      $table->enum('transaction_status', ['PENDING', 'PROCESS', 'SUCCESS', 'CANCELED'])->default('PENDING');
      $table->string('name');
      $table->string('province');
      $table->string('regency');
      $table->text('address');
      $table->string('phone_number', 15);
      $table->string('payment_confirmation')->nullable();
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
    Schema::dropIfExists('transactions');
  }
}
