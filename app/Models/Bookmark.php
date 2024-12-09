<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Bookmark extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $primaryKey = 'bookmark_id';

    protected $fillable = [
        'file_id',
        'user_id',
        'isBookmark'
    ];
    public static function booted() {
        static::creating(function ($model) {
            $model->bookmark_id = Str::uuid();
        });
    }

    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class, 'file_id');
    }
}
