<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SpecialOrder extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function special_categories()
    {
        return $this->belongsToMany(SpecialCategory::class );
    }

    public function customer()
    {
       return $this->belongsTo(Customer::class);
    }

}
