<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->unsignedBigInteger('category_id');

            $table->string('title',128)->unique();
            $table->string('slug',128)->unique();
            $table->longText('description',128);
            $table->tinyInteger('in_stock')->default(true);
            $table->decimal('price',8,2);//8 er mane dosomik er age 8ta pojonto digit nibe ar 2 er mane price ta dosomik er por 2digit nibe
            $table->decimal('sale_price',8,2)->nullable();
            $table->tinyInteger('active')->default(true);
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
};
