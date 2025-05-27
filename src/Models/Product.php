<?php

namespace Invento\Product\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';
    protected $guarded = [];
    public const Image = 'image';


    public const STATUS = [
        'Published' => 'Published',
        'Draft' => 'Draft'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */


    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        parent::boot();

        static::creating(function ($model) {
            if ($model->created_by == null) $model->created_by = auth()->user()->id;
        });

        static::deleting(function ($model) {
            $model->deleted_by = auth()->id();
            $model->update();
        });
    }

    public function getThumbnailAttribute(): string
    {
        return $this->attributes['thumbnail'] ? url('storage/' . $this->attributes['thumbnail']) : url('storage/default.jpg');
    }

    public function getHasThumbnailAttribute(){
        return $this->attributes['thumbnail'] ? $this->attributes['thumbnail'] : false;
    }


    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeActive(Builder $builder): Builder
    {
        return $builder->where('status', true);
    }

    /**
     * @param Builder $builder
     * @param $searchItem
     * @return Builder
     */
    public function scopeSearch(Builder $builder, $searchItem): Builder
    {
        return $builder->where('id', "{$searchItem}%")
            ->orWhere('id', 'LIKE', "{$searchItem}")
            ->orWhere('title', 'LIKE', "{$searchItem}%");
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(ProductCategory::class, 'product_category_product', 'product_id', 'product_category_id');
    }
}
