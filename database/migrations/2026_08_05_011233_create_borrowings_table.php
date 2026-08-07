<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('member_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('book_id')
                ->constrained()
                ->restrictOnDelete();

            $table->date('borrowed_at');
            $table->date('due_at');
            $table->date('returned_at')->nullable();

            $table->decimal('fine', 10, 2)->default(0);

            $table->enum('status', [
                'borrowed',
                'returned',
                'overdue',
            ])->default('borrowed');

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};
