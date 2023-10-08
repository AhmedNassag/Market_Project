<?php

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            // $table->foreignIdFor(Product::class)->constrained()->cascadeOnUpdate()->onDelete(null);
            // $table->foreign('product_id')->references('id')->on('products')->cascadeOnUpdate()->onDelete(null);
            $table->foreignId('product_id')->nullable()->constrained('products')->cascadeOnUpdate()->onDelete('set null');
            // $table->foreignIdFor(User::class)->constrained()->cascadeOnUpdate()->onDelete(null);
            // $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate()->onDelete(null);
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnUpdate()->onDelete('set null');
            $table->string('name');
            $table->integer('stock');
            $table->integer('quantity');
            $table->decimal('price',15, 2);
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
        Schema::dropIfExists('carts');
    }
}
