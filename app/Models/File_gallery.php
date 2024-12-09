<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class File_gallery extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'file_gallery_id';
    protected $fillable = [
        'image_id',
        'file_id'
    ];
    public static function booted() {
        static::creating(function ($model) {
            $model->file_gallery_id = Str::uuid();
        });
    }
}
