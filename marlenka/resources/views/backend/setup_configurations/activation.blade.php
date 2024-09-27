@extends('backend.layouts.app')

@section('content')
    <h4 class="text-center text-muted">{{ translate('System') }}</h4>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6 text-center">{{ translate('HTTPS Activation') }}</h5>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'FORCE_HTTPS')" <?php if (env('FORCE_HTTPS') == 'On') {
                            echo 'checked';
                        } ?>>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6 text-center">{{ translate('Maintenance Mode Activation') }}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'maintenance_mode')" <?php if (get_setting('maintenance_mode') == 1) {
                            echo 'checked';
                        } ?>>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6 text-center">{{ translate('Disable image encoding?') }}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'disable_image_optimization')"
                            <?php if (get_setting('disable_image_optimization') == 1) {
                                echo 'checked';
                            } ?>>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
    </div>


    <h4 class="text-center text-muted mt-4">{{ translate('Business Related') }}</h4>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6 text-center">{{ translate('Wallet System Activation') }}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'wallet_system')" <?php if (get_setting('wallet_system') == 1) {
                            echo 'checked';
                        } ?>>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6 text-center">{{ translate('Coupon System Activation') }}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'coupon_system')" <?php if (get_setting('coupon_system') == 1) {
                            echo 'checked';
                        } ?>>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6 text-center">{{ translate('Seller Product Manage By Admin') }}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'product_manage_by_admin')"
                            <?php if (\App\Models\BusinessSetting::where('type', 'product_manage_by_admin')->first() && get_setting('product_manage_by_admin') == 1) {
                                echo 'checked';
                            } ?>>
                        <span class="slider round"></span>
                    </label>
                    <div class="alert"
                        style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                        {{ translate('After activate this option Cash On Delivery of Seller product will be managed by Admin') }}.
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6 text-center">{{ translate('Admin Approval On Seller Product') }}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'product_approve_by_admin')"
                            <?php if (\App\Models\BusinessSetting::where('type', 'product_approve_by_admin')->first() && get_setting('product_approve_by_admin') == 1) {
                                echo 'checked';
                            } ?>>
                        <span class="slider round"></span>
                    </label>
                    <div class="alert"
                        style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                        {{ translate('After activate this option, Admin approval need to seller product') }}.
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6 text-center">{{ translate('Email Verification') }}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'email_verification')" <?php if (get_setting('email_verification') == 1) {
                            echo 'checked';
                        } ?>>
                        <span class="slider round"></span>
                    </label>
                    <div class="alert"
                        style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                        {{ translate('You need to configure SMTP correctly to enable this feature.') }} <a
                            href="{{ route('smtp_settings.index') }}">{{ translate('Configure Now') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6 text-center">{{ translate('Product Query Activation') }}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'product_query_activation')"
                            <?php if (get_setting('product_query_activation') == 1) {
                                echo 'checked';
                            } ?>>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6 text-center">{{ translate('Last Viewed Products Activation') }}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'last_viewed_product_activation')"
                            <?php if (get_setting('last_viewed_product_activation') == 1) {
                                echo 'checked';
                            } ?>>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6 text-center">{{ translate('Guest Checkout Activation') }}</h3>
                </div>
                <div class="card-body text-center">
                    <label class="aiz-switch aiz-switch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'guest_checkout_activation')"
                            <?php if (get_setting('guest_checkout_activation') == 1) {
                                echo 'checked';
                            } ?>>
                        <span class="slider round"></span>
                    </label>
                    <div class="alert"
                        style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                        {{ translate('You need to configure SMTP correctly to enable this feature.') }}
                        <a href="{{ route('smtp_settings.index') }}">{{ translate('Configure Now') }}</a>
                    </div>
                </div>
            </div>
        </div>

        @if (addon_is_activated('wholesale'))
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0 h6 text-center">{{ translate('Wholesale Product for Seller') }}</h3>
                    </div>
                    <div class="card-body text-center">
                        <label class="aiz-switch aiz-switch-success mb-0">
                            <input type="checkbox" onchange="updateSettings(this, 'seller_wholesale_product')"
                                <?php if (get_setting('seller_wholesale_product') == 1) {
                                    echo 'checked';
                                } ?>>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </div>
        @endif
        @if (addon_is_activated('auction'))
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0 h6 text-center">{{ translate('Auction Product for Seller') }}</h3>
                    </div>
                    <div class="card-body text-center">
                        <label class="aiz-switch aiz-switch-success mb-0">
                            <input type="checkbox" onchange="updateSettings(this, 'seller_auction_product')"
                                <?php if (get_setting('seller_auction_product') == 1) {
                                    echo 'checked';
                                } ?>>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        function updateSettings(el, type) {

            if('{{env('DEMO_MODE')}}' == 'On'){
                AIZ.plugins.notify('info', '{{ translate('Data can not change in demo mode.') }}');
                return;
            }

            if ($(el).is(':checked')) {
                var value = 1;
            } else {
                var value = 0;
            }

            $.post('{{ route('business_settings.update.activation') }}', {
                _token: '{{ csrf_token() }}',
                type: type,
                value: value
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{ translate('Settings updated successfully') }}');
                } else {
                    AIZ.plugins.notify('danger', 'Something went wrong');
                }
            });
        }
    </script>
@endsection
