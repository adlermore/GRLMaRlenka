<div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    <div class="modal-dialog modal-dialog-zoom mw-100" role="document">
        <div class="modal-content">
            <div class="modal-header border-0 justify-content-center">
                <h6 class="modal-title fw-600">
                    <img src="{{ uploaded_asset(10) }}" alt="{{ env('APP_NAME') }}"
                                                    class="mw-100 h-30px h-md-40px" height="40">
                </h6>
                <button type="button" class="border-0 bg-transparent m-0 position-absolute right-0" data-dismiss="modal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                        <path d="M14 0C6.27537 0 0 6.27537 0 14C0 21.7246 6.27537 28 14 28C21.7246 28 28 21.7246 28 14C28 6.27537 21.7246 0 14 0ZM14 1.21739C21.0667 1.21739 26.7826 6.93333 26.7826 14C26.7826 21.0667 21.0667 26.7826 14 26.7826C6.93333 26.7826 1.21739 21.0667 1.21739 14C1.21739 6.93333 6.93333 1.21739 14 1.21739ZM18.8636 8.51342C18.7031 8.51721 18.5505 8.5843 18.4392 8.70007L14 13.1393L9.5608 8.70007C9.50408 8.64176 9.43624 8.59541 9.3613 8.56376C9.28636 8.53211 9.20584 8.5158 9.12449 8.51579C9.0034 8.51583 8.88507 8.55197 8.78463 8.6196C8.68419 8.68724 8.6062 8.78329 8.56064 8.89548C8.51507 9.00767 8.504 9.1309 8.52884 9.24942C8.55367 9.36793 8.61329 9.47635 8.70007 9.5608L13.1393 14L8.70007 18.4392C8.64165 18.4953 8.59501 18.5625 8.56288 18.6368C8.53075 18.7111 8.51377 18.7911 8.51295 18.8721C8.51212 18.9531 8.52747 19.0334 8.55808 19.1084C8.58869 19.1834 8.63395 19.2515 8.69122 19.3088C8.74848 19.366 8.8166 19.4113 8.89158 19.4419C8.96655 19.4725 9.04689 19.4879 9.12787 19.4871C9.20885 19.4862 9.28885 19.4693 9.36319 19.4371C9.43753 19.405 9.50471 19.3584 9.5608 19.2999L14 14.8607L18.4392 19.2999C18.4953 19.3584 18.5625 19.405 18.6368 19.4371C18.7111 19.4693 18.7911 19.4862 18.8721 19.4871C18.9531 19.4879 19.0334 19.4725 19.1084 19.4419C19.1834 19.4113 19.2515 19.366 19.3088 19.3088C19.366 19.2515 19.4113 19.1834 19.4419 19.1084C19.4725 19.0334 19.4879 18.9531 19.4871 18.8721C19.4862 18.7911 19.4693 18.7111 19.4371 18.6368C19.405 18.5625 19.3584 18.4953 19.2999 18.4392L14.8607 14L19.2999 9.5608C19.3883 9.4758 19.449 9.36607 19.474 9.246C19.499 9.12593 19.4871 9.00112 19.4399 8.88791C19.3928 8.7747 19.3125 8.67838 19.2097 8.61155C19.1068 8.54473 18.9862 8.51052 18.8636 8.51342Z" fill="black"/>
                    </svg>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="p-5 ml-5 mr-5">
                    <h6 class="modal-title fw-500 text-center fs-30 mb-5">
                        {{ translate('Sign in') }}
                    </h6>
                    <form class="form-default" role="form" action="{{ route('cart.login.submit') }}" method="POST">
                        @csrf

                        <!-- Email -->
                        <div class="form-group">
                            <label class="fw-500">
                                {{ translate('Your email') }}
                                <span style="color: #B62025">
                                    *
                                </span>
                            </label>
                            <input type="email"
                                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                value="{{ old('email') }}" name="email"
                                id="email" autocomplete="off">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <label class="fw-500">
                                {{ translate('Your password') }}
                                <span style="color: #B62025">
                                    *
                                </span>
                            </label>
                            <input type="password" name="password" class="form-control h-auto rounded-0">
                        </div>

                        <!-- Remember Me & Forgot password -->
                        <div class="row mb-2 justify-content-end">
                            <div class="col-12 text-right">
                                <a href="{{ route('password.request') }}"
                                    class="text-reset fw-500 hov-opacity-100 fs-14">{{ translate('Forgot password?') }}</a>
                            </div>
                            <div class="col-12">
                                <label class="aiz-checkbox">
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <span class="text-reset fw-500">{{ translate('Remember Me') }}</span>
                                    <span class="aiz-square-check"></span>
                                </label>
                            </div>
                        </div>

                        <!-- Login Button -->
                        <div>
                            <button type="submit"
                                class="btn btn-primary btn-block fw-600 rounded-0">{{ translate('Login') }}</button>
                        </div>
                    </form>
                </div>
                <div>
                    <hr>

                    <!-- Register Now -->
                    <div class="text-center mb-3 p-4">
                        <p class="text-reset mb-0 fs-17 fw-500 text-uppercase" style="margin-bottom: 20px !important;">{{ translate('No account yet?') }}</p>
                        <a href="{{ route('user.registration') }}" class="btn btn-clean fw-500 fs-14 border bg-transparent text-uppercase" style="width: 100%; max-width: 182px; border-radius: 0; border-color: #000">{{ translate('Register') }}</a>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <hr>

            </div>
            <hr>
        </div>
    </div>
</div>
