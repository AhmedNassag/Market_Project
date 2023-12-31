<?php

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // $table->foreignIdFor(Category::class)->constrained()->cascadeOnUpdate()->onDelete(null);
            // $table->foreign('category_id')->references('id')->on('categories')->cascadeOnUpdate()->onDelete(null);

            $table->foreignId('category_id')->nullable()->constrained('categories')->cascadeOnUpdate()->onDelete('set null');
            $table->string('name');
            $table->string('code')->unique();
            $table->integer('quantity');
            $table->decimal('price', 15, 2);
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
        Schema::dropIfExists('products');
    }
}
