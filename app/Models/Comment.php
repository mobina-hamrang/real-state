<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Comment extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'comment_id';
    protected $fillable = [
        'file_id',
        'user_id',
        'text',
        'reply_id'
    ];
    public static function booted() {
        static::creating(function ($model) {
            $model->comment_id = Str::uuid();
        });
    }

    public function parent(): HasOne
    {
        return $this->hasOne(Comment::class, 'reply_id');
    }
    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'reply_id');
    }

    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class, 'file_id');
    }
}
