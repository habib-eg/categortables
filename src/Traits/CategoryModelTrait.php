<?php


namespace Habib\Categortable\Traits;


use Habib\Categortable\Models\Categortable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait CategoryModelTrait
{
    public function initializeCategoryModelTrait()
    {
        $this->fillable=array_merge($this->fillable,[ "name",
            "active",
            "description",
            "image",
            "category_id",
            "options"
        ]);
//        $this->appends[] ='file_path';
        $this->casts = array_merge($this->casts,[
            'active' => 'boolean',
            "options"=>"array"
        ]);
        $this->hidden = array_merge($this->hidden,[
            'options'
        ]);
        $this->attributes = array_merge($this->attributes,[
            "active"=>true
        ]);
    }

    /**
     * @param Builder $builder
     * @return Builder
     */

    public function scopeActive(Builder $builder): Builder
    {
        return $builder->where('active', true);
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeNotActive(Builder $builder): Builder
    {
        return $builder->where('active', false);
    }

    /**
     * @return HasMany
     */
    public function children()
    {
        return $this->hasMany(config('category.model',self::class), self::CATEGORY_ID);
    }
    /**
     * @return BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(config('category.model',self::class), self::CATEGORY_ID);
    }

    /**
     * @param array|null $columns
     * @return array
     */
    public function columns(array $columns = null): array
    {
        $columns = $columns ?? $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
        return $columns;
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeMainCategory(Builder $builder)
    {
        return $builder->whereNull(self::CATEGORY_ID)->with('children');
    }

    public function getImageAttribute($image){
        return filter_var($image,FILTER_VALIDATE_URL)===false ?  asset($image) : $image;
    }
}
