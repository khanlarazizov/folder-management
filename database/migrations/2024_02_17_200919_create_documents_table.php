<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('folder_id')->constrained()->cascadeOnDelete();
            $table->integer('number');
//            $table->boolean('status');
            $table->enum('document_type', ['Müqavilə', 'Müqaviləyə Əlavə', 'Protokol', 'Təhvil-təslim aktı']);
            $table->date('date');
            $table->integer('price');
            $table->string('currency');
            $table->string('file');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['number', 'deleted_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
