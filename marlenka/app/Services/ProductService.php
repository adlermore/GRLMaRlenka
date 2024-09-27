<?php

namespace App\Services;

use AizPackages\CombinationGenerate\Services\CombinationService;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use App\Utility\ProductUtility;
use Illuminate\Support\Str;

class ProductService
{
    public function store(array $data)
    {
        $collection = collect($data);

        if ($collection['meta_title'] == null) {
            $collection['meta_title'] = $collection['name'];
        }
        if ($collection['meta_description'] == null) {
            $collection['meta_description'] = strip_tags($collection['description']);
        }

        if ($collection['meta_img'] == null) {
            $collection['meta_img'] = $collection['thumbnail_img'];
        }


        $shipping_cost = 0;
        if (isset($collection['shipping_type'])) {
            if ($collection['shipping_type'] == 'free') {
                $shipping_cost = 0;
            } elseif ($collection['shipping_type'] == 'flat_rate') {
                $shipping_cost = $collection['flat_shipping_cost'];
            }
        }
        unset($collection['flat_shipping_cost']);

        $slug = Str::slug($collection['name']);
        $same_slug_count = Product::where('slug', 'LIKE', $slug . '%')->count();
        $slug_suffix = $same_slug_count ? '-' . $same_slug_count + 1 : '';
        $slug .= $slug_suffix;

        $published = 1;
        if ($collection['button'] == 'unpublish' || $collection['button'] == 'draft') {
            $published = 0;
        }
        unset($collection['button']);

        $data = $collection->merge(compact(
            'shipping_cost',
            'slug',
            'published',
        ))->toArray();

        return Product::create($data);
    }

    public function update(array $data, Product $product)
    {
        $collection = collect($data);

        $slug = Str::slug($collection['name']);
        $slug = $collection['slug'] ? Str::slug($collection['slug']) : Str::slug($collection['name']);
        $same_slug_count = Product::where('slug', 'LIKE', $slug . '%')->count();
        $slug_suffix = $same_slug_count > 1 ? '-' . $same_slug_count + 1 : '';
        $slug .= $slug_suffix;

        if(!isset($collection['cash_on_delivery'])){
            $collection['cash_on_delivery'] = 0;
        }
        if(!isset($collection['featured'])){
            $collection['featured'] = 0;
        }

        if ($collection['meta_title'] == null) {
            $collection['meta_title'] = $collection['name'];
        }
        if ($collection['meta_description'] == null) {
            $collection['meta_description'] = strip_tags($collection['description']);
        }

        if ($collection['meta_img'] == null) {
            $collection['meta_img'] = $collection['thumbnail_img'];
        }

        if ($collection['lang'] != env("DEFAULT_LANGUAGE")) {
            unset($collection['name']);
            unset($collection['description']);
        }
        unset($collection['lang']);


        $shipping_cost = 0;
        if (isset($collection['shipping_type'])) {
            if ($collection['shipping_type'] == 'free') {
                $shipping_cost = 0;
            } elseif ($collection['shipping_type'] == 'flat_rate') {
                $shipping_cost = $collection['flat_shipping_cost'];
            }
        }
        unset($collection['flat_shipping_cost']);

        unset($collection['button']);

        $data = $collection->merge(compact(
            'shipping_cost',
            'slug',
        ))->toArray();

//        dump($data);
//        dd($product);
        $product->update($data);
        // dd($product);

        return $product;
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->product_translations()->delete();
        $product->categories()->detach();
        $product->taxes()->delete();
        $product->wishlists()->delete();
        $product->carts()->delete();
        $product->last_viewed_products()->delete();
        Product::destroy($id);
    }

    public function product_search(array $data)
    {
        $collection     = collect($data);
        $auth_user      = auth()->user();
        $productType    = $collection['product_type'];
        $products       = Product::query();

        if($collection['category'] != null ) {
            $category = Category::with('childrenCategories')->find($collection['category']);
            $products = $category->products();
        }

        $products->where('published', '1');

        if($collection['product_id'] != null){
            $products->where('id', '!=' , $collection['product_id']);
        }

        if ($collection['search_key'] != null) {
            $products->where('name','like', '%' . $collection['search_key'] . '%');
        }

        return $products->limit(20)->get();
    }
}
