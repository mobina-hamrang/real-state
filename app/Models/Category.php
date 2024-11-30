<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
//    protected $keyType = 'string';
//    public $incrementing = false;
    protected $primaryKey = 'category_id';
    protected $fillable = [
        'title',
        'image_id',
        'parent_id'
    ];
//    public static function booted() {
//        static::creating(function ($model) {
//            $model->category_id = Str::uuid();
//        });
//    }

    public function subCategory(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'image_id');
    }

    public function file(): HasMany
    {
        return $this->hasMany(File::class, 'category_id');
    }
}
