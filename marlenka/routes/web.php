<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AizUploadController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Payment\PaypalController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\SupportTicketController;
use App\Http\Controllers\WishlistController;

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get('/refresh-csrf', function () {
    return csrf_token();
});

// AIZ Uploader
Route::controller(AizUploadController::class)->group(function () {
    Route::post('/aiz-uploader', 'show_uploader');
    Route::post('/aiz-uploader/upload', 'upload');
    Route::get('/aiz-uploader/get-uploaded-files', 'get_uploaded_files');
    Route::post('/aiz-uploader/get_file_by_ids', 'get_preview_files');
    Route::get('/aiz-uploader/download/{id}', 'attachment_download')->name('download_attachment');
});

Route::group(['middleware' => ['prevent-back-history']], function () {
    Auth::routes(['verify' => true]);
});

// Login
Route::controller(LoginController::class)->group(function () {
    Route::get('/logout', 'logout');
    //Apple Callback
    Route::get('/account-deletion', 'account_deletion')->name('account_delete');
});

Route::controller(VerificationController::class)->group(function () {
    Route::get('/email/resend', 'resend')->name('verification.resend');
    Route::get('/verification-confirmation/{code}', 'verification_confirmation')->name('email.verification.confirmation');
});

Route::controller(HomeController::class)->group(function () {
    Route::get('/email-change/callback', 'email_change_callback')->name('email_change.callback');
    Route::post('/password/reset/email/submit', 'reset_password_with_code')->name('password.update');

    Route::get('/users/login', 'login')->name('user.login');
    Route::get('/users/registration', 'registration')->name('user.registration');
    Route::post('/users/login/cart', 'cart_login')->name('cart.login.submit');

    //Home Page
    Route::get('/', 'index')->name('home');

    Route::post('/home/section/featured', 'load_featured_section')->name('home.section.featured');
    Route::post('/home/section/best-selling', 'load_best_selling_section')->name('home.section.best_selling');
    Route::post('/home/section/newest-products', 'load_newest_product_section')->name('home.section.newest_products');
    Route::post('/home/section/home-categories', 'load_home_categories_section')->name('home.section.home_categories');

    //category dropdown menu ajax call
    Route::post('/category/nav-element-list', 'get_category_items')->name('category.elements');

    //Todays Deal Details Page
    Route::get('/product/{slug}', 'product')->name('product');

    Route::get('/brands', 'all_brands')->name('brands.all');
    Route::get('/categories', 'all_categories')->name('categories.all');
    Route::get('/coupons', 'all_coupons')->name('coupons.all');

    // Policies
    Route::get('/return-policy', 'returnpolicy')->name('returnpolicy');
    Route::get('/support-policy', 'supportpolicy')->name('supportpolicy');
    Route::get('/terms', 'terms')->name('terms');
    Route::get('/privacy-policy', 'privacypolicy')->name('privacypolicy');
});

// Language Switch
Route::post('/language', [LanguageController::class, 'changeLanguage'])->name('language.change');

// Currency Switch
Route::post('/currency', [CurrencyController::class, 'changeCurrency'])->name('currency.change');

Route::get('/sitemap.xml', function () {
    return base_path('sitemap.xml');
});

// Search
Route::controller(SearchController::class)->group(function () {
    Route::get('/search', 'index')->name('search');
    Route::get('/search?keyword={search}', 'index')->name('suggestion.search');
    Route::post('/ajax-search', 'ajax_search')->name('search.ajax');
    Route::get('/category/{category_slug}', 'listingByCategory')->name('products.category');
    Route::get('/brand/{brand_slug}', 'listingByBrand')->name('products.brand');
});

// Cart
Route::controller(CartController::class)->group(function () {
    Route::get('/cart', 'index')->name('cart');
    Route::post('/cart/show-cart-modal', 'showCartModal')->name('cart.showCartModal');
    Route::post('/cart/addtocart', 'addToCart')->name('cart.addToCart');
    Route::post('/cart/removeFromCart', 'removeFromCart')->name('cart.removeFromCart');
    Route::post('/cart/updateQuantity', 'updateQuantity')->name('cart.updateQuantity');
    Route::post('/cart/updateCartStatus', 'updateCartStatus')->name('cart.updateCartStatus');
});

