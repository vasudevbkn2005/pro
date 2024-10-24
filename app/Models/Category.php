<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable=['mname','cname','image','des','display'];
    function productids(){
        return $this->hasMany(ProductCategory::class);
    }
}
