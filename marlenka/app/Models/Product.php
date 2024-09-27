<?php

namespace App\Models;

use App;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'brand_id',
        'category_id',
        'description',
        'featured',
        'photos',
        'thumbnail_img',
        'unit_price',
        'meta_title',
        'meta_description',
        'meta_img',
        'slug',
        'shipping_type',
        'cash_on_delivery',
        'shipping_cost'
    ];

    protected $with = ['product_translations', 'taxes', 'thumbnail'];

    public function getTranslation($field = '', $lang = false)
    {
        $lang = $lang == false ? App::getLocale() : $lang;
        $product_translations = $this->product_translations->where('lang', $lang)->first();
        return $product_translations != null ? $product_translations->$field : $this->$field;
    }

    public function product_translations()
    {
        return $this->hasMany(ProductTranslation::class);
    }

    public function main_category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function product_categories()
    {
        return $this->hasMany(ProductCategory::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
    public function taxes()
    {
        return $this->hasMany(ProductTax::class);
    }

    public function thumbnail()
    {
        return $this->belongsTo(Upload::class, 'thumbnail_img');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
    public function last_viewed_products()
    {
        return $this->hasMany(LastViewedProduct::class);
    }

    public function scopeIsPublished($query)
    {
        return $query->where('published', 1);
    }
}
