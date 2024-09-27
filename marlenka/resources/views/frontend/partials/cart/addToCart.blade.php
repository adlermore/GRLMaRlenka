<div class="modal-body px-4 py-5 c-scrollbar-light">
    <div class="row">
        <!-- Product Image gallery -->
        <div class="col-lg-6">
            <div class="row gutters-10 flex-row-reverse">
                @php
                    $photos = explode(',',$product->photos);
                @endphp
                <div class="col">
                    <div class="aiz-carousel carousel-thumb product-gallery-thumb" data-items='5' data-nav-for='.product-gallery' data-vertical='true' data-focus-select='true'>
                        @foreach ($photos as $key => $photo)
                            <div class="carousel-box c-pointer border rounded-0">
                                <img class="lazyload"
                                    src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                    data-src="{{ uploaded_asset($photo) }}"
                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Info -->
        <div class="col-lg-6">
            <div class="text-left">
                <!-- Product name -->
                <h2 class="mb-2 fs-16 fw-700 text-dark">
                    {{  $product->getTranslation('name')  }}
                </h2>

                <!-- Product Price & Club Point -->
                @if(home_price($product) != home_discounted_price($product))
                    <div class="row no-gutters mt-3">
                        <div class="col-3">
                            <div class="text-secondary fs-14 fw-400">{{ translate('Price')}}</div>
                        </div>
                        <div class="col-9">
                            <div class="">
                                <strong class="fs-16 fw-700 text-primary">
                                    {{ home_discounted_price($product) }}
                                </strong>
                                <del class="fs-14 opacity-60 ml-2">
                                    {{ home_price($product) }}
                                </del>
                                @if($product->unit != null)
                                    <span class="opacity-70 ml-1">/{{ $product->getTranslation('unit') }}</span>
                                @endif
                                @if(discount_in_percentage($product) > 0)
                                    <span class="bg-primary ml-2 fs-11 fw-700 text-white w-35px text-center px-2" style="padding-top:2px;padding-bottom:2px;">-{{discount_in_percentage($product)}}%</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row no-gutters mt-3">
                        <div class="col-3">
                            <div class="text-secondary fs-14 fw-400">{{ translate('Price')}}</div>
                        </div>
                        <div class="col-9">
                            <div class="">
                                <strong class="fs-16 fw-700 text-primary">
                                    {{ home_discounted_price($product) }}
                                </strong>
                                @if ($product->unit != null)
                                    <span class="opacity-70">/{{ $product->unit }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                @php
                    $qty = 0;
                @endphp

                <!-- Product Choice options form -->
                <form id="option-choice-form">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">

                    <!-- Quantity -->
                    <div class="row no-gutters mt-3">
                        <div class="col-3">
                            <div class="text-secondary fs-14 fw-400 mt-2">{{ translate('Quantity')}}</div>
                        </div>
                        <div class="col-9">
                            <div class="product-quantity d-flex align-items-center">
                                <div class="row no-gutters align-items-center aiz-plus-minus mr-3" style="width: 130px;">
                                    <button class="btn col-auto btn-icon btn-sm btn-light rounded-0" type="button" data-type="minus" data-field="quantity" disabled="">
                                        <i class="las la-minus"></i>
                                    </button>
                                    <input type="number" name="quantity" class="col border-0 text-center flex-grow-1 fs-16 input-number" placeholder="1" value="{{ $product->min_qty }}" min="{{ $product->min_qty }}" max="10" lang="en">
                                    <button class="btn col-auto btn-icon btn-sm btn-light rounded-0" type="button" data-type="plus" data-field="quantity">
                                        <i class="las la-plus"></i>
                                    </button>
                                </div>
                                <div class="avialable-amount opacity-60">
                                    @if($product->stock_visibility_state == 'quantity')
                                        (<span id="available-quantity">{{ $qty }}</span> {{ translate('available')}})
                                    @elseif($product->stock_visibility_state == 'text' && $qty >= 1)
                                        (<span id="available-quantity">{{ translate('In Stock') }}</span>)
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Price -->
                    <div class="row no-gutters mt-3 pb-3 d-none" id="chosen_price_div">
                        <div class="col-3">
                            <div class="text-secondary fs-14 fw-400 mt-1">{{ translate('Total Price')}}</div>
                        </div>
                        <div class="col-9">
                            <div class="product-price">
                                <strong id="chosen_price" class="fs-20 fw-700 text-primary">

                                </strong>
                            </div>
                        </div>
                    </div>

                </form>

                <!-- Add to cart -->
                <div class="mt-3">
                    @if($qty > 0)
                        @if ($product->external_link != null)
                            <a type="button" class="btn btn-soft-primary rounded-0 mr-2 add-to-cart fw-600" href="{{ $product->external_link }}">
                                <i class="las la-share"></i>
                                <span class="d-none d-md-inline-block">{{ translate($product->external_link_btn)}}</span>
                            </a>
                        @else
                            <button type="button" class="btn btn-primary rounded-0 buy-now fw-600 add-to-cart"
                                @if (Auth::check() || get_Setting('guest_checkout_activation') == 1) onclick="addToCart()" @else onclick="showLoginModal()" @endif
                            >
                                <i class="la la-shopping-cart"></i>
                                <span class="d-none d-md-inline-block">{{ translate('Add to cart')}}</span>
                            </button>
                        @endif
                    @endif
                    <button type="button" class="btn btn-secondary rounded-0 out-of-stock fw-600 d-none" disabled>
                        <i class="la la-cart-arrow-down"></i>{{ translate('Out of Stock')}}
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>

