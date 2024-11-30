<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Feature extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'feature_id';
    protected $fillable = [
        'title',
        'type',
        'value'
    ];
    public static function booted() {
        static::creating(function ($model) {
            $model->feature_id = Str::uuid();
        });
    }

    public function file_feature(): HasMany
    {
        return $this->hasMany(File_feature::class, 'feature_id');
    }
}
