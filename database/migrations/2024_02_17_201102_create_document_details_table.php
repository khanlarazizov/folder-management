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
        Schema::create('document_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('document_id');
            $table->unsignedBigInteger('contract_id')->nullable();
            $table->unsignedBigInteger('addition_id')->nullable();

            $table->enum('contract_type', ['Partnyorluq', 'Xidmət', 'Alqı-satqı'])->nullable();
            $table->enum('shopping', ['Biz alırıq', 'Biz satırıq'])->nullable();
            $table->string('other_side_type')->nullable();
            $table->string('other_side_name')->nullable();
            $table->string('product_service_name')->nullable();
            $table->integer('product_service_number_integer')->nullable();
            $table->string('product_service_number_string')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('document_id')->on('documents')->references('id')->onDelete('cascade');
            $table->foreign('contract_id')->on('documents')->references('id')->onDelete('cascade');
            $table->foreign('addition_id')->on('documents')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_details');
    }
};
