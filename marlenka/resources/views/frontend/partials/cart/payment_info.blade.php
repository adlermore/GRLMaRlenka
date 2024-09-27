<div class="mb-4">
    <h3 class="fs-16 fw-700 text-dark">
        {{ translate('Any additional info?') }}
    </h3>
    <textarea name="additional_info" rows="5" class="form-control rounded-0"
        placeholder="{{ translate('Type your text...') }}"></textarea>
</div>
<div>
    <h3 class="fs-16 fw-700 text-dark">
        {{ translate('Select a payment option') }}
    </h3>
    <div class="row gutters-10">
        @foreach (get_activate_payment_methods() as $payment_method)
            <div class="col-xl-4 col-md-6">
                <label class="aiz-megabox d-block mb-3">
                    <input value="{{ $payment_method->name }}" class="online_payment" type="radio"
                        name="payment_option" checked>
                    <span class="d-flex align-items-center justify-content-between aiz-megabox-elem rounded-0 p-3">
                        <span class="d-block fw-400 fs-14">{{ ucfirst(translate($payment_method->name)) }}</span>
                        <span class="rounded-1 h-40px overflow-hidden">
                            <img src="{{ static_asset('assets/img/cards/'.$payment_method->name.'.png') }}"
                            class="img-fit h-100">
                        </span>
                    </span>
                </label>
            </div>
        @endforeach

        <!-- Cash Payment -->
        @if (get_setting('cash_payment') == 1)
            @php
                $cod_on = 1;
                foreach ($carts as $cartItem) {
                    $product = get_single_product($cartItem['product_id']);
                    if ($product['cash_on_delivery'] == 0) {
                        $cod_on = 0;
                    }
                }
            @endphp
            @if ($cod_on == 1)
                <div class="col-xl-4 col-md-6">
                    <label class="aiz-megabox d-block mb-3">
                        <input value="cash_on_delivery" class="online_payment" type="radio"
                            name="payment_option" checked>
                        <span class="d-flex align-items-center justify-content-between aiz-megabox-elem rounded-0 p-3">
                            <span class="d-block fw-400 fs-14">{{ translate('Cash on Delivery') }}</span>
                            <span class="rounded-1 h-40px w-70px overflow-hidden">
                                <img src="{{ static_asset('assets/img/cards/cod.png') }}"
                                class="img-fit h-100">
                            </span>
                        </span>
                    </label>
                </div>
            @endif
        @endif

    </div>
</div>
