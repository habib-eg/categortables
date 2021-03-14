<?php

use Habib\Categortable\Models\Categortable;
use Habib\Categortable\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategortablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $class='\\'.config('category.model_morph',Categortable::class);
        Schema::create((new $class())->getTable(), function (Blueprint $table) {
            if (config('category.uuid', true)) {
                $table->uuid('id')->primary();
                $table->nullableUuidMorphs(config('category.model_morph',Categortable::class)::CATEGORTABLE ?? 'categortable');
                $table->uuid(config('category.model',Category::class)::CATEGORY_ID ?? 'category_id')->nullable();
            } else {
                $table->id();
                $table->nullableMorphs(config('category.model_morph',Categortable::class)::CATEGORTABLE ?? 'categortable');
                $table->unsignedBigInteger(config('category.model',Category::class)::CATEGORY_ID ?? 'category_id')->nullable();
            }
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
        $class='\\'.config('category.model_morph',Categortable::class);

        Schema::dropIfExists((new $class())->getTable());
    }
}
