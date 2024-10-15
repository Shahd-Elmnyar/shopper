<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    /**
     * The products that have this size.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class,'sizes_products','size_id', 'product_id')
                    ->withPivot('is_active')  // Include 'is_active' field from the pivot table
                    ->withTimestamps();       // Track timestamps on the pivot table
    }

    //get only the active sizes for a product,
    public function activeForProduct(Product $product)
{
    return $this->products()->wherePivot('active', true)->where('product_id', $product->id)->exists();
}

}
