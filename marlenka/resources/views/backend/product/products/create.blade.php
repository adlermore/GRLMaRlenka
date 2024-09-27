@extends('backend.layouts.app')

@section('content')

<div class="page-content">
    <div class="aiz-titlebar text-left mt-2 pb-2 px-3 px-md-2rem border-bottom border-gray">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="h3">{{ translate('Add New Product') }}</h1>
            </div>
            <div class="col text-right">
                <a class="btn btn-xs btn-soft-primary" href="javascript:void(0);" onclick="clearTempdata()">
                    {{ translate('Clear Tempdata') }}
                </a>
            </div>
            {{-- <div class="col text-right">
                <a class="btn has-transition btn-xs p-0 hov-svg-danger" href="{{ route('home') }}"
                    target="_blank" data-toggle="tooltip" data-placement="top" data-title="{{ translate('View Tutorial Video') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19.887" height="16" viewBox="0 0 19.887 16">
                        <path id="_42fbab5a39cb8436403668a76e5a774b" data-name="42fbab5a39cb8436403668a76e5a774b" d="M18.723,8H5.5A3.333,3.333,0,0,0,2.17,11.333v9.333A3.333,3.333,0,0,0,5.5,24h13.22a3.333,3.333,0,0,0,3.333-3.333V11.333A3.333,3.333,0,0,0,18.723,8Zm-3.04,8.88-5.47,2.933a1,1,0,0,1-1.473-.88V13.067a1,1,0,0,1,1.473-.88l5.47,2.933a1,1,0,0,1,0,1.76Zm-5.61-3.257L14.5,16l-4.43,2.377Z" transform="translate(-2.17 -8)" fill="#9da3ae"/>
                    </svg>
                </a>
            </div> --}}
        </div>
    </div>

    <div class="d-sm-flex">
        <!-- page side nav -->
        <div class="page-side-nav c-scrollbar-light px-3 py-2">
            <ul class="nav nav-tabs flex-sm-column border-0" role="tablist" aria-orientation="vertical">
                <!-- General -->
                <li class="nav-item">
                    <a class="nav-link" id="general-tab" href="#general"
                        data-toggle="tab" data-target="#general" type="button" role="tab" aria-controls="general" aria-selected="true">
                        {{ translate('General') }}
                    </a>
                </li>
                <!-- Files & Media -->
                <li class="nav-item">
                    <a class="nav-link" id="files-and-media-tab" href="#files_and_media"
                        data-toggle="tab" data-target="#files_and_media" type="button" role="tab" aria-controls="files_and_media" aria-selected="false">
                        {{ translate("Files & Media") }}
                    </a>
                </li>
                <!-- Price & Stock -->
                <li class="nav-item">
                    <a class="nav-link" id="price-and-stocks-tab" href="#price_and_stocks"
                        data-toggle="tab" data-target="#price_and_stocks" type="button" role="tab" aria-controls="price_and_stocks" aria-selected="false">
                        {{ translate('Price & Stock') }}
                    </a>
                </li>
                <!-- SEO -->
                <li class="nav-item">
                    <a class="nav-link" id="seo-tab" href="#seo"
                        data-toggle="tab" data-target="#seo" type="button" role="tab" aria-controls="seo" aria-selected="false">
                        {{ translate('SEO') }}
                    </a>
                </li>
                <!-- Shipping -->
                <li class="nav-item">
                    <a class="nav-link" id="shipping-tab" href="#shipping"
                        data-toggle="tab" data-target="#shipping" type="button" role="tab" aria-controls="shipping" aria-selected="false">
                        {{ translate('Shipping') }}
                    </a>
                </li>

                <!-- Frequently Bought Product -->
                <li class="nav-item">
                    <a class="nav-link" id="frequenty-bought-product-tab" href="#frequenty-bought-product"
                        data-toggle="tab" data-target="#frequenty-bought-product" type="button" role="tab" aria-controls="frequenty-bought-product" aria-selected="false">
                        {{ translate('Frequently Bought') }}
                    </a>
                </li>

                <!-- Frequently Bought Product -->
                <li class="nav-item">
                    <a class="nav-link" id="specifications-product-tab" href="#specifications-product"
                        data-toggle="tab" data-target="#specifications-product" type="button" role="tab" aria-controls="specifications-product" aria-selected="false">
                        {{ translate('Specifications') }}
                    </a>
                </li>
            </ul>
        </div>

        <!-- tab content -->
        <div class="flex-grow-1 p-sm-3 p-lg-2rem mb-2rem mb-md-0">
            <!-- Error Meassages -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Data type -->
            <input type="hidden" id="data_type" value="physical">

            <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data" enctype="multipart/form-data" id="choice_form">
                @csrf
                <div class="tab-content">
                    <!-- General -->
                    <div class="tab-pane fade" id="general" role="tabpanel" aria-labelledby="general-tab">
                        <div class="bg-white p-3 p-sm-2rem">
                            <!-- Product Information -->
                            <h5 class="mb-3 pb-3 fs-17 fw-700" style="border-bottom: 1px dashed #e4e5eb;">{{translate('Product Information')}}</h5>
                            <div class="w-100">
                                <div class="row">
                                    <div class="col-xxl-7 col-xl-6">
                                        <!-- Product Name -->
                                        <div class="form-group row">
                                            <label class="col-xxl-3 col-from-label fs-13">{{translate('Product Name')}} <span class="text-danger">*</span></label>
                                            <div class="col-xxl-9">
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="{{ translate('Product Name') }}" onchange="update_sku()" required>
                                            </div>
                                        </div>
                                        <!-- Brand -->
                                        <div class="form-group row" id="brand">
                                            <label class="col-xxl-3 col-from-label fs-13">{{translate('Brand')}}</label>
                                            <div class="col-xxl-9">
                                                <select class="form-control aiz-selectpicker" name="brand_id" id="brand_id" data-live-search="true">
                                                    <option value="">{{ translate('Select Brand') }}</option>
                                                    @foreach (\App\Models\Brand::all() as $brand)
                                                    <option value="{{ $brand->id }}" @selected(old('brand_id') == $brand->id)>{{ $brand->getTranslation('name') }}</option>
                                                    @endforeach
                                                </select>
                                                <small class="text-muted">{{translate("You can choose a brand if you'd like to display your product by brand.")}}</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Product Category -->
                                    <div class="col-xxl-5 col-xl-6">
                                        <div class="card @if($errors->has('category_ids') || $errors->has('category_id')) border border-danger @endif">
                                            <div class="card-header">
                                                <h5 class="mb-0 h6">{{ translate('Product Category') }}</h5>
                                                <h6 class="float-right fs-13 mb-0">
                                                    {{ translate('Select Main') }}
                                                    <span class="position-relative main-category-info-icon">
                                                        <i class="las la-question-circle fs-18 text-info"></i>
                                                        <span class="main-category-info bg-soft-info p-2 position-absolute d-none border">{{ translate('This will be used for commission based calculations and homepage category wise product Show.') }}</span>
                                                    </span>
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="h-300px overflow-auto c-scrollbar-light">
                                                    <ul class="hummingbird-treeview-converter list-unstyled" data-checkbox-name="category_ids[]" data-radio-name="category_id">
                                                        @foreach ($categories as $category)
                                                        <li id="{{ $category->id }}">{{ $category->getTranslation('name') }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="form-group">
                                    <label class="fs-13">{{translate('Description')}}</label>
                                    <div class="">
                                        <textarea class="aiz-text-editor" name="description">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Status -->
                            <h5 class="mb-3 mt-5 pb-3 fs-17 fw-700" style="border-bottom: 1px dashed #e4e5eb;">{{translate('Status')}}</h5>
                            <div class="w-100">
                                <!-- Featured -->
                                <div class="form-group row">
                                    <label class="col-md-3 col-from-label">{{translate('Featured')}}</label>
                                    <div class="col-md-9">
                                        <label class="aiz-switch aiz-switch-success mb-0 d-block">
                                            <input type="checkbox" name="featured" value="1">
                                            <span></span>
                                        </label>
                                        <small class="text-muted">{{ translate('If you enable this, this product will be granted as a featured product.') }}</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Vat & TAX -->
                            <h5 class="mb-3 mt-4 pb-3 fs-17 fw-700" style="border-bottom: 1px dashed #e4e5eb;">{{translate('Vat & TAX')}}</h5>
                            <div class="w-100">
                                @foreach(\App\Models\Tax::where('tax_status', 1)->get() as $tax)
                                    <label for="name">
                                        {{$tax->name}}
                                        <input type="hidden" value="{{$tax->id}}" name="tax_id[]">
                                    </label>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input type="number" lang="en" min="0" value="0" step="0.01" placeholder="{{ translate('Tax') }}" name="tax[]" class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <select class="form-control aiz-selectpicker" name="tax_type[]">
                                                <option value="amount">{{translate('Flat')}}</option>
                                                <option value="percent">{{translate('Percent')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Files & Media -->
                    <div class="tab-pane fade" id="files_and_media" role="tabpanel" aria-labelledby="files-and-media-tab">
                        <div class="bg-white p-3 p-sm-2rem">
                            <!-- Product Files & Media -->
                            <h5 class="mb-3 pb-3 fs-17 fw-700" style="border-bottom: 1px dashed #e4e5eb;">{{translate('Product Files & Media')}}</h5>
                            <div class="w-100">
                                <!-- Gallery Images -->
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('Gallery Images')}}</label>
                                    <div class="col-md-9">
                                        <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                            </div>
                                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                            <input type="hidden" name="photos" class="selected-files">
                                        </div>
                                        <div class="file-preview box sm">
                                        </div>
                                        <small class="text-muted">{{translate('These images are visible in product details page gallery. Minimum dimensions required: 900px width X 900px height.')}}</small>
                                    </div>
                                </div>
                                <!-- Thumbnail Image -->
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('Thumbnail Image')}}</label>
                                    <div class="col-md-9">
                                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                            </div>
                                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                            <input type="hidden" name="thumbnail_img" class="selected-files">
                                        </div>
                                        <div class="file-preview box sm">
                                        </div>
                                        <small class="text-muted">{{translate("This image is visible in all product box. Minimum dimensions required: 195px width X 195px height. Keep some blank space around main object of your image as we had to crop some edge in different devices to make it responsive.")}}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Price & Stock -->
                    <div class="tab-pane fade" id="price_and_stocks" role="tabpanel" aria-labelledby="price-and-stocks-tab">
                        <div class="bg-white p-3 p-sm-2rem">
                            <!-- tab Title -->
                            <h5 class="mb-3 pb-3 fs-17 fw-700" style="border-bottom: 1px dashed #e4e5eb;">{{translate('Product price')}}</h5>
                            <div class="w-100">
                                <!-- Unit price -->
                                <div class="form-group row">
                                    <label class="col-md-3 col-from-label">{{translate('Unit price')}} <span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input type="number" lang="en" min="0" value="0" step="0.01" placeholder="{{ translate('Unit price') }}" name="unit_price" class="form-control @error('unit_price') is-invalid @enderror">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SEO -->
                    <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                        <div class="bg-white p-3 p-sm-2rem">
                            <!-- tab Title -->
                            <h5 class="mb-3 pb-3 fs-17 fw-700" style="border-bottom: 1px dashed #e4e5eb;">{{translate('SEO Meta Tags')}}</h5>
                            <div class="w-100">
                                <!-- Meta Title -->
                                <div class="form-group row">
                                    <label class="col-md-3 col-from-label">{{translate('Meta Title')}}</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="meta_title" value="{{ old('meta_title') }}" placeholder="{{ translate('Meta Title') }}">
                                    </div>
                                </div>
                                <!-- Description -->
                                <div class="form-group row">
                                    <label class="col-md-3 col-from-label">{{translate('Description')}}</label>
                                    <div class="col-md-9">
                                        <textarea name="meta_description" rows="8" class="form-control">{{ old('meta_description') }}</textarea>
                                    </div>
                                </div>
                                <!--Meta Image -->
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="signinSrEmail">{{ translate('Meta Image') }}</label>
                                    <div class="col-md-9">
                                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                            </div>
                                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                            <input type="hidden" name="meta_img" class="selected-files">
                                        </div>
                                        <div class="file-preview box sm">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Shipping -->
                    <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
                        <div class="bg-white p-3 p-sm-2rem">
                            <!-- Shipping Configuration -->
                            <h5 class="mb-3 pb-3 fs-17 fw-700" style="border-bottom: 1px dashed #e4e5eb;">{{translate('Shipping Configuration')}}</h5>
                            <div class="w-100">
                                <!-- Cash On Delivery -->
                                @if (get_setting('cash_payment') == '1')
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">{{translate('Cash On Delivery')}}</label>
                                        <div class="col-md-9">
                                            <label class="aiz-switch aiz-switch-success mb-0">
                                                <input type="checkbox" name="cash_on_delivery" value="1" checked="">
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                @else
                                    <p>
                                        {{ translate('Cash On Delivery option is disabled. Activate this feature from here') }}
                                        <a href="{{route('activation.index')}}" class="aiz-side-nav-link {{ areActiveRoutes(['shipping_configuration.index','shipping_configuration.edit','shipping_configuration.update'])}}">
                                            <span class="aiz-side-nav-text">{{translate('Cash Payment Activation')}}</span>
                                        </a>
                                    </p>
                                @endif

                                @if (get_setting('shipping_type') == 'product_wise_shipping')
                                <!-- Free Shipping -->
                                <div class="form-group row">
                                    <label class="col-md-3 col-from-label">{{translate('Free Shipping')}}</label>
                                    <div class="col-md-9">
                                        <label class="aiz-switch aiz-switch-success mb-0">
                                            <input type="radio" name="shipping_type" value="free" checked>
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                                <!-- Flat Rate -->
                                <div class="form-group row">
                                    <label class="col-md-3 col-from-label">{{translate('Flat Rate')}}</label>
                                    <div class="col-md-9">
                                        <label class="aiz-switch aiz-switch-success mb-0">
                                            <input type="radio" name="shipping_type" value="flat_rate">
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                                <!-- Shipping cost -->
                                <div class="flat_rate_shipping_div" style="display: none">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">{{translate('Shipping cost')}}</label>
                                        <div class="col-md-9">
                                            <input type="number" lang="en" min="0" value="0" step="0.01" placeholder="{{ translate('Shipping cost') }}" name="flat_shipping_cost" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <!-- Is Product Quantity Mulitiply -->
                                <div class="form-group row">
                                    <label class="col-md-3 col-from-label">{{translate('Is Product Quantity Mulitiply')}}</label>
                                    <div class="col-md-9">
                                        <label class="aiz-switch aiz-switch-success mb-0">
                                            <input type="checkbox" name="is_quantity_multiplied" value="1">
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                                @else
                                <p>
                                    {{ translate('Product wise shipping cost is disable. Shipping cost is configured from here') }}
                                    <a href="{{route('shipping_configuration.index')}}" class="aiz-side-nav-link {{ areActiveRoutes(['shipping_configuration.index','shipping_configuration.edit','shipping_configuration.update'])}}">
                                        <span class="aiz-side-nav-text">{{translate('Shipping Configuration')}}</span>
                                    </a>
                                </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Save Button -->
                    <div class="mt-4 text-right">
                        <button type="submit" name="button" value="unpublish" class="mx-2 btn btn-light w-230px btn-md rounded-2 fs-14 fw-700 shadow-secondary border-soft-secondary action-btn">{{ translate('Save & Unpublish') }}</button>
                        <button type="submit" name="button" value="publish" class="mx-2 btn btn-success w-230px btn-md rounded-2 fs-14 fw-700 shadow-success action-btn">{{ translate('Save & Publish') }}</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('modal')
	<!-- Frequently Bought Product Select Modal -->
    @include('modals.product_select_modal')
