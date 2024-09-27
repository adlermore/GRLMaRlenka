@if (count(get_featured_products()) > 0)
    <section class="mb-2 mb-md-3 mt-2 mt-md-3">
        <div class="container">
            <!-- Top Section -->
            <div class="d-flex mb-2 mb-md-3 align-items-baseline justify-content-between">
                <!-- Title -->
                <h3 class="fs-16 fs-md-20 fw-700 mb-2 mb-sm-0">
                    <span class="">{{ translate('Featured Products') }}</span>
                </h3>
            </div>
            <!-- Products Section -->
            <div class="col-12">
                <div class="sm-gutters-16 arrow-none">
                    @foreach (get_featured_products() as $key => $product)
                    <div class="position-relative px-0 has-transition hov-animate-outline">
                        <div class="col-12 col-md-3 col-xl-3">
                            @include('frontend.ui.partials.product_box_1',['product' => $product])
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif
