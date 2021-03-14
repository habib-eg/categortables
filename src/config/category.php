<?php

use Habib\Categortable\Models\Categortable;
use Habib\Categortable\Models\Category;

return[
    'uuid'=>true,
    'user_id_column'=>'user_id',
    'model'=> Category::class,
    'model_morph'=>Categortable::class,
    'morph_name'=>'categortable',
    'morph_table'=>'categortables',
];
