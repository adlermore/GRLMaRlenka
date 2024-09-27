<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Search;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Utility\CategoryUtility;

class SearchController extends Controller
{
    public function index(Request $request, $category_id = null, $brand_id = null)
    {
        $query = $request->keyword;
        $sort_by = $request->sort_by;
        $min_price = $request->min_price;
        $max_price = $request->max_price;
        $category = [];
        $categories = [];

        $conditions = [];

        if ($brand_id != null) {
            $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        } elseif ($request->brand != null) {
            $brand_id = (Brand::where('slug', $request->brand)->first() != null) ? Brand::where('slug', $request->brand)->first()->id : null;
            $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        }

        $products = Product::where($conditions);

        if ($category_id != null) {
            $category = Category::find($category_id);
            $products = $category->products();
        }
        $categories = Category::orderBy('order_level', 'desc')->get();

        if ($min_price != null && $max_price != null) {
            $products->where('unit_price', '>=', $min_price)->where('unit_price', '<=', $max_price);
        }

        if ($query != null) {
            $searchController = new SearchController;
            $searchController->store($request);

            $products->where(function ($q) use ($query) {
                foreach (explode(' ', trim($query)) as $word) {
                    $q->where('name', 'like', '%' . $word . '%')
                        ->orWhereHas('product_translations', function ($q) use ($word) {
                            $q->where('name', 'like', '%' . $word . '%');
                        });
                }
            });

            $case1 = $query . '%';
            $case2 = '%' . $query . '%';

            $products->orderByRaw("CASE
                WHEN name LIKE '$case1' THEN 1
                WHEN name LIKE '$case2' THEN 2
                ELSE 3
                END");
        }

        switch ($sort_by) {
            case 'newest':
                $products->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $products->orderBy('created_at', 'asc');
                break;
            case 'price-asc':
                $products->orderBy('unit_price', 'asc');
                break;
            case 'price-desc':
                $products->orderBy('unit_price', 'desc');
                break;
            default:
                $products->orderBy('id', 'desc');
                break;
        }

        $products = $products->with('taxes')->paginate(24)->appends(request()->query());

        return view('frontend.product_listing', compact('products', 'query', 'category', 'categories', 'category_id', 'brand_id', 'sort_by', 'min_price', 'max_price'));
    }

    public function listing(Request $request)
    {
        return $this->index($request);
    }

    public function listingByCategory(Request $request, $category_slug)
    {
        $category = Category::where('slug', $category_slug)->first();
        if ($category != null) {
            return $this->index($request, $category->id);
        }
        abort(404);
    }

    public function listingByBrand(Request $request, $brand_slug)
    {
        $brand = Brand::where('slug', $brand_slug)->first();
        if ($brand != null) {
            return $this->index($request, null, $brand->id);
        }
        abort(404);
    }

    //Suggestional Search
    public function ajax_search(Request $request)
    {
        $keywords = array();
        $query = $request->search;

        $products_query = Product::query();

        $products_query = $products_query->where('published', 1)
            ->where(function ($q) use ($query) {
                foreach (explode(' ', trim($query)) as $word) {
                    $q->where('name', 'like', '%' . $word . '%')
                        ->orWhereHas('product_translations', function ($q) use ($word) {
                            $q->where('name', 'like', '%' . $word . '%');
                        });
                }
            });
        $case1 = $query . '%';
        $case2 = '%' . $query . '%';

        $products_query->orderByRaw("CASE
                WHEN name LIKE '$case1' THEN 1
                WHEN name LIKE '$case2' THEN 2
                ELSE 3
                END");
        $products = $products_query->limit(3)->get();

        $categories = Category::where('name', 'like', '%' . $query . '%')->get()->take(3);


        if (sizeof($keywords) > 0 || sizeof($categories) > 0 || sizeof($products) > 0) {
            return view('frontend.partials.search_content', compact('products', 'categories', 'keywords'));
        }
        return '0';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $search = Search::where('query', $request->keyword)->first();
        if ($search != null) {
            $search->count = $search->count + 1;
            $search->save();
        } else {
            $search = new Search;
            $search->query = $request->keyword;
            $search->save();
        }
    }
}
