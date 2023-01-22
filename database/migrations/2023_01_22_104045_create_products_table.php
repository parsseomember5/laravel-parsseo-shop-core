<?php

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
            $table->string('locale', 3)->default('fa');
            $table->unsignedBigInteger('translation_id')->nullable();
            $table->unsignedBigInteger('author_id');
            $table->string('title');
            $table->string('h1');
            $table->unsignedInteger('order')->default(0);
            $table->string('slug', 250)->unique();
            $table->string('canonical')->nullable();
            $table->string('meta_description')->nullable();
            $table->longText('excerpt')->nullable();
            $table->longText('body')->nullable();
            $table->longText('faq')->nullable();
            $table->string('faq_title')->nullable();
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('offPrice')->nullable();
            $table->mediumText('image');
            $table->mediumText('script')->nullable();
            $table->double('sitemap_priority')->nullable();
            $table->unsignedBigInteger('sales')->default(0);
            $table->enum('status', \App\Models\Product::STATUS);
            $table->timestamps();
            $table->softDeletes();
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
