@php
    $cart_added = [];
@endphp
<div class="h-auto">
    <div class="position-relative img-fit d-flex">
        @php
            $product_url = route('product', $product->slug);
        @endphp
        <!-- Image -->
        <a href="{{ $product_url }}" class="d-block h-100 w-100">
            <img class="lazyload mx-auto img-fit has-transition"
                src="{{ get_image($product->thumbnail) }}"
                alt="{{ $product->getTranslation('name') }}" title="{{ $product->getTranslation('name') }}"
                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
            <div class="p-2 p-md-3 text-left">
                <!-- Product name -->
                <h3 class="text-center product-title">
                    {{ $product->getTranslation('name') }}
                </h3>
                <div class="fs-14 d-flex flex-column align-items-center justify-content-center mt-3">
                    <!-- Previous price -->
                    @if (home_base_price($product) != home_discounted_base_price($product))
                        <div class="disc-amount has-transition">
                            <del class="product-price">{{ home_base_price($product) }}</del>
                        </div>
                    @endif
                    <!-- price -->
                    <div class="">
                        <span class="product-price">{{ home_discounted_base_price($product) }}</span>
                    </div>
                </div>
            </div>
        </a>

        <!-- Discount percentage tag -->
        @if (discount_in_percentage($product) > 0)
            <span class="absolute-top-left bg-primary ml-1 mt-1 fs-11 fw-700 text-white w-35px text-center"
                style="padding-top:2px;padding-bottom:2px;">-{{ discount_in_percentage($product) }}%</span>
        @endif

        <div class="aiz-p-hov-icon">
            <a href="javascript:void(0)" class="hov-svg-white" onclick="addToWishList({{ $product->id }})"
               data-toggle="tooltip" data-title="{{ translate('Add to wishlist') }}" data-placement="left" style="background: none; box-shadow: none">
                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/3df8a4a4481f063a699b24a49f87d249eabf7eb2deb45c281aca295ea8f323b3?placeholderIfAbsent=true&apiKey=c74a7b05657b4cd68a28df5d434b4e2c" alt="Favorite" class="product-favorite">
                {{--<svg xmlns="http://www.w3.org/2000/svg" width="16" height="14.4" viewBox="0 0 16 14.4">
                    <g id="_51a3dbe0e593ba390ac13cba118295e4" data-name="51a3dbe0e593ba390ac13cba118295e4"
                       transform="translate(-3.05 -4.178)">
                        <path id="Path_32649" data-name="Path 32649"
                              d="M11.3,5.507l-.247.246L10.8,5.506A4.538,4.538,0,1,0,4.38,11.919l.247.247,6.422,6.412,6.422-6.412.247-.247A4.538,4.538,0,1,0,11.3,5.507Z"
                              transform="translate(0 0)" fill="#C17E2E" />
                        <path id="Path_32650" data-name="Path 32650"
                              d="M11.3,5.507l-.247.246L10.8,5.506A4.538,4.538,0,1,0,4.38,11.919l.247.247,6.422,6.412,6.422-6.412.247-.247A4.538,4.538,0,1,0,11.3,5.507Z"
                              transform="translate(0 0)" fill="#C17E2E" />
                    </g>
                </svg>--}}
            </a>
            <a class="cart-btn hov-svg-white @if (in_array($product->id, $cart_added)) active @endif"
               href="javascript:void(0)"
               onclick="showAddToCartModal({{ $product->id }})" style="background: none; box-shadow: none">
                <span><img src="https://cdn.builder.io/api/v1/image/assets/TEMP/3143b59d99941026b2689de835f0088c0941570820cb39afb1d9b35400255b83?placeholderIfAbsent=true&apiKey=c74a7b05657b4cd68a28df5d434b4e2c" alt="Rating" class="product-rating">{{--<i class="las la-2x la-shopping-cart" style="color: #C17E2E"></i>--}}</span>
            </a>
        </div>
    </div>
</div>
