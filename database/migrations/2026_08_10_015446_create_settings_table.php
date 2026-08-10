<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            $table->string('library_name')
                ->default('Pangasinan Public Library');

            $table->text('address')
                ->nullable();

            $table->string('phone')
                ->nullable();

            $table->string('email')
                ->nullable();

            $table->unsignedInteger('max_books')
                ->default(3);

            $table->unsignedInteger('borrow_days')
                ->default(7);

            $table->decimal('fine_per_day', 10, 2)
                ->default(10);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
