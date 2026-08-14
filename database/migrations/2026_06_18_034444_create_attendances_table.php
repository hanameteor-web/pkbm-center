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
    Schema::create('attendances', function (Blueprint $table) {
    $table->id();

    $table->foreignId('student_id')
          ->constrained()
          ->cascadeOnDelete();

    $table->foreignId('school_class_id')
          ->constrained('school_classes')
          ->cascadeOnDelete();

    $table->date('date');

    $table->enum('status', [
        'hadir',
        'izin',
        'sakit',
        'alpha'
    ]);

    $table->text('note')->nullable();

    $table->timestamps();

    $table->unique(['student_id', 'date']);
});
}
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
