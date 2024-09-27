@extends('frontend.layouts.user_panel')

@section('panel_content')

    <!-- Basic Info-->
    <div class="card rounded-0 shadow-none border-0">
        <div class="card-body p-0">
            <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="content-card mt-4">
                    <div class="content-header p-4">
                        <h1 class="h2 mb-0">Profile Information</h1>
                    </div>
                    <div class="p-4">
                        <!-- User Details -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h2 class="h4 mb-0">User Details</h2>
                                <button class="btn btn-link edit-button p-0" type="submit">Edit</button>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6 mt-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name ?? '' }}">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email ?? '' }}">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="surname" class="form-label">Surname</label>
                                    <input type="text" class="form-control" id="surname" name="surname" value="{{ Auth::user()->surname ?? '' }}">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" value="{{ Auth::user()->phone ?? '' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Address -->
    <div class="card rounded-0 shadow-none border">
        <div class="card-header pt-4 border-bottom-0">
            <h5 class="mb-0 fs-18 fw-700 text-dark">{{ translate('Address')}}</h5>
        </div>
        <div class="card-body">
            @foreach (Auth::user()->addresses as $key => $address)
                <div class="">
                    <div class="border p-4 mb-4 position-relative">
                        <div class="row fs-14 mb-2 mb-md-0">
                            <span class="col-md-2 text-secondary">{{ translate('Address') }}:</span>
                            <span class="col-md-8 text-dark">{{ $address->address }}</span>
                        </div>
                        <div class="row fs-14 mb-2 mb-md-0">
                            <span class="col-md-2 text-secondary">{{ translate('Postal Code') }}:</span>
                            <span class="col-md-10 text-dark">{{ $address->postal_code }}</span>
                        </div>
                        <div class="row fs-14 mb-2 mb-md-0">
                            <span class="col-md-2 text-secondary">{{ translate('City') }}:</span>
                            <span class="col-md-10 text-dark">{{ optional($address->city)->name }}</span>
                        </div>
                        <div class="row fs-14 mb-2 mb-md-0">
                            <span class="col-md-2 text-secondary">{{ translate('State') }}:</span>
                            <span class="col-md-10 text-dark">{{ optional($address->state)->name }}</span>
                        </div>
                        <div class="row fs-14 mb-2 mb-md-0">
                            <span class="col-md-2 text-secondary">{{ translate('Country') }}:</span>
                            <span class="col-md-10 text-dark">{{ optional($address->country)->name }}</span>
                        </div>
                        @if ($address->set_default)
                            <div class="absolute-md-top-right pt-2 pt-md-4 pr-md-5">
                                <span class="badge badge-inline badge-secondary-base text-white p-3 fs-12" style="border-radius: 25px; min-width: 80px !important;">{{ translate('Default') }}</span>
                            </div>
                        @endif
                        <div class="dropdown position-absolute right-0 top-0 pt-4 mr-1">
                            <button class="btn bg-gray text-white px-1 py-1" type="button" data-toggle="dropdown">
                                <i class="la la-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" onclick="edit_address('{{$address->id}}')">
                                    {{ translate('Edit') }}
                                </a>
                                @if (!$address->set_default)
                                    <a class="dropdown-item" href="{{ route('addresses.set_default', $address->id) }}">{{ translate('Make This Default') }}</a>
                                @endif
                                <a class="dropdown-item" href="{{ route('addresses.destroy', $address->id) }}">{{ translate('Delete') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <!-- Add New Address -->
            <div class="" onclick="add_new_address()">
                <div class="border p-3 mb-3 c-pointer text-center bg-light has-transition hov-bg-soft-light">
                    <i class="la la-plus la-2x"></i>
                    <div class="alpha-7 fs-14 fw-700">{{ translate('Add New Address') }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <!-- Address modal -->
    @include('frontend.partials.address.address_modal')
@endsection

@section('script')
    @include('frontend.partials.address.address_js')

    <script type="text/javascript">
        $('.new-email-verification').on('click', function() {
            $(this).find('.loading').removeClass('d-none');
            $(this).find('.default').addClass('d-none');
            var email = $("input[name=email]").val();

            $.post('{{ route('user.new.verify') }}', {_token:'{{ csrf_token() }}', email: email}, function(data){
                data = JSON.parse(data);
                $('.default').removeClass('d-none');
                $('.loading').addClass('d-none');
                if(data.status == 2)
                    AIZ.plugins.notify('warning', data.message);
                else if(data.status == 1)
                    AIZ.plugins.notify('success', data.message);
                else
                    AIZ.plugins.notify('danger', data.message);
            });
        });
    </script>

    @if (get_setting('google_map') == 1)
        @include('frontend.partials.google_map')
    @endif

@endsection
