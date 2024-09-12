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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number');
            $table->date('invoice_Date');
            $table->date('due_date');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('section_id')->constrained('sections')->onDelete('cascade');
            $table->string('discount');
            $table->string('rate_vat');
            $table->decimal('value_vat',8,2);
            $table->decimal('total',8,2);
            $table->decimal('Amount_commission',10,0);
            $table->decimal('Amount_collection',10,0)->nullable();
            $table->enum('invoice_status',['pending','paid','partially_paid'])->default('pending');
            $table->text('note')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('payment_date')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