@endsection

@section('script')

<!-- Treeview js -->
<script src="{{ static_asset('assets/js/hummingbird-treeview.js') }}"></script>

<script type="text/javascript">

    $(document).ready(function() {
        $("#treeview").hummingbird();

        var main_id = '{{ old("category_id") }}';
        var selected_ids = [];
        @if(old("category_ids"))
            selected_ids = @json(old("category_ids"));
        @endif
        for (let i = 0; i < selected_ids.length; i++) {
            const element = selected_ids[i];
            $('#treeview input:checkbox#'+element).prop('checked',true);
            $('#treeview input:checkbox#'+element).parents( "ul" ).css( "display", "block" );
            $('#treeview input:checkbox#'+element).parents( "li" ).children('.las').removeClass( "la-plus" ).addClass('la-minus');
        }

        if(main_id){
            $('#treeview input:radio[value='+main_id+']').prop('checked',true);
        }

        $('#treeview input:checkbox').on("click", function (){
            let $this = $(this);
            if ($this.prop('checked') && ($('#treeview input:radio:checked').length == 0)) {
                let val = $this.val();
                $('#treeview input:radio[value='+val+']').prop('checked',true);
            }
        });
    });

    $('form').bind('submit', function (e) {
		if ( $(".action-btn").attr('attempted') == 'true' ) {
			//stop submitting the form because we have already clicked submit.
			e.preventDefault();
		}
		else {
			$(".action-btn").attr("attempted", 'true');
		}
    });

    $("[name=shipping_type]").on("change", function (){
        $(".flat_rate_shipping_div").hide();

        if($(this).val() == 'flat_rate'){
            $(".flat_rate_shipping_div").show();
        }

    });

    $('input[name="unit_price"]').on('keyup', function() {
        update_sku();
    });

    $('input[name="name"]').on('keyup', function() {
        update_sku();
    });

    function delete_row(em){
        $(em).closest('.form-group row').remove();
        update_sku();
    }

    function fq_bought_product_selection_type(){
        var productSelectionType = $("input[name='frequently_bought_selection_type']:checked").val();
        if(productSelectionType == 'product'){
            $('.fq_bought_select_product_div').removeClass('d-none');
            $('.fq_bought_select_category_div').addClass('d-none');
        }
        else if(productSelectionType == 'category'){
            $('.fq_bought_select_category_div').removeClass('d-none');
            $('.fq_bought_select_product_div').addClass('d-none');
        }
    }

    function showFqBoughtProductModal() {
        $('#fq-bought-product-select-modal').modal('show', {backdrop: 'static'});
    }

    function filterFqBoughtProduct() {
        var searchKey = $('input[name=search_keyword]').val();
        var fqBroughCategory = $('select[name=fq_brough_category]').val();
        $.post('{{ route('product.search') }}', { _token: AIZ.data.csrf, product_id: null, search_key:searchKey, category:fqBroughCategory, product_type:"physical" }, function(data){
            $('#product-list').html(data);
            AIZ.plugins.sectionFooTable('#product-list');
        });
    }

    function addFqBoughtProduct() {
        var selectedProducts = [];
        $("input:checkbox[name=fq_bought_product_id]:checked").each(function() {
            selectedProducts.push($(this).val());
        });

        var fqBoughtProductIds = [];
        $("input[name='fq_bought_product_ids[]']").each(function() {
            fqBoughtProductIds.push($(this).val());
        });

        var productIds = selectedProducts.concat(fqBoughtProductIds.filter((item) => selectedProducts.indexOf(item) < 0))

        $.post('{{ route('get-selected-products') }}', { _token: AIZ.data.csrf, product_ids:productIds}, function(data){
            $('#fq-bought-product-select-modal').modal('hide');
            $('#selected-fq-bought-products').html(data);
            AIZ.plugins.sectionFooTable('#selected-fq-bought-products');
        });
    }

</script>
<script>
    $(document).ready(function(){
        var hash = document.location.hash;
        if (hash) {
            $('.nav-tabs a[href="'+hash+'"]').tab('show');
        }else{
            $('.nav-tabs a[href="#general"]').tab('show');
        }

        // Change hash for page-reload
        $('.nav-tabs a').on('shown.bs.tab', function (e) {
            window.location.hash = e.target.hash;
        });
    });

</script>

@include('partials.product.product_temp_data')

@endsection