//Paypal START
Route::controller(PaypalController::class)->group(function () {
    Route::get('/paypal/payment/done', 'getDone')->name('payment.done');
    Route::get('/paypal/payment/cancel', 'getCancel')->name('payment.cancel');
});

// Subscribe
Route::resource('subscribers', SubscriberController::class);

Route::group(['middleware' => ['user', 'verified', 'unbanned']], function () {

    Route::controller(HomeController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard')->middleware(['prevent-back-history']);
        Route::post('/new-user-verification', 'new_verify')->name('user.new.verify');
        Route::post('/new-user-email', 'update_email')->name('user.change.email');
        Route::post('/user/update-profile', 'userProfileUpdate')->name('user.profile.update');
    });
});

// Checkout Routs
Route::group(['prefix' => 'checkout'], function () {
    Route::controller(CheckoutController::class)->group(function () {
        // Route::get('/', 'get_shipping_info')->name('checkout.shipping_info');
        Route::get('/', 'index')->name('checkout');
        Route::any('/delivery-info', 'store_shipping_info')->name('checkout.store_shipping_infostore');
        Route::post('/payment-select', 'store_delivery_info')->name('checkout.store_delivery_info');
        Route::post('/payment', 'checkout')->name('payment.checkout');
        Route::get('/order-confirmed', 'order_confirmed')->name('order_confirmed');
        Route::post('/apply-coupon-code', 'apply_coupon_code')->name('checkout.apply_coupon_code');
        Route::post('/remove-coupon-code', 'remove_coupon_code')->name('checkout.remove_coupon_code');
        Route::post('/guest-customer-info-check', 'guestCustomerInfoCheck')->name('guest_customer_info_check');
        Route::post('/updateDeliveryAddress', 'updateDeliveryAddress')->name('checkout.updateDeliveryAddress');
        Route::post('/updateDeliveryInfo', 'updateDeliveryInfo')->name('checkout.updateDeliveryInfo');
    });
});

Route::group(['middleware' => ['customer', 'verified', 'unbanned']], function () {

    // Wishlist
    Route::resource('wishlists', WishlistController::class);
    Route::post('/wishlists/remove', [WishlistController::class, 'remove'])->name('wishlists.remove');

    // Support Ticket
    Route::resource('support_ticket', SupportTicketController::class);

    Route::post('/order/re-payment', [CheckoutController::class, 'orderRePayment'])->name('order.re_payment');
});


Route::get('translation-check/{check}', [LanguageController::class, 'get_translation']);

Route::controller(AddressController::class)->group(function () {
    Route::post('/get-states', 'getStates')->name('get-state');
    Route::post('/get-cities', 'getCities')->name('get-city');
});

Route::group(['middleware' => ['auth']], function () {

    Route::get('invoice/{order_id}', [InvoiceController::class, 'invoice_download'])->name('invoice.download');

    //Address
    Route::resource('addresses', AddressController::class);
    Route::controller(AddressController::class)->group(function () {
         Route::post('/addresses/update/{id}', 'update')->name('addresses.update');
        Route::get('/addresses/destroy/{id}', 'destroy')->name('addresses.destroy');
        Route::get('/addresses/set-default/{id}', 'set_default')->name('addresses.set_default');
    });
});

//Blog Section
Route::controller(BlogController::class)->group(function () {
    Route::get('/blog', 'all_blog')->name('blog');
    Route::get('/blog/{slug}', 'blog_details')->name('blog.details');
});

Route::controller(PageController::class)->group(function () {
    //mobile app balnk page for webview
    Route::get('/mobile-page/{slug}', 'mobile_custom_page')->name('mobile.custom-pages');

    //Custom page
    Route::get('/{slug}', 'show_custom_page')->name('custom-pages.show_custom_page');
});
