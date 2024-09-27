<div class="also-like pb-5">
    <div class="container additional pb-4">
        <div class="row gutters-16">
            <!-- Right side -->
            <div class="col-lg-12">
                <div class="p-5 fs-22 fw-400 text-center text-uppercase">
                    {{ translate('You may also like') }}
                </div>
                <div class="px-3">
                    <div class="row gutters-16 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-4 row-cols-md-3 row-cols-2">
                        @foreach (get_best_selling_products(6, $detailedProduct->user_id) as $key => $product)
                            <div class="col product-wrapper z-1">
                                @include('frontend.ui.partials.product_box_1',['product' => $product])
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
