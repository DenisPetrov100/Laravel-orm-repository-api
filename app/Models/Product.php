<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name', 'description', 'type'];
    protected $hidden = ["updated_at", "created_at"];

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function shops()
    {
        return $this->belongsToMany(Shop::class)->withPivot("price");
    }
}
