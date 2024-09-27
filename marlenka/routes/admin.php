<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AizUploadController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\BusinessSettingsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\SupportTicketController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\ZoneController;

/*
  |--------------------------------------------------------------------------
  | Admin Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register admin routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */
Route::get('/admin', [AdminController::class, 'admin_dashboard'])->name('admin.dashboard')->middleware(['auth', 'admin', 'prevent-back-history']);
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin', 'prevent-back-history']], function () {

    // category
    Route::resource('categories', CategoryController::class);
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/categories/edit/{id}', 'edit')->name('categories.edit');
        Route::get('/categories/destroy/{id}', 'destroy')->name('categories.destroy');
    });

    // Brand
    Route::resource('brands', BrandController::class);
    Route::controller(BrandController::class)->group(function () {
        Route::get('/brands/edit/{id}', 'edit')->name('brands.edit');
        Route::get('/brands/destroy/{id}', 'destroy')->name('brands.destroy');
    });

    // Products
    Route::controller(ProductController::class)->group(function () {
        Route::get('/products/all', 'all_products')->name('products.all');
        Route::get('/products/create', 'create')->name('products.create');
        Route::post('/products/store/', 'store')->name('products.store');
        Route::get('/products/{id}/edit', 'edit')->name('products.edit');
        Route::post('/products/update/{product}', 'update')->name('products.update');
        Route::post('/products/featured', 'updateFeatured')->name('products.featured');
        Route::post('/products/published', 'updatePublished')->name('products.published');
        Route::post('/products/get_products_by_subcategory', 'get_products_by_subcategory')->name('products.get_products_by_subcategory');
        Route::get('/products/duplicate/{id}', 'duplicate')->name('products.duplicate');
        Route::get('/products/destroy/{id}', 'destroy')->name('products.destroy');
        Route::post('/bulk-product-delete', 'bulk_product_delete')->name('bulk-product-delete');

        Route::post('/product-search', 'product_search')->name('product.search');
        Route::post('/get-selected-products', 'get_selected_products')->name('get-selected-products');
    });

    // Customer
    Route::resource('customers', CustomerController::class);
    Route::controller(CustomerController::class)->group(function () {
        Route::get('customers_ban/{customer}', 'ban')->name('customers.ban');
        Route::get('/customers/login/{id}', 'login')->name('customers.login');
        Route::get('/customers/destroy/{id}', 'destroy')->name('customers.destroy');
        Route::post('/bulk-customer-delete', 'bulk_customer_delete')->name('bulk-customer-delete');
    });

    // Newsletter
    Route::controller(NewsletterController::class)->group(function () {
        Route::get('/newsletter', 'index')->name('newsletters.index');
        Route::post('/newsletter/send', 'send')->name('newsletters.send');
        Route::post('/newsletter/test/smtp', 'testEmail')->name('test.smtp');
    });

    Route::resource('profile', ProfileController::class);

    // Business Settings
    Route::controller(BusinessSettingsController::class)->group(function () {
        Route::post('/business-settings/update', 'update')->name('business_settings.update');
        Route::post('/business-settings/update/activation', 'updateActivationSettings')->name('business_settings.update.activation');
        Route::post('/payment-activation', 'updatePaymentActivationSettings')->name('payment.activation');
        Route::get('/general-setting', 'general_setting')->name('general_setting.index');
        Route::get('/activation', 'activation')->name('activation.index');
        Route::get('/payment-method', 'payment_method')->name('payment_method.index');
        Route::get('/file_system', 'file_system')->name('file_system.index');
        Route::get('/smtp-settings', 'smtp_settings')->name('smtp_settings.index');
        Route::get('/google-analytics', 'google_analytics')->name('google_analytics.index');
        Route::get('/google-recaptcha', 'google_recaptcha')->name('google_recaptcha.index');
        Route::get('/google-map', 'google_map')->name('google-map.index');

        //Facebook Settings
        Route::get('/facebook-chat', 'facebook_chat')->name('facebook_chat.index');
        Route::post('/facebook_chat', 'facebook_chat_update')->name('facebook_chat.update');
        Route::get('/facebook-comment', 'facebook_comment')->name('facebook-comment');
        Route::post('/facebook-comment', 'facebook_comment_update')->name('facebook-comment.update');
        Route::post('/facebook_pixel', 'facebook_pixel_update')->name('facebook_pixel.update');

        Route::post('/env_key_update', 'env_key_update')->name('env_key_update.update');
        Route::post('/payment_method_update', 'payment_method_update')->name('payment_method.update');
        Route::post('/google_analytics', 'google_analytics_update')->name('google_analytics.update');
        Route::post('/google_recaptcha', 'google_recaptcha_update')->name('google_recaptcha.update');
        Route::post('/google-map', 'google_map_update')->name('google-map.update');

        //Shipping Configuration
        Route::get('/shipping_configuration', 'shipping_configuration')->name('shipping_configuration.index');
        Route::post('/shipping_configuration/update', 'shipping_configuration_update')->name('shipping_configuration.update');

        // Order Configuration
        Route::get('/order-configuration', 'order_configuration')->name('order_configuration.index');
    });


    //Currency
    Route::controller(CurrencyController::class)->group(function () {
        Route::get('/currency', 'currency')->name('currency.index');
        Route::post('/currency/update', 'updateCurrency')->name('currency.update');
        Route::post('/your-currency/update', 'updateYourCurrency')->name('your_currency.update');
        Route::get('/currency/create', 'create')->name('currency.create');
        Route::post('/currency/store', 'store')->name('currency.store');
        Route::post('/currency/currency_edit', 'edit')->name('currency.edit');
        Route::post('/currency/update_status', 'update_status')->name('currency.update_status');
    });

    //Tax
    Route::resource('tax', TaxController::class);
    Route::controller(TaxController::class)->group(function () {
        Route::get('/tax/edit/{id}', 'edit')->name('tax.edit');
        Route::get('/tax/destroy/{id}', 'destroy')->name('tax.destroy');
        Route::post('tax-status', 'change_tax_status')->name('taxes.tax-status');
    });

    // Language
    Route::resource('/languages', LanguageController::class);
    Route::controller(LanguageController::class)->group(function () {
        Route::post('/languages/{id}/update', 'update')->name('languages.update');
        Route::get('/languages/destroy/{id}', 'destroy')->name('languages.destroy');
        Route::post('/languages/update_rtl_status', 'update_rtl_status')->name('languages.update_rtl_status');
        Route::post('/languages/update-status', 'update_status')->name('languages.update-status');
        Route::post('/languages/key_value_store', 'key_value_store')->name('languages.key_value_store');

        //App Trasnlation
        Route::post('/languages/app-translations/import', 'importEnglishFile')->name('app-translations.import');
        Route::get('/languages/app-translations/show/{id}', 'showAppTranlsationView')->name('app-translations.show');
        Route::post('/languages/app-translations/key_value_store', 'storeAppTranlsation')->name('app-translations.store');
        Route::get('/languages/app-translations/export/{id}', 'exportARBFile')->name('app-translations.export');
    });


    // website setting
    Route::group(['prefix' => 'website'], function () {
        Route::controller(WebsiteController::class)->group(function () {
            Route::get('/pages', 'pages')->name('website.pages');
        });

        // Custom Page
        Route::resource('custom-pages', PageController::class);
        Route::controller(PageController::class)->group(function () {
            Route::get('/custom-pages/edit/{id}', 'edit')->name('custom-pages.edit');
            Route::get('/custom-pages/destroy/{id}', 'destroy')->name('custom-pages.destroy');
        });
    });

    //Subscribers
    Route::controller(SubscriberController::class)->group(function () {
        Route::get('/subscribers', 'index')->name('subscribers.index');
        Route::get('/subscribers/destroy/{id}', 'destroy')->name('subscriber.destroy');
    });

    // Order
    Route::resource('orders', OrderController::class);
    Route::controller(OrderController::class)->group(function () {
        // All Orders
        Route::get('/all_orders', 'all_orders')->name('all_orders.index');
        Route::get('/orders/{id}/show', 'show')->name('all_orders.show');
        Route::get('/orders/destroy/{id}', 'destroy')->name('orders.destroy');
        Route::post('/bulk-order-delete', 'bulk_order_delete')->name('bulk-order-delete');
        Route::get('/orders/destroy/{id}', 'destroy')->name('orders.destroy');
        Route::post('/orders/details', 'order_details')->name('orders.details');
        Route::post('/orders/update_delivery_status', 'update_delivery_status')->name('orders.update_delivery_status');
        Route::post('/orders/update_payment_status', 'update_payment_status')->name('orders.update_payment_status');
    });

    //Blog Section
    //Blog cateory
    Route::resource('blog-category', BlogCategoryController::class);
    Route::get('/blog-category/destroy/{id}', [BlogCategoryController::class, 'destroy'])->name('blog-category.destroy');

    // Blog
    Route::resource('blog', BlogController::class);
    Route::controller(BlogController::class)->group(function () {
        Route::get('/blog/destroy/{id}', 'destroy')->name('blog.destroy');
        Route::post('/blog/change-status', 'change_status')->name('blog.change-status');
    });

    //Coupons
    Route::resource('coupon', CouponController::class);
    Route::controller(CouponController::class)->group(function () {
        Route::post('/coupon/update-status', 'updateStatus')->name('coupon.update_status');
        Route::get('/coupon/destroy/{id}', 'destroy')->name('coupon.destroy');

        //Coupon Form
        Route::post('/coupon/get_form', 'get_coupon_form')->name('coupon.get_coupon_form');
        Route::post('/coupon/get_form_edit', 'get_coupon_form_edit')->name('coupon.get_coupon_form_edit');
    });

    //Reviews
    Route::controller(ReviewController::class)->group(function () {
        Route::get('/reviews', 'index')->name('reviews.index');
        Route::post('/reviews/published', 'updatePublished')->name('reviews.published');
    });

    //Support_Ticket
    Route::controller(SupportTicketController::class)->group(function () {
        Route::get('support_ticket/', 'admin_index')->name('support_ticket.admin_index');
        Route::get('support_ticket/{id}/show', 'admin_show')->name('support_ticket.admin_show');
        Route::post('support_ticket/reply', 'admin_store')->name('support_ticket.admin_store');
    });

    // Countries
    Route::resource('countries', CountryController::class);
    Route::post('/countries/status', [CountryController::class, 'updateStatus'])->name('countries.status');

    // States
    Route::resource('states', StateController::class);
    Route::post('/states/status', [StateController::class, 'updateStatus'])->name('states.status');


    // Zones
    Route::resource('zones', ZoneController::class);
    Route::get('/zones/destroy/{id}', [ZoneController::class, 'destroy'])->name('zones.destroy');

    Route::resource('cities', CityController::class);
    Route::controller(CityController::class)->group(function () {
        Route::get('/cities/edit/{id}', 'edit')->name('cities.edit');
        Route::get('/cities/destroy/{id}', 'destroy')->name('cities.destroy');
        Route::post('/cities/status', 'updateStatus')->name('cities.status');
    });

    // uploaded files
    Route::resource('/uploaded-files', AizUploadController::class);
    Route::controller(AizUploadController::class)->group(function () {
        Route::any('/uploaded-files/file-info', 'file_info')->name('uploaded-files.info');
        Route::get('/uploaded-files/destroy/{id}', 'destroy')->name('uploaded-files.destroy');
        Route::post('/bulk-uploaded-files-delete', 'bulk_uploaded_files_delete')->name('bulk-uploaded-files-delete');
        Route::get('/all-file', 'all_file');
    });

    Route::get('/clear-cache', [AdminController::class, 'clearCache'])->name('cache.clear');
});

