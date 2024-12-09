<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Image extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'image_id';
    protected $fillable = [
        'image_id',
        'path'
    ];
    public static function booted() {
        static::creating(function ($model) {
            $model->image_id = Str::uuid();
        });
    }

    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'image_id');
    }

    public function file(): HasOne
    {
        return $this->hasOne(File::class, 'image_id');
    }
}
