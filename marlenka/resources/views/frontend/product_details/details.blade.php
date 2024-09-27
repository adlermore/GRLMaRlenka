<div class="text-left">
    <!-- Product Name -->
    <h2 class="mb-4 fs-22" style="color: #B62025">
        {{ $detailedProduct->getTranslation('name') }}
    </h2>

    <p class="fs-20 fw-500">
        Our Classic Honey Cake is scrumptious and healthy.
    </p>

    @if (home_price($detailedProduct) != home_discounted_price($detailedProduct))
        <div class="row no-gutters mb-3">
            <div class="col-sm-12">
                <div class="d-flex align-items-center">
                    <!-- Discount Price -->
                    <strong class="fs-20 fw-700 text-dark">
                        {{ home_discounted_price($detailedProduct) }}
                    </strong>
                    <!-- Home Price -->
                    <del class="fs-18 opacity-60 ml-2">
                        {{ home_price($detailedProduct) }}
                    </del>
                    <!-- Unit -->
                    @if ($detailedProduct->unit != null)
                        <span class="opacity-70 ml-1">/{{ $detailedProduct->getTranslation('unit') }}</span>
                    @endif
                    <!-- Discount percentage -->
                    @if (discount_in_percentage($detailedProduct) > 0)
                        <span class="bg-primary ml-2 fs-11 fw-700 text-white w-35px text-center p-1"
                              style="padding-top:2px;padding-bottom:2px;">-{{ discount_in_percentage($detailedProduct) }}%</span>
                    @endif
                </div>
            </div>
        </div>
    @else
        <div class="row no-gutters mb-3">
            <div class="col-sm-12">
                <div class="d-flex align-items-center">
                    <!-- Discount Price -->
                    <strong class="fs-20 fw-700 text-dark">
                        {{ home_discounted_price($detailedProduct) }}
                    </strong>
                    <!-- Unit -->
                    @if ($detailedProduct->unit != null)
                        <span class="opacity-70">/{{ $detailedProduct->getTranslation('unit') }}</span>
                    @endif
                </div>
            </div>
        </div>
    @endif

    <form id="option-choice-form">
        @csrf
        <input type="hidden" name="id" value="{{ $detailedProduct->id }}">
        <!-- Quantity + Add to cart -->
        <div class="row no-gutters mb-3 pt-3 pb-3">
            <div class="col-sm-3">
                <div class="product-quantity border-dashed border">
                    <div class="row no-gutters align-items-center aiz-plus-minus">
                        <button class="btn col-auto btn-icon btn-sm btn-light bg-transparent border-0" type="button"
                                data-type="minus" data-field="quantity" disabled="">
                            <i class="las la-minus"></i>
                        </button>
                        <input type="number" name="quantity"
                               class="col border-0 text-center flex-grow-1 fs-16 input-number bg-transparent" placeholder="1"
                               value="1" min="1"
                               max="10" lang="en">
                        <button class="btn col-auto btn-icon btn-sm btn-light bg-transparent border-0" type="button"
                                data-type="plus" data-field="quantity">
                            <i class="las la-plus"></i>
                        </button>
                    </div>
                    @php
                        $qty = 0;
                        if(!empty($detailedProduct->stocks))
                            foreach ($detailedProduct->stocks as $key => $stock) {
                                $qty += $stock->qty;
                            }
                    @endphp
                    <div class="avialable-amount opacity-60">
                        @if ($detailedProduct->stock_visibility_state == 'quantity')
                            (<span id="available-quantity">{{ $qty }}</span>
                            {{ translate('available') }})
                        @elseif($detailedProduct->stock_visibility_state == 'text' && $qty >= 1)
                            (<span id="available-quantity">{{ translate('In Stock') }}</span>)
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Price -->
        <div class="row no-gutters pb-3 d-none" id="chosen_price_div">
            <div class="col-sm-2">
                <div class="text-secondary fs-14 fw-400 mt-1">{{ translate('Total Price') }}</div>
            </div>
            <div class="col-sm-10">
                <div class="product-price">
                    <strong id="chosen_price" class="fs-20 fw-700 text-primary">

                    </strong>
                </div>
            </div>
        </div>

    </form>
    <!-- Add to cart & Buy now Buttons -->
    <div class="mt-3">
        <button type="button"
                class="btn btn-secondary-base mr-2 add-to-cart fw-600 min-w-170px text-white"
                @if (Auth::check() || get_Setting('guest_checkout_activation') == 1) onclick="addToCart()" @else onclick="showLoginModal()" @endif>
            <i class="las la-shopping-bag"></i> {{ translate('Add to cart') }}
        </button>
    </div>
</div>
