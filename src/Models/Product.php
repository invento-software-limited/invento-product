<?php

namespace Invento\Product\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'doctors';
    protected $guarded = [];
    public const Image = 'image';

    public const GENDER = [
        'Male' => 'Male',
        'Female' => 'Female',
        'Other' => 'Other'
    ];
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

    public function getNameAttribute(): string
    {
        return $this->attributes['first_name'].' '.$this->attributes['last_name'];
    }


    public function getImageAttribute(): string
    {
        return $this->attributes['image'] ? url('storage/' . $this->attributes['image']) : url('storage/default.jpg');
    }

    public function getHasImageAttribute(){
        return $this->attributes['image'] ? $this->attributes['image'] : false;
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
            ->orWhere('first_name', 'LIKE', "{$searchItem}%")
            ->orWhere('last_name', 'LIKE', "{$searchItem}%")
            ->orWhere('phone', 'LIKE', "{$searchItem}%")
            ->orWhere('email', 'LIKE', "{$searchItem}%")
            ->orWhere('id_number', 'LIKE', "{$searchItem}%");
    }
}
