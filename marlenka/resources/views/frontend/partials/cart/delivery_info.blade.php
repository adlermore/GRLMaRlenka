@php
    $admin_products = array();
    $admin_product_variation = array();
    foreach ($carts as $key => $cartItem){
        $product = get_single_product($cartItem['product_id']);
        array_push($admin_products, $cartItem['product_id']);
    }
@endphp

<!-- Inhouse Products -->
@if (!empty($admin_products))
    <div class="card mb-3 border-left-0 border-top-0 border-right-0 border-bottom rounded-0 shadow-none">
        <div class="card-header py-3 px-0 border-left-0 border-top-0 border-right-0 border-bottom border-dashed">
            <h5 class="fs-16 fw-700 text-dark mb-0">{{ get_setting('site_name') }} {{ translate('Inhouse Products') }} ({{ sprintf("%02d", count($admin_products)) }})</h5>
        </div>
        <div class="card-body p-0">
            @include('frontend.partials.cart.delivery_info_details', ['products' => $admin_products, 'owner_id' => get_admin()->id ])
        </div>
    </div>
@endif
