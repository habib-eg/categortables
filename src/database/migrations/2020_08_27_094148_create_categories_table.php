<?php

use Habib\Categortable\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $class='\\'.config('category.model',Category::class);
        Schema::create((new $class)->getTable(), function (Blueprint $table) {
            if (config('category.uuid', true)) {
                $table->uuid('id')->primary();
                $table->uuid(config('category.model',Category::class)::CATEGORY_ID ?? 'category_id')->nullable();
            } else {
                $table->id();
                $table->unsignedBigInteger(config('category.model',Category::class)::CATEGORY_ID ?? 'category_id')->nullable();
            }
            $table->string('name');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->text('options')->nullable();
            $table->boolean('active')->default(false);
            $table->softDeletesTz();
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $class='\\'.config('category.model',Category::class);
        Schema::dropIfExists((new $class)->getTable());
    }
}
