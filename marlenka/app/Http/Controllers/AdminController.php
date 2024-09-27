<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Upload;
use App\Models\User;
use Artisan;
use Cache;
use Carbon\Carbon;
use DB;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_dashboard(Request $request)
    {
        $root_categories = Category::get();

        $data['cached_graph_data'] = Cache::remember('cached_graph_data', 86400, function () use ($root_categories) {
            $num_of_sale_data = null;
            $qty_data = null;
            foreach ($root_categories as $key => $category) {
                $products = Product::get();
                $qty = 0;
                $sale = 0;
                foreach ($products as $key => $product) {
                    $sale += $product->num_of_sale;
                }
                $qty_data .= $qty . ',';
                $num_of_sale_data .= $sale . ',';
            }
            $item['num_of_sale_data'] = $num_of_sale_data;
            $item['qty_data'] = $qty_data;

            return $item;
        });

        $data['root_categories'] = $root_categories;

        $data['total_customers'] = User::where('user_type', 'customer')->where('email_verified_at', '!=', null)->count();
        $data['top_customers'] = User::select('users.id', 'users.name', 'users.avatar_original', DB::raw('SUM(grand_total) as total'))
            ->join('orders', 'orders.user_id', '=', 'users.id')
            ->groupBy('orders.user_id')
            ->where('users.user_type', 'customer')
            ->orderBy('total', 'desc')
            ->limit(6)
            ->get();
        $data['total_products'] = Product::where('published', 1)->count();
        $data['total_categories'] = Category::count();
        $data['top_categories'] = Product::select('categories.name', 'categories.id', DB::raw('SUM(grand_total) as total'))
            ->leftJoin('order_details', 'order_details.product_id', '=', 'products.id')
            ->leftJoin('orders', 'orders.id', '=', 'order_details.order_id')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->where('orders.delivery_status', 'delivered')
            ->groupBy('categories.id')
            ->orderBy('total', 'desc')
            ->limit(3)
            ->get();
        $data['total_brands'] = Brand::count();
        $data['top_brands'] = Product::select('brands.name', 'brands.id', DB::raw('SUM(grand_total) as total'))
            ->leftJoin('order_details', 'order_details.product_id', '=', 'products.id')
            ->leftJoin('orders', 'orders.id', '=', 'order_details.order_id')
            ->leftJoin('brands', 'products.brand_id', '=', 'brands.id')
            ->where('orders.delivery_status', 'delivered')
            ->groupBy('brands.id')
            ->orderBy('total', 'desc')
            ->limit(3)
            ->get();
        $data['total_sale'] = Order::where('delivery_status', 'delivered')->sum('grand_total');
        $data['sale_this_month'] = Order::whereMonth('created_at', Carbon::now()->month)->sum('grand_total');
        $sales_stat = Order::select('orders.user_id', 'users.name', 'users.user_type', 'users.avatar_original', DB::raw('SUM(grand_total) as total'), DB::raw('DATE_FORMAT(orders.created_at, "%M") AS month'))
            ->join('users', 'orders.user_id', 'users.id')
            ->whereYear('orders.created_at', '=', Date("Y"))
            ->groupBy('month')
            ->orderBy(DB::raw('MONTH(orders.created_at)'), 'asc')
            ->get();
        $new_stat = array();
        foreach ($sales_stat as $row) {
            $new_stat[$row->month][] = $row;
        }
        $data['sales_stat'] = $new_stat;
        // dd($sales_stat);
        $data['total_order'] = Order::count();
        $data['total_placed_order'] = Order::where('delivery_status', '!=', 'cancelled')->count();
        $data['total_pending_order'] = Order::where('delivery_status', 'pending')->count();
        $data['total_confirmed_order'] = Order::where('delivery_status', 'confirmed')->count();
        $data['total_picked_up_order'] = Order::where('delivery_status', 'picked_up')->count();
        $data['total_shipped_order'] = Order::where('delivery_status', 'on_the_way')->count();

        return view('backend.dashboard', $data);
    }

    public function top_category_products_section(Request $request)
    {
        $top_categories_products = DB::table(DB::raw('(SELECT products.id product_id, products.name product_name, products.slug product_slug, products.category_id,
                                                        `products`.`thumbnail_img` as `product_thumbnail_img`, od.sales, od.total, od.created_at order_detail_created,
                                                        categories.name AS category_name,
                                                        `categories`.`cover_image`,
                                                        ROW_NUMBER() OVER (PARTITION BY products.category_id ORDER BY od.sales DESC) rn
                                                from products
                                                INNER JOIN (
                                                SELECT product_id, SUM(quantity) sales, SUM(price + tax) AS total, created_at
                                                FROM order_details
                                                WHERE ' . ($request->interval_type == 'all' ?: 'created_at >= DATE_SUB(NOW(), INTERVAL 1 ' . $request->interval_type . ')') . '
                                                AND order_details.delivery_status = "delivered"
                                                GROUP BY product_id
                                                )  od ON od.product_id = products.id
                                                LEFT JOIN categories ON products.category_id = categories.id
                                                ) t'))
            ->select(DB::raw('category_id, category_name, cover_image, product_id, product_name, product_slug, product_thumbnail_img, sales, total, order_detail_created'))
            ->where('rn', '<=', 3)
            ->orderBy('sales', 'desc')
            ->get();

        $category_array = [];
        $new_array = array();
        foreach ($top_categories_products as $key => $row) {
            $row->product_thumbnail_img = Upload::where('id', $row->product_thumbnail_img)->first();
            $category_array[] = $row->category_id;
            $new_array[$row->category_id][] = $row;
        }
        $top_categories2 = array_unique($category_array);
        $top_categories_products = $new_array;

        return view('backend.dashboard.top_category_products_section', compact('top_categories2', 'top_categories_products'))->render();
    }

    function clearCache(Request $request)
    {
        Artisan::call('optimize:clear');
        flash(translate('Cache cleared successfully'))->success();
        return back();
    }
}
