<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(Item::class);

    }

    public function users()
    {
        return $this->belongsToMany(User::class);

    }
}
