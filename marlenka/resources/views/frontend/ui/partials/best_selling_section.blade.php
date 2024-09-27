@php
    $best_selling_products = get_best_selling_products(4);
@endphp
@if (get_setting('best_selling') == 1 && count($best_selling_products) > 0)
    <section class="mb-2 mb-md-3 mt-2 mt-md-3 best-sellers-section">
        <div class="container">
            <!-- Top Section -->
            <div class="">
                <!-- Title -->
                <h3 class="fs-16 fs-md-20 fw-700 mb-2 mb-sm-0 text-center">
                    <span class="best-sellers-title">{{ translate('Best Sellers') }}</span>
                </h3>
            </div>
            <!-- Product Section -->
            <div class="px-sm-3 best-sellers-container">
                <div class="sm-gutters-16 arrow-none row">
                    @foreach ($best_selling_products as $key => $product)
                        <div class="px-3 col-12 col-md-3 col-xl-3 position-relative has-transition hov-animate-outline">
                            @include('frontend.ui.partials.product_box_1',['product' => $product])
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif
