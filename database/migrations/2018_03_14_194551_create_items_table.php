<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id')->index();
            $table->string('slug', 255)->unique()->comment('транслитерация названия для ссылки');
            $table->integer('category')->comment('категория товара');
            $table->integer('image')->nullable()->comment('картинка товара');
            $table->text('name')->comment('название товара');
            $table->text('characteristics')->comment('характеристика товара');
            $table->integer('title')->comment('title seo');
            $table->integer('description')->comment('description seo');
            $table->tinyinteger('show')->default(1)->comment('1 - показать товар, 0 - скрыть');
            $table->double('price', 15, 2)->nullable()->comment('цена');
            $table->tinyinteger('existence')->default(1)->comment('наличие');
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
        Schema::dropIfExists('items');
    }
}
