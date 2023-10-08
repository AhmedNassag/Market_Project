<?php

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            // $table->foreignIdFor(Product::class)->constrained()->cascadeOnUpdate()->onDelete(null);
            // $table->foreign('product_id')->references('id')->on('products')->cascadeOnUpdate()->onDelete(null);
            $table->foreignId('product_id')->nullable()->constrained('products')->cascadeOnUpdate()->onDelete('set null');
            // $table->foreignIdFor(Transaction::class)->constrained()->cascadeOnUpdate()->onDelete(null);
            // $table->foreign('transaction_id')->references('id')->on('transactions')->cascadeOnUpdate()->onDelete(null);
            $table->foreignId('transaction_id')->nullable()->constrained('transactions')->cascadeOnUpdate()->onDelete('set null');
            $table->integer('qty');
            $table->string('name');
            $table->decimal('base_price',15, 2);
            $table->decimal('base_total', 15, 2);
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
        Schema::dropIfExists('transaction_details');
    }
}
