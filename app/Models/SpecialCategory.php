<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpecialCategory extends Model
{
    public $table = "special_category";

    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function special_orders()
    {
        return $this->belongsToMany(SpecialOrder::class);

    }
}
