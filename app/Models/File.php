<?php

namespace App\Models;

use Baloot\Models\City;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class File extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'file_id';
    protected $fillable = [
        'user_id',
        'category_id',
        'city_id',
        'title',
        'address',
        'location',
        'description',
        'image_id'
    ];
    public static function booted() {
        static::creating(function ($model) {
            $model->file_id = Str::uuid();
        });
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'image_id');
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
    public function file_feature(): HasMany
    {
        return $this->hasMany(File_feature::class);
    }
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
