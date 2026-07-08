<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'product_code',
        'product_name',
        'description',
        'stock',
        'minimum_stock',
        'location',
        'item_condition',
        'image',
        'purchase_date',
        'purchase_price',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function borrowingDetails()
{
    return $this->hasMany(
        BorrowingDetail::class
    );
}
}