<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicinesTable extends Migration
{
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');  // العلاقة مع المستخدم
            $table->string('name');                 // اسم الدواء
            $table->string('amount');               // الكمية مثل (1 حبة أو 1 كبسولة)
            $table->string('duration');             // المدة (مثلاً: 2 أسابيع)
            $table->string('form');                 // شكل الدواء (حقنة، كبسولة، حبة)
            $table->time('reminder_time');          // وقت التذكير
            $table->text('description')->nullable(); // الوصف الإضافي
            $table->timestamps();

            // إنشاء العلاقة مع جدول المستخدمين
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('medicines');
    }
}
