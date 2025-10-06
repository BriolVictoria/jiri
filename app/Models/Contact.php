<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email'];

    public function homeworks():BelongsToMany
    {
        return $this->belongsToMany(Homework::class, 'implementations');
    }

    public function implementations():HasMany
    {
        return $this->hasMany(Implementation::class);
    }
}
