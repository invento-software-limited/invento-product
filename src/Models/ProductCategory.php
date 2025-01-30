<?php

namespace Invento\Product\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    protected $table = 'product_categories';
    protected $guarded = [];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

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

    /**
     * @param Builder $builder
     * @param $searchItem
     * @return Builder
     */
    public function scopeSearch(Builder $builder, $searchItem): Builder
    {
        return $builder->where('id', "{$searchItem}%")
            ->orWhere('name', 'LIKE', "{$searchItem}%");
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeActive(Builder $builder): Builder
    {
        return $builder->where('status', true);
    }

    public function parent()
    {
        return
    }
}
