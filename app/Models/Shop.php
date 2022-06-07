<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'category'];
    protected $hidden = ["updated_at", "created_at"];

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('price')->as("shop_price");
    }
}
