<div class="container" id="cart_details">
    @php
        $cart_count = count($carts);
        $active_carts = $cart_count > 0 ? $carts : [];
    @endphp
    @if( $cart_count > 0 )
        @php
            $total = 0;
            $products = array();
            foreach ($carts as $key => $cartItem){
                $product = get_single_product($cartItem['product_id']);
                array_push($products, $cartItem['product_id']);
            }
        @endphp
        @if (!empty($products))
            @php
                $all_admin_products = true;
                if(count($products) != count($carts->toQuery()->active()->whereIn('product_id', $products)->get())){
                    $all_admin_products = false;
                }
            @endphp
            <div class="row">
                <div class="col-lg-8 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row border-bottom pb-3">
                                <div class="col-5">Product</div>
                                <div class="col-3">Quantity</div>
                                <div class="col-2">Total</div>
                                <div class="col-2">Action</div>
                            </div>
                            @foreach ($products as $key => $product_id)
                                @php
                                    $product = get_single_product($product_id);
                                    $cartItem = $carts->toQuery()->where('product_id', $product_id)->first();
                                    $total = $total + cart_product_price($cartItem, $product, false) * $cartItem->quantity;
                                @endphp
                                <div class="row mb-3 align-items-center">
                                    <div class="col-5">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ uploaded_asset($product->thumbnail_img) }}" class="product-image me-3" alt="{{ $product->getTranslation('name')  }}"
                                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                            <span>{{ $product->getTranslation('name') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="input-group aiz-plus-minus">
                                            <button
                                                class="btn col-auto btn-icon btn-sm btn-light rounded-0"
                                                type="button" data-type="plus"
                                                data-field="quantity[{{ $cartItem->id }}]">
                                                <i class="las la-plus"></i>
                                            </button>
                                            <input type="number" name="quantity[{{ $cartItem->id }}]"
                                                class="col border-0 text-center px-0 fs-14 input-number"
                                                placeholder="1" value="{{ $cartItem['quantity'] }}"
                                                onchange="updateQuantity({{ $cartItem->id }}, this)" style="min-width: 45px;">
                                            <button
                                                class="btn col-auto btn-icon btn-sm btn-light rounded-0"
                                                type="button" data-type="minus"
                                                data-field="quantity[{{ $cartItem->id }}]">
                                                <i class="las la-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-2">{{ cart_product_price($cartItem, $product, true, false) }}</div>
                                    <div class="col-2">
                                        <a href="javascript:void(0)" onclick="removeFromCartView(event, {{ $cartItem->id }})" class="btn btn-icon btn-sm bg-white hov-svg-danger" title="{{ translate('Remove') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12.27" height="16" viewBox="0 0 12.27 16">
                                                <g id="Group_23970" data-name="Group 23970" transform="translate(-1332 -420)">
                                                <path id="Path_28714" data-name="Path 28714" d="M17.9,9.037l-.258,7.8a2.569,2.569,0,0,1-2.577,2.485h-4.9A2.569,2.569,0,0,1,7.587,16.84l-.258-7.8a.645.645,0,0,1,1.289-.043l.258,7.8a1.289,1.289,0,0,0,1.289,1.239h4.9a1.289,1.289,0,0,0,1.289-1.241l.258-7.8a.645.645,0,0,1,1.289.043Zm.852-2.6a.644.644,0,0,1-.644.644H7.122a.644.644,0,1,1,0-1.289h2a.822.822,0,0,0,.82-.74,1.927,1.927,0,0,1,1.922-1.736h1.5a1.927,1.927,0,0,1,1.922,1.736.822.822,0,0,0,.82.74h2a.644.644,0,0,1,.644.644ZM11.058,5.8h3.11A2.126,2.126,0,0,1,14,5.189a.644.644,0,0,0-.64-.58h-1.5a.644.644,0,0,0-.64.58,2.126,2.126,0,0,1-.165.608Zm.649,9.761V10.072a.644.644,0,0,0-1.289,0v5.488a.644.644,0,0,0,1.289,0Zm3.1,0V10.072a.644.644,0,1,0-1.289,0v5.488a.644.644,0,1,0,1.289,0Z" transform="translate(1325.522 416.678)" fill="#9d9da6"/>
                                                </g>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Cart Summary -->
                <div class="col-lg-4 mt-lg-0 mt-4" id="cart_summary">
                    @include('frontend.partials.cart.cart_summary', ['proceed' => 1, 'carts' => $active_carts])
                </div>
            </div>
        @endif
    @else
        <div class="row">
            <div class="col-xl-8 mx-auto">
                <div class="border bg-white p-4">
                    <!-- Empty cart -->
                    <div class="text-center p-3">
                        <i class="las la-frown la-3x opacity-60 mb-3"></i>
                        <h3 class="h4 fw-700">{{translate('Your Cart is empty')}}</h3>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
