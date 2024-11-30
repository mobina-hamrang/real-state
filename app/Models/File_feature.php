<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class File_feature extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'file_feature_id';
    protected $fillable = [
        'feature_id',
        'file_id',
        'value',
    ];
    public static function booted() {
        static::creating(function ($model) {
            $model->file_feature_id = Str::uuid();
        });
    }

    public function feature():BelongsTo
    {
        return $this->belongsTo(Feature::class, 'feature_id');
    }
    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class, 'file_id');
    }
}
