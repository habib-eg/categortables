<?php

namespace Habib\Categortable\Models;

use Habib\Categortable\Traits\CategoryModelTrait;
use Habib\Categortable\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use UuidTrait,CategoryModelTrait;

    const CATEGORY_ID = 'category_id';
}
