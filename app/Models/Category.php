<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    protected $dateFormat = 'Y-m-d H:i:s'; // Or any format you prefer

    // Optionally, add a method to format the 'created_at' column
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }


    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product');
    }

    
}
