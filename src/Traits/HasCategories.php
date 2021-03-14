<?php

namespace Habib\Categortable\Traits;

use Habib\Categortable\Models\Categortable;
use Habib\Categortable\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * Trait HasCategories
 * @package Habib\Categortable\Traits
 */
trait HasCategories
{
    /**
     * @param mixed $category
     * @return array|Model
     */
    public function addCategory($category)
    {
        if ($category instanceof Category) {
            return $this->addCategoryModel($category);
        }
        if (is_array($category)) {
            $cats = [];
            foreach ($category as $cat) {
                if ($cat instanceof Category) {
                    $cats[] = $this->addCategoryModel($cat);
                } else {
                    $cats[] = $this->addCategoryId($cat);
                }
            }
            return $cats;
        }


    }

    /**
     * @param Category $category
     * @return Model
     */
    public function addCategoryModel(Category $category)
    {
        return $this->addCategoryId($category->id);
    }

    /**
     * @param $id
     * @return array|Model
     */
    public function addCategoryId($id)
    {
        return $this->categories()->syncWithoutDetaching([$id]);
    }

    /**
     * @return MorphToMany
     */
    public function categories(): MorphToMany
    {
        return $this->morphToMany(
            config('category.model', Category::class),
            config('category.morph_name', 'categortable'),
            config('category.morph_table', 'categortables'),
        )->using(config('category.model_morph', Categortable::class))->withTimestamps();
    }

}
