<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->string('phone');
            $table->foreignId('service_id')->nullable();
            $table->string('other_service')->nullable();
            $table->dateTime('date');
            $table->enum('payment_method', ['cash', 'bank card']);
            $table->enum('status', ['new', 'in work', 'completed', 'cancelled'])->default('new');
            $table->string('cancel_reason')->nullable();
            $table->foreignId('user_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
