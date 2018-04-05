<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->bigIncrements('id')->index();
            $table->string('slug', 255)->unique()->comment('транслитерация названия для ссылки');
            $table->text('name')->comment('название категории');
            $table->text('intro_description')->comment('краткое описание категории на главную страницу');
            $table->text('full_description')->nullable()->comment('полное описание категории на страницу категории');
            $table->integer('image')->nullable()->comment('id логотип категории 100х100');
            $table->integer('title')->comment('id title seo');
            $table->integer('description')->comment('id description seo');
            $table->tinyinteger('show')->default(1)->comment('1 - показать категорию, 0 - скрыть');
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
        Schema::dropIfExists('category');
    }
}
