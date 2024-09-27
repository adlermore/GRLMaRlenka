@extends('frontend.layouts.app')
@section('content')
    <style>
        #section_featured .slick-slider .slick-list{
            background: #fff;
        }
        #section_featured .slick-slider .slick-list .slick-slide {
            margin-bottom: -5px;
        }
        @media (max-width: 575px){
            #section_featured .slick-slider .slick-list .slick-slide {
                margin-bottom: -4px;
            }
        }
    </style>

    @php $lang = get_system_language()->code;  @endphp

    <!-- Sliders -->
    <div class="home-banner-area">
        <div class="p-0">
            <!-- Sliders -->
            <div class="home-slider slider-full">
                @if (get_setting('home_slider_images', null, $lang) != null)
                    <div class="aiz-carousel dots-inside-bottom mobile-img-auto-height" data-autoplay="true" data-infinite="true">
                        @php
                            $decoded_slider_images = json_decode(get_setting('home_slider_images', null, $lang), true);
                            $sliders = get_slider_images($decoded_slider_images);
                            $home_slider_links = get_setting('home_slider_links', null, $lang);
                        @endphp
                        @foreach ($sliders as $key => $slider)
                            <div class="carousel-box position-relative">
                                <div class="d-block mw-100 img-fit overflow-hidden h-180vh overflow-hidden">
                                    <img class="img-fit h-100 m-auto has-transition ls-is-cached lazyloaded"
                                         src="{{ $slider ? my_asset($slider->file_name) : static_asset('assets/img/placeholder.jpg') }}"
                                         alt="{{ env('APP_NAME') }} promo"
                                         onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-5 position-absolute slider-text">
                                            <div>
                                                <h2 class="honey-cakes-title text-primary">Honey Eclairs</h2>
                                                <p class="text-primary lh-1-5 fs-17">
                                                    Marlenka Eclairs offers an original culinary experience in a mini dessert based on choux pastry with delicious milky cream filling.
                                                </p>
                                                <a href="{{ isset(json_decode($home_slider_links, true)[$key]) ? json_decode($home_slider_links, true)[$key] : '' }}">
                                                    <!-- Image -->
                                                    <button class="products-button">Discover more</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <section class="about-section">
        <div class="about-content">
            <div class="about-image-column">
                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/c5e36f758420788b8375c03369f8b9ca654e64681897174e80428a54c1cb894a?placeholderIfAbsent=true&apiKey=c74a7b05657b4cd68a28df5d434b4e2c" alt="About us" class="about-image">
            </div>
            <div class="about-text-column">
                <div class="about-text-container">
                    <div class="about-text-content">
                        <div class="about-text-row">
                            <div class="about-title-column">
                                <h2 class="about-title fw-300">SWEET <span style="color: #000">highlighty</span></h2>
                            </div>
                            <div class="about-description-column">
                                <p class="about-description">
                                    International success has enabled export to more than 40 countries worldwide, while achieving top marks verified by Quality Food Certificates!
                                </p>
                                <p class="about-description">
                                    No artificial colors or preservatives are ever used. All of our products are free from alcohol, animal fat, and genetically modified ingredients. Gluten-free options are also widely available.
                                </p>
                                <p class="about-description">
                                    Full range has been developed with the extremely long ambient shelf-life due to our unique vacuum and O2 absorbent packaging technology. Unique taste and universal appeal of our product line is complemented with rich flavors and soft consistency.
                                </p>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('search') }}" class="products-button text-center">Products</a>
                </div>
            </div>
        </div>
    </section>

    <section class="honey-cakes-section">
        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/f115cb6d207168f46416ff4eea9efac8153d7d81ba98d6da239ce2d7627a7153?placeholderIfAbsent=true&apiKey=c74a7b05657b4cd68a28df5d434b4e2c" alt="Honey Cakes" class="hero-background">
        <div class="honey-cakes-wrapper">
            <img src="{{uploaded_asset(16)}}" alt="">
            <h2 class="honey-cakes-title">honey Cakes</h2>
            <p>discover more</p>
        </div>
    </section>

    <div id="section_best_selling">

    </div>

    <section class="moments-section">
        <div class="moments-container">
            <div class="moments-image-column">
                <img src="{{uploaded_asset(17)}}" alt="Moments background" class="hero-background">
            </div>
            <div class="moments-text-column">
                <div class="moments-text-container">
                    <h2 class="moments-title">share Your moment</h2>
                    <h3 class="moment-subtitle heart-title">
                        Romantic gift
                        <hr>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="68" height="68" viewBox="0 0 68 68" fill="none">
                                <path d="M17.6641 4.14374C15.3531 4.32968 13.7062 4.8078 11.8734 5.73749C10.3859 6.5078 9.13749 7.46405 7.80936 8.8453C5.39217 11.3687 3.85155 14.4234 3.00155 18.3812C2.6828 19.8156 2.6828 20.1078 2.6828 23.0562C2.6828 26.0047 2.70936 26.2703 3.02811 27.7578C5.41874 38.9406 14.9281 50.1766 32.9109 63.1125L33.9734 63.8828L35.0625 63.1125C35.6469 62.6875 37.1344 61.625 38.3562 60.7219C54.8781 48.3437 63.6437 37.1078 65.1844 26.35C65.5031 24.1984 65.3969 20.4 64.9453 18.3547C63.9359 13.5734 61.5453 9.61561 58.0922 7.01249C56.8437 6.05624 54.7187 5.04687 53.2312 4.62187C51.7703 4.22343 49.3 4.01093 47.4406 4.11718C41.9953 4.40937 38.9141 6.10936 34.3984 11.3422L34 11.8203L33.6016 11.3422C32.5922 10.1469 30.1484 7.7828 29.2187 7.06562C27.4656 5.73749 25.5 4.86093 23.1891 4.40937C22.0469 4.22343 18.8859 4.03749 17.6641 4.14374ZM22.0734 11.1828C22.4453 11.2625 23.2687 11.5812 23.9062 11.8734C24.9687 12.3781 25.2078 12.5641 26.5625 13.9187C27.3594 14.7422 29.3516 16.9734 30.9719 18.8859C32.5656 20.7984 33.9203 22.3656 33.9734 22.3656C34.0266 22.3656 35.4078 20.7719 37.0281 18.8062C41.9687 12.9359 43.2172 11.8469 45.6875 11.2359C46.8562 10.9437 50.2562 10.9437 51.3453 11.2359C54.7984 12.1656 57.5078 15.6984 58.3047 20.3203C58.5969 22.0734 58.4906 25.2344 58.0656 27.0141C56.764 32.5125 53.1516 38.1172 46.6969 44.5453C43.2437 48.025 40.189 50.6547 35.4344 54.2937L33.9203 55.4359L32.0609 54.0016C18.4078 43.4562 10.9969 34.1859 9.61561 25.7922C9.29686 23.9062 9.40311 20.7719 9.82811 19.125C10.6516 16.0437 12.139 13.7328 14.264 12.2984C15.3797 11.5547 16.3094 11.1828 17.5047 11.05C18.7 10.9172 21.1703 10.9969 22.0734 11.1828Z" fill="#E60911"/>
                            </svg>
                        </div>
                    </h3>
                    <p class="moment-description">Show your love in the most delicious way possible. Real jewels of taste in splendid boxes, our chocolates will make your better half melt.</p>
                    <h3 class="moment-subtitle">Birthday gift</h3>
                    <p class="moment-description">A birthday! A cake, candles… All you need now is your Leonidas surprise! Give your loved one a special surprise: offer him or her their favourite chocolates or a varied assortment.</p>
                    <h3 class="moment-subtitle">Invitation</h3>
                    <p class="moment-description">Show how happy you are to receive your invitation: offer the hosts the creations of our Maîtres Chocolatiers to express your thanks. There's nothing like it to put a smile on their lips.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="ingredients-section">
        <h2 class="ingredients-title">INGREDIENTS</h2>
        <div class="ingredients-grid">
            <div class="ingredient-card">
                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/1e764fb2b03b7de2dc3ed7fa2362f2d467aa624f9994a96e20094b6dfe95e301?placeholderIfAbsent=true&apiKey=c74a7b05657b4cd68a28df5d434b4e2c" alt="Condensed Milk" class="ingredient-image">
                <h3 class="ingredient-name text-center">CONDENSED MILK</h3>
                <p class="ingredient-description">Our Classic Honey Cake is scrumptious and healthy.</p>
            </div>
            <div class="ingredient-card">
                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/b7bf6ee11f050e4de11faa53fca6e1af1e532d0159d4de9eff0b7fb0931370a8?placeholderIfAbsent=true&apiKey=c74a7b05657b4cd68a28df5d434b4e2c" alt="Natural Honey" class="ingredient-image">
                <h3 class="ingredient-name text-center">NATURAL HONEY</h3>
                <p class="ingredient-description">Our Classic Honey Cake is scrumptious and healthy.</p>
            </div>
            <div class="ingredient-card">
                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/fb7bbdef41be4c90c2f568df747eb9c948dc5859948098469e2b7489f346a17a?placeholderIfAbsent=true&apiKey=c74a7b05657b4cd68a28df5d434b4e2c" alt="Walnut" class="ingredient-image">
                <h3 class="ingredient-name text-center">WALNUT</h3>
                <p class="ingredient-description">Our Classic Honey Cake is scrumptious and healthy.</p>
            </div>
            <div class="ingredient-card">
                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/fe6f3633368f96bc89b13507d3b99ae864fda4b0deecadc2dfe332e1d2f38aa1?placeholderIfAbsent=true&apiKey=c74a7b05657b4cd68a28df5d434b4e2c" alt="Apricot" class="ingredient-image">
                <h3 class="ingredient-name text-center">Apricot</h3>
                <p class="ingredient-description">Our Classic Honey Cake is scrumptious and healthy.</p>
            </div>
            <div class="ingredient-card">
                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/d1b64c656f787093e899119e57837f1c6b8b6146a28ad64936ae39d1711ec9f5?placeholderIfAbsent=true&apiKey=c74a7b05657b4cd68a28df5d434b4e2c" alt="Almond" class="ingredient-image">
                <h3 class="ingredient-name text-center">Almond</h3>
                <p class="ingredient-description">Our Classic Honey Cake is scrumptious and healthy.</p>
            </div>
            <div class="ingredient-card">
                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/4f7f5ecfe865bc2e8fb432b732b9002da61151ada9dac6dd48de78adb7dc18dc?placeholderIfAbsent=true&apiKey=c74a7b05657b4cd68a28df5d434b4e2c" alt="Coffee" class="ingredient-image">
                <h3 class="ingredient-name text-center">Coffee</h3>
                <p class="ingredient-description">Our Classic Honey Cake is scrumptious and healthy.</p>
            </div>
            <div class="ingredient-card">
                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/818aeb0bba61411694158355945a8ef071e555d7a91f6ba3514a6cd0bc8d3415?placeholderIfAbsent=true&apiKey=c74a7b05657b4cd68a28df5d434b4e2c" alt="Cocoa" class="ingredient-image">
                <h3 class="ingredient-name text-center">Cocoa</h3>
                <p class="ingredient-description">Our Classic Honey Cake is scrumptious and healthy.</p>
            </div>
        </div>
    </section>

    <section class="timeline-section container">
        <div class="timeline-container">
            <div class="timeline-title">
                <h2>Marlenka's Timeline</h2>
            </div>
            <div class="timeline-content">
                <div class="timeline-years">
                    <span class="timeline-year above">2003</span>
                    <span class="timeline-year below">2005</span>
                    <span class="timeline-year above">2009</span>
                    <span class="timeline-year below">2012</span>
                    <span class="timeline-year above">2014</span>
                    <span class="timeline-year below">2016</span>
                    <span class="timeline-year above">2018</span>
                    <span class="timeline-year below">2019</span>
                </div>
                <div class="timeline-line">
                    <div class="timeline-arrow">
                        <div class="arrow-right"></div>
                    </div>
                </div>
                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/1e3818996aa6fe0da8078d5c65a84f89fe9fb2213d95e144623bc05038cd79ab?placeholderIfAbsent=true&apiKey=c74a7b05657b4cd68a28df5d434b4e2c" alt="Marlenka Factory" class="timeline-image">
            </div>
            <div class="timeline-cta">
                <span>Read our history</span>
            </div>
        </div>
    </section>


    {{--<!-- Flash Deal -->
    @php
        $flash_deal = get_featured_flash_deal();
        $flash_deal_bg = get_setting('flash_deal_bg_color');
        $flash_deal_bg_full_width = (get_setting('flash_deal_bg_full_width') == 1) ? true : false;
        $flash_deal_banner_menu_text = ((get_setting('flash_deal_banner_menu_text') == 'dark') ||  (get_setting('flash_deal_banner_menu_text') == null)) ? 'text-dark' : 'text-white';

    @endphp
    @if ($flash_deal != null)
        <section class="mb-2 mb-md-3 mt-2 mt-md-3" style="background: {{ ($flash_deal_bg_full_width && $flash_deal_bg != null) ? $flash_deal_bg : '' }};" id="flash_deal">
            <div class="container">
                <!-- Top Section sm to lg -->
                <div class="d-flex d-lg-none flex-wrap mb-2 mb-md-3 @if ($flash_deal_bg_full_width && $flash_deal_bg != null) pt-2 pt-md-3 @endif align-items-baseline justify-content-between">
                    <!-- Title -->
                    <h3 class="fs-16 fs-md-20 fw-700 mb-2 mb-sm-0">
                        <span class="d-inline-block {{ ($flash_deal_bg_full_width && $flash_deal_bg != null) ? $flash_deal_banner_menu_text : 'text-dark'}}">{{ translate('Flash Sale') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="24" viewBox="0 0 16 24"
                            class="ml-3">
                            <path id="Path_28795" data-name="Path 28795"
                                d="M30.953,13.695a.474.474,0,0,0-.424-.25h-4.9l3.917-7.81a.423.423,0,0,0-.028-.428.477.477,0,0,0-.4-.207H21.588a.473.473,0,0,0-.429.263L15.041,18.151a.423.423,0,0,0,.034.423.478.478,0,0,0,.4.2h4.593l-2.229,9.683a.438.438,0,0,0,.259.5.489.489,0,0,0,.571-.127L30.9,14.164a.425.425,0,0,0,.054-.469Z"
                                transform="translate(-15 -5)" fill="#fcc201" />
                        </svg>
                    </h3>
                    <!-- Links -->
                    <div>
                        <div class="text-dark d-flex align-items-center mb-0">
                            <a href="{{ route('flash-deals') }}"
                                class="fs-10 fs-md-12 fw-700 has-transition @if ((get_setting('flash_deal_banner_menu_text') == 'light') && $flash_deal_bg_full_width && $flash_deal_bg != null) text-white opacity-60 hov-opacity-100 animate-underline-white @else text-reset opacity-60 hov-opacity-100 hov-text-primary animate-underline-primary @endif mr-3">{{ translate('View All Flash Sale') }}</a>
                            <span class=" border-left border-soft-light border-width-2 pl-3">
                                <a href="{{ route('flash-deal-details', $flash_deal->slug) }}"
                                    class="fs-10 fs-md-12 fw-700 has-transition @if ((get_setting('flash_deal_banner_menu_text') == 'light') && $flash_deal_bg_full_width && $flash_deal_bg != null) == 'light') text-white opacity-60 hov-opacity-100 animate-underline-white @else text-reset opacity-60 hov-opacity-100 hov-text-primary animate-underline-primary @endif">{{ translate('View All Products from This Flash Sale') }}</a>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Countdown for small device -->
                <div class="bg-white mb-3 d-md-none">
                    <div class="aiz-count-down-circle" end-date="{{ date('Y/m/d H:i:s', $flash_deal->end_date) }}"></div>
                </div>

                <div class="row no-gutters align-items-center" style="background: {{ $flash_deal_bg }};">
                    <!-- Flash Deals Baner & Countdown -->
                    <div class="col-xxl-4 col-lg-5 col-6 h-200px h-md-400px h-lg-475px">
                        <div class="h-100 w-100 w-xl-auto"
                            style="background-image: url('{{ uploaded_asset($flash_deal->banner) }}'); background-size: cover; background-position: center center;">
                            <div class="py-5 px-md-3 px-xl-5 d-none d-md-block">
                                <div class="bg-white">
                                    <div class="aiz-count-down-circle"
                                        end-date="{{ date('Y/m/d H:i:s', $flash_deal->end_date) }}"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-8 col-lg-7 col-6">
                        <div class="pl-3 pr-lg-3 pl-xl-2rem pr-xl-2rem">
                            <!-- Top Section from lg device -->
                            <div class="d-none d-lg-flex flex-wrap mb-2 mb-md-3 align-items-baseline justify-content-between">
                                <!-- Title -->
                                <h3 class="fs-16 fs-md-20 fw-700 mb-2">
                                    <span class="d-inline-block {{ $flash_deal_banner_menu_text }}">{{ translate('Flash Sale') }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="24" viewBox="0 0 16 24"
                                        class="ml-3">
                                        <path id="Path_28795" data-name="Path 28795"
                                            d="M30.953,13.695a.474.474,0,0,0-.424-.25h-4.9l3.917-7.81a.423.423,0,0,0-.028-.428.477.477,0,0,0-.4-.207H21.588a.473.473,0,0,0-.429.263L15.041,18.151a.423.423,0,0,0,.034.423.478.478,0,0,0,.4.2h4.593l-2.229,9.683a.438.438,0,0,0,.259.5.489.489,0,0,0,.571-.127L30.9,14.164a.425.425,0,0,0,.054-.469Z"
                                            transform="translate(-15 -5)" fill="#fcc201" />
                                    </svg>
                                </h3>
                                <!-- Links -->
                                <div>
                                    <div class="text-dark d-flex align-items-center mb-0">
                                        <a href="{{ route('flash-deals') }}"
                                            class="fs-10 fs-md-12 fw-700 has-transition {{ $flash_deal_banner_menu_text }} @if (get_setting('flash_deal_banner_menu_text') == 'light') text-white opacity-60 hov-opacity-100 animate-underline-white @else text-reset opacity-60 hov-opacity-100 hov-text-primary animate-underline-primary @endif mr-3">
                                            {{ translate('View All Flash Sale') }}
                                        </a>
                                        <span class=" border-left border-soft-light border-width-2 pl-3">
                                            <a href="{{ route('flash-deal-details', $flash_deal->slug) }}"
                                                class="fs-10 fs-md-12 fw-700 has-transition {{ $flash_deal_banner_menu_text }} @if (get_setting('flash_deal_banner_menu_text') == 'light') text-white opacity-60 hov-opacity-100 animate-underline-white @else text-reset opacity-60 hov-opacity-100 hov-text-primary animate-underline-primary @endif">{{ translate('View All Products from This Flash Sale') }}</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!-- Flash Deals Products -->
                            @php
                                $flash_deal_products = get_flash_deal_products($flash_deal->id);
                            @endphp
                            <div class="aiz-carousel border-top @if (count($flash_deal_products) > 8) border-right @endif arrow-inactive-none arrow-x-0"
                                data-rows="2" data-items="5" data-xxl-items="5" data-xl-items="3.5" data-lg-items="3" data-md-items="2"
                                data-sm-items="2.5" data-xs-items="1.7" data-arrows="true" data-dots="false">
                                @foreach ($flash_deal_products as $key => $flash_deal_product)
                                    <div class="carousel-box bg-white border-left border-bottom">
                                        @if ($flash_deal_product->product != null && $flash_deal_product->product->published != 0)
                                            @php
                                                $product_url = route('product', $flash_deal_product->product->slug);
                                            @endphp
                                            <div
                                                class="h-100px h-md-200px h-lg-auto flash-deal-item position-relative text-center has-transition hov-shadow-out z-1">
                                                <a href="{{ $product_url }}"
                                                    class="d-block py-md-2 overflow-hidden hov-scale-img"
                                                    title="{{ $flash_deal_product->product->getTranslation('name') }}">
                                                    <!-- Image -->
                                                    <img src="{{ get_image($flash_deal_product->product->thumbnail) }}"
                                                        class="lazyload h-60px h-md-100px h-lg-120px mw-100 mx-auto has-transition"
                                                        alt="{{ $flash_deal_product->product->getTranslation('name') }}"
                                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                                    <!-- Price -->
                                                    <div
                                                        class="fs-10 fs-md-14 mt-md-2 text-center h-md-48px has-transition overflow-hidden pt-md-4 flash-deal-price lh-1-5">
                                                        <span
                                                            class="d-block text-primary fw-700">{{ home_discounted_base_price($flash_deal_product->product) }}</span>
                                                        @if (home_base_price($flash_deal_product->product) != home_discounted_base_price($flash_deal_product->product))
                                                            <del
                                                                class="d-block fw-400 text-secondary">{{ home_base_price($flash_deal_product->product) }}</del>
                                                        @endif
                                                    </div>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Today's deal -->

    <!-- Featured Categories -->
    @if (count($featured_categories) > 0)
        <section class="mb-2 mb-md-3 mt-2 mt-md-3">
            <div class="container">
                <div class="bg-white">
                    <!-- Top Section -->
                    <div class="d-flex mt-2 mt-md-3 mb-2 mb-md-3 align-items-baseline justify-content-between">
                        <!-- Title -->
                        <h3 class="fs-16 fs-md-20 fw-700 mb-2 mb-sm-0">
                            <span class="">{{ translate('Featured Categories') }}</span>
                        </h3>
                    </div>
                </div>
                <!-- Categories -->
                <div class="bg-white px-sm-3">
                    <div class="aiz-carousel sm-gutters-17" data-items="4" data-xxl-items="4" data-xl-items="3.5"
                        data-lg-items="3" data-md-items="2" data-sm-items="2" data-xs-items="1" data-arrows="true"
                        data-dots="false" data-autoplay="false" data-infinite="true">
                        @foreach ($featured_categories as $key => $category)
                            @php
                                $category_name = $category->getTranslation('name');
                            @endphp
                            <div class="carousel-box position-relative p-0 has-transition border-right border-top border-bottom @if ($key == 0) border-left @endif">
                                <div class="h-200px h-sm-250px h-md-340px">
                                    <div class="h-100 w-100 w-xl-auto position-relative hov-scale-img overflow-hidden">
                                        <div class="position-absolute h-100 w-100 overflow-hidden">
                                            <img src="{{ isset($category->coverImage->file_name) ? my_asset($category->coverImage->file_name) : static_asset('assets/img/placeholder.jpg') }}"
                                                alt="{{ $category_name }}"
                                                class="img-fit h-100 has-transition"
                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                        </div>
                                        <div class="pb-4 px-4 absolute-bottom-left has-transition h-50 w-100 d-flex flex-column align-items-center justify-content-end"
                                            style="background: linear-gradient(to top, rgba(0,0,0,0.5) 50%,rgba(0,0,0,0) 100%) !important;">
                                            <div class="w-100">
                                                <a class="fs-16 fw-700 text-white animate-underline-white home-category-name d-flex align-items-center hov-column-gap-1"
                                                    href="{{ route('products.category', $category->slug) }}"
                                                    style="width: max-content;">
                                                    {{ $category_name }}&nbsp;
                                                    <i class="las la-angle-right"></i>
                                                </a>
                                                <div class="d-flex flex-wrap h-50px overflow-hidden mt-2">
                                                    @foreach ($category->childrenCategories->take(6) as $key => $child_category)
                                                    <a href="{{ route('products.category', $child_category->slug) }}" class="fs-13 fw-300 text-soft-light hov-text-white pr-3 pt-1">
                                                        {{ $child_category->getTranslation('name') }}
                                                    </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Banner section 1 -->
    @php $homeBanner1Images = get_setting('home_banner1_images', null, $lang);   @endphp
    @if ($homeBanner1Images != null)
        <div class="pb-2 pb-md-3 pt-2 pt-md-3" style="background: #f5f5fa;">
            <div class="container mb-2 mb-md-3">
                @php
                    $banner_1_imags = json_decode($homeBanner1Images);
                    $data_md = count($banner_1_imags) >= 2 ? 2 : 1;
                    $home_banner1_links = get_setting('home_banner1_links', null, $lang);
                @endphp
                <div class="w-100">
                    <div class="aiz-carousel gutters-16 overflow-hidden arrow-inactive-none arrow-dark arrow-x-15"
                        data-items="{{ count($banner_1_imags) }}" data-xxl-items="{{ count($banner_1_imags) }}"
                        data-xl-items="{{ count($banner_1_imags) }}" data-lg-items="{{ $data_md }}"
                        data-md-items="{{ $data_md }}" data-sm-items="1" data-xs-items="1" data-arrows="true"
                        data-dots="false">
                        @foreach ($banner_1_imags as $key => $value)
                            <div class="carousel-box overflow-hidden hov-scale-img">
                                <a href="{{ isset(json_decode($home_banner1_links, true)[$key]) ? json_decode($home_banner1_links, true)[$key] : '' }}"
                                    class="d-block text-reset overflow-hidden">
                                    <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                        data-src="{{ uploaded_asset($value) }}" alt="{{ env('APP_NAME') }} promo"
                                        class="img-fluid lazyload w-100 has-transition"
                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Featured Products -->
    <div id="section_featured" class="pt-2 pt-md-3" style="background: #f5f5fa;">

    </div>

    <!-- Banner Section 2 -->
    @php $homeBanner2Images = get_setting('home_banner2_images', null, $lang);   @endphp
    @if ($homeBanner2Images != null)
        <div class="mb-2 mb-md-3 mt-2 mt-md-3">
            <div class="container">
                @php
                    $banner_2_imags = json_decode($homeBanner2Images);
                    $data_md = count($banner_2_imags) >= 2 ? 2 : 1;
                    $home_banner2_links = get_setting('home_banner2_links', null, $lang);
                @endphp
                <div class="aiz-carousel gutters-16 overflow-hidden arrow-inactive-none arrow-dark arrow-x-15"
                    data-items="{{ count($banner_2_imags) }}" data-xxl-items="{{ count($banner_2_imags) }}"
                    data-xl-items="{{ count($banner_2_imags) }}" data-lg-items="{{ $data_md }}"
                    data-md-items="{{ $data_md }}" data-sm-items="1" data-xs-items="1" data-arrows="true"
                    data-dots="false">
                    @foreach ($banner_2_imags as $key => $value)
                        <div class="carousel-box overflow-hidden hov-scale-img">
                            <a href="{{ isset(json_decode($home_banner2_links, true)[$key]) ? json_decode($home_banner2_links, true)[$key] : '' }}"
                                class="d-block text-reset overflow-hidden">
                                <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                    data-src="{{ uploaded_asset($value) }}" alt="{{ env('APP_NAME') }} promo"
                                    class="img-fluid lazyload w-100 has-transition"
                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    {{--<!-- Best Selling  -->


    <!-- New Products -->
    <div id="section_newest">

    </div>--}}

    {{--<div class="container-fluid">
        <div class="ft_newsletter">
            <div class="container">
                <div class="content_newletter">
                    <div class="title_newsletter">
                        <h2>Join Our Newsletter Now.<span>Up to 70% Off. All Sales are Final! </span></h2>
                        <p>You may unsubscribe at any moment. For that purpose, please find our contact info in the legal notice.</p>
                    </div>
                    <form method="POST" action="{{ route('subscribers.store') }}">
                        @csrf
                        <input class="btn btn-primary" name="submitNewsletter" type="submit" value="{{ translate('Subscribe') }}">
                        <div class="input-wrapper">
                            <input name="email" type="email" value="" placeholder="{{ translate('Your Email Address') }}">
                        </div>
                        <input type="hidden" name="action" value="0">
                        <div class="clearfix"></div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- begin /home/wj87dyos0gkd/contempoconcrete.com/modules/posstaticblocks/views/templates/hook/staticblocks.tpl -->  <div class="static_cms">
            <div class="row">
                <div class="col-cms col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="box_cms"><img src="{{asset('public/assets/img/home/cms1.png')}}" alt="" class="img-responsive">
                        <div class="txt_cms">
                            <h2>Hand Made in USA</h2>
                            <p>With Premium Quality</p>
                        </div>
                    </div>
                </div>
                <div class="col-cms col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="box_cms"><img src="{{asset('public/assets/img/home/cms2.png')}}" alt="" class="img-responsive">
                        <div class="txt_cms">
                            <h2>Shipping</h2>
                            <p>Fast Shipping in Continental USA</p>
                        </div>
                    </div>
                </div>
                <div class="col-cms col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="box_cms"><img src="{{asset('public/assets/img/home/cms3.png')}}" alt="" class="img-responsive">
                        <div class="txt_cms">
                            <h2>Durability</h2>
                            <p>Glass Fiber Reinforced Concrete</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end /home/wj87dyos0gkd/contempoconcrete.com/modules/posstaticblocks/views/templates/hook/staticblocks.tpl -->
    </div>

    <!-- Banner Section 3 -->
    @php $homeBanner3Images = get_setting('home_banner3_images', null, $lang);   @endphp
    @if ($homeBanner3Images != null)
        <div class="mb-2 mb-md-3 mt-2 mt-md-3">
            <div class="container">
                @php
                    $banner_3_imags = json_decode($homeBanner3Images);
                    $data_md = count($banner_3_imags) >= 2 ? 2 : 1;
                    $home_banner3_links = get_setting('home_banner3_links', null, $lang);
                @endphp
                <div class="d-flex justify-content-center">
                    @foreach ($banner_3_imags as $key => $value)
                        <div class="col-4">
                            <a href="{{ isset(json_decode($home_banner3_links, true)[$key]) ? json_decode($home_banner3_links, true)[$key] : '' }}"
                                class="d-block text-reset overflow-hidden">
                                <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                    data-src="{{ uploaded_asset($value) }}" alt="{{ env('APP_NAME') }} promo"
                                    class="img-fluid lazyload w-100 has-transition"
                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- Cupon -->
    @if (get_setting('coupon_system') == 1)
        <div class=" mt-2 mt-md-3"
            style="background-color: {{ get_setting('cupon_background_color', '#292933') }}">
            <div class="container">
                <div class="position-relative py-5">
                    <div class="text-center text-xl-left position-relative z-5">
                        <div class="d-lg-flex">
                            <div class="mb-3 mb-lg-0">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="109.602" height="93.34" viewBox="0 0 109.602 93.34">
                                    <defs>
                                        <clipPath id="clip-pathcup">
                                            <path id="Union_10" data-name="Union 10" d="M12263,13778v-15h64v-41h12v56Z"
                                                transform="translate(-11966 -8442.865)" fill="none" stroke="#fff"
                                                stroke-width="2" />
                                        </clipPath>
                                    </defs>
                                    <g id="Group_24326" data-name="Group 24326"
                                        transform="translate(-274.201 -5254.611)">
                                        <g id="Mask_Group_23" data-name="Mask Group 23"
                                            transform="translate(-3652.459 1785.452) rotate(-45)"
                                            clip-path="url(#clip-pathcup)">
                                            <g id="Group_24322" data-name="Group 24322"
                                                transform="translate(207 18.136)">
                                                <g id="Subtraction_167" data-name="Subtraction 167"
                                                    transform="translate(-12177 -8458)" fill="none">
                                                    <path
                                                        d="M12335,13770h-56a8.009,8.009,0,0,1-8-8v-8a8,8,0,0,0,0-16v-8a8.009,8.009,0,0,1,8-8h56a8.009,8.009,0,0,1,8,8v8a8,8,0,0,0,0,16v8A8.009,8.009,0,0,1,12335,13770Z"
                                                        stroke="none" />
                                                    <path
                                                        d="M 12335.0009765625 13768.0009765625 C 12338.3095703125 13768.0009765625 12341.0009765625 13765.30859375 12341.0009765625 13762 L 12341.0009765625 13755.798828125 C 12336.4423828125 13754.8701171875 12333.0009765625 13750.8291015625 12333.0009765625 13746 C 12333.0009765625 13741.171875 12336.4423828125 13737.130859375 12341.0009765625 13736.201171875 L 12341.0009765625 13729.9990234375 C 12341.0009765625 13726.6904296875 12338.3095703125 13723.9990234375 12335.0009765625 13723.9990234375 L 12278.9990234375 13723.9990234375 C 12275.6904296875 13723.9990234375 12272.9990234375 13726.6904296875 12272.9990234375 13729.9990234375 L 12272.9990234375 13736.201171875 C 12277.5576171875 13737.1298828125 12280.9990234375 13741.1708984375 12280.9990234375 13746 C 12280.9990234375 13750.828125 12277.5576171875 13754.869140625 12272.9990234375 13755.798828125 L 12272.9990234375 13762 C 12272.9990234375 13765.30859375 12275.6904296875 13768.0009765625 12278.9990234375 13768.0009765625 L 12335.0009765625 13768.0009765625 M 12335.0009765625 13770.0009765625 L 12278.9990234375 13770.0009765625 C 12274.587890625 13770.0009765625 12270.9990234375 13766.412109375 12270.9990234375 13762 L 12270.9990234375 13754 C 12275.4111328125 13753.9990234375 12278.9990234375 13750.4111328125 12278.9990234375 13746 C 12278.9990234375 13741.5888671875 12275.41015625 13738 12270.9990234375 13738 L 12270.9990234375 13729.9990234375 C 12270.9990234375 13725.587890625 12274.587890625 13721.9990234375 12278.9990234375 13721.9990234375 L 12335.0009765625 13721.9990234375 C 12339.412109375 13721.9990234375 12343.0009765625 13725.587890625 12343.0009765625 13729.9990234375 L 12343.0009765625 13738 C 12338.5888671875 13738.0009765625 12335.0009765625 13741.5888671875 12335.0009765625 13746 C 12335.0009765625 13750.4111328125 12338.58984375 13754 12343.0009765625 13754 L 12343.0009765625 13762 C 12343.0009765625 13766.412109375 12339.412109375 13770.0009765625 12335.0009765625 13770.0009765625 Z"
                                                        stroke="none" fill="#fff" />
                                                </g>
                                            </g>
                                        </g>
                                        <g id="Group_24321" data-name="Group 24321"
                                            transform="translate(-3514.477 1653.317) rotate(-45)">
                                            <g id="Subtraction_167-2" data-name="Subtraction 167"
                                                transform="translate(-12177 -8458)" fill="none">
                                                <path
                                                    d="M12335,13770h-56a8.009,8.009,0,0,1-8-8v-8a8,8,0,0,0,0-16v-8a8.009,8.009,0,0,1,8-8h56a8.009,8.009,0,0,1,8,8v8a8,8,0,0,0,0,16v8A8.009,8.009,0,0,1,12335,13770Z"
                                                    stroke="none" />
                                                <path
                                                    d="M 12335.0009765625 13768.0009765625 C 12338.3095703125 13768.0009765625 12341.0009765625 13765.30859375 12341.0009765625 13762 L 12341.0009765625 13755.798828125 C 12336.4423828125 13754.8701171875 12333.0009765625 13750.8291015625 12333.0009765625 13746 C 12333.0009765625 13741.171875 12336.4423828125 13737.130859375 12341.0009765625 13736.201171875 L 12341.0009765625 13729.9990234375 C 12341.0009765625 13726.6904296875 12338.3095703125 13723.9990234375 12335.0009765625 13723.9990234375 L 12278.9990234375 13723.9990234375 C 12275.6904296875 13723.9990234375 12272.9990234375 13726.6904296875 12272.9990234375 13729.9990234375 L 12272.9990234375 13736.201171875 C 12277.5576171875 13737.1298828125 12280.9990234375 13741.1708984375 12280.9990234375 13746 C 12280.9990234375 13750.828125 12277.5576171875 13754.869140625 12272.9990234375 13755.798828125 L 12272.9990234375 13762 C 12272.9990234375 13765.30859375 12275.6904296875 13768.0009765625 12278.9990234375 13768.0009765625 L 12335.0009765625 13768.0009765625 M 12335.0009765625 13770.0009765625 L 12278.9990234375 13770.0009765625 C 12274.587890625 13770.0009765625 12270.9990234375 13766.412109375 12270.9990234375 13762 L 12270.9990234375 13754 C 12275.4111328125 13753.9990234375 12278.9990234375 13750.4111328125 12278.9990234375 13746 C 12278.9990234375 13741.5888671875 12275.41015625 13738 12270.9990234375 13738 L 12270.9990234375 13729.9990234375 C 12270.9990234375 13725.587890625 12274.587890625 13721.9990234375 12278.9990234375 13721.9990234375 L 12335.0009765625 13721.9990234375 C 12339.412109375 13721.9990234375 12343.0009765625 13725.587890625 12343.0009765625 13729.9990234375 L 12343.0009765625 13738 C 12338.5888671875 13738.0009765625 12335.0009765625 13741.5888671875 12335.0009765625 13746 C 12335.0009765625 13750.4111328125 12338.58984375 13754 12343.0009765625 13754 L 12343.0009765625 13762 C 12343.0009765625 13766.412109375 12339.412109375 13770.0009765625 12335.0009765625 13770.0009765625 Z"
                                                    stroke="none" fill="#fff" />
                                            </g>
                                            <g id="Group_24325" data-name="Group 24325">
                                                <rect id="Rectangle_18578" data-name="Rectangle 18578" width="8"
                                                    height="2" transform="translate(120 5287)" fill="#fff" />
                                                <rect id="Rectangle_18579" data-name="Rectangle 18579" width="8"
                                                    height="2" transform="translate(132 5287)" fill="#fff" />
                                                <rect id="Rectangle_18581" data-name="Rectangle 18581" width="8"
                                                    height="2" transform="translate(144 5287)" fill="#fff" />
                                                <rect id="Rectangle_18580" data-name="Rectangle 18580" width="8"
                                                    height="2" transform="translate(108 5287)" fill="#fff" />
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <div class="ml-lg-3">
                                <h5 class="fs-36 fw-400 text-white mb-3">{{ translate(get_setting('cupon_title')) }}</h5>
                                <h5 class="fs-20 fw-400 text-gray">{{ translate(get_setting('cupon_subtitle')) }}</h5>
                                <div class="mt-5 pt-5">
                                    <a href="{{ route('coupons.all') }}"
                                        class="btn text-white hov-bg-white hov-text-dark border border-width-2 fs-16 px-5"
                                        style="border-radius: 28px;background: rgba(255, 255, 255, 0.2);box-shadow: 0px 20px 30px rgba(0, 0, 0, 0.16);">{{ translate('View All Coupons') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="position-absolute right-0 bottom-0 h-100">
                        <img class="img-fit h-100" src="{{ uploaded_asset(get_setting('coupon_background_image', null, $lang)) }}"
                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/coupon.svg') }}';"
                            alt="{{ env('APP_NAME') }} promo">
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Category wise Products -->
    <div id="section_home_categories" style="background: #f5f5fa;">

    </div>

    <!-- Classified Product -->
    @if (get_setting('classified_product') == 1)
        @php
            $classified_products = get_home_page_classified_products(6);
        @endphp
        @if (count($classified_products) > 0)
            <section class="mb-2 mb-md-3 mt-3 mt-md-5">
                <div class="container">
                    <!-- Top Section -->
                    <div class="d-flex mb-2 mb-md-3 align-items-baseline justify-content-between">
                        <!-- Title -->
                        <h3 class="fs-16 fs-md-20 fw-700 mb-2 mb-sm-0">
                            <span class="">{{ translate('Classified Ads') }}</span>
                        </h3>
                        <!-- Links -->
                        <div class="d-flex">
                            <a class="text-blue fs-10 fs-md-12 fw-700 hov-text-primary animate-underline-primary"
                                href="{{ route('customer.products') }}">{{ translate('View All Products') }}</a>
                        </div>
                    </div>
                    <!-- Banner -->
                    @php
                        $classifiedBannerImage = get_setting('classified_banner_image', null, $lang);
                        $classifiedBannerImageSmall = get_setting('classified_banner_image_small', null, $lang);
                    @endphp
                    @if ($classifiedBannerImage != null || $classifiedBannerImageSmall != null)
                        <div class="mb-3 overflow-hidden hov-scale-img d-none d-md-block">
                            <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                data-src="{{ uploaded_asset($classifiedBannerImage) }}"
                                alt="{{ env('APP_NAME') }} promo" class="lazyload img-fit h-100 has-transition"
                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                        </div>
                        <div class="mb-3 overflow-hidden hov-scale-img d-md-none">
                            <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                data-src="{{ $classifiedBannerImageSmall != null ? uploaded_asset($classifiedBannerImageSmall) : uploaded_asset($classifiedBannerImage) }}"
                                alt="{{ env('APP_NAME') }} promo" class="lazyload img-fit h-100 has-transition"
                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                        </div>
                    @endif
                    <!-- Products Section -->
                    <div class="bg-white pt-3">
                        <div class="row no-gutters border-top border-left">
                            @foreach ($classified_products as $key => $classified_product)
                                <div
                                    class="col-xl-4 col-md-6 border-right border-bottom has-transition hov-shadow-out z-1">
                                    <div class="aiz-card-box p-2 has-transition bg-white">
                                        <div class="row hov-scale-img">
                                            <div class="col-4 col-md-5 mb-3 mb-md-0">
                                                <a href="{{ route('customer.product', $classified_product->slug) }}"
                                                    class="d-block overflow-hidden h-auto h-md-150px text-center">
                                                    <img class="img-fluid lazyload mx-auto has-transition"
                                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                        data-src="{{ isset($classified_product->thumbnail->file_name) ? my_asset($classified_product->thumbnail->file_name) : static_asset('assets/img/placeholder.jpg') }}"
                                                        alt="{{ $classified_product->getTranslation('name') }}"
                                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                                </a>
                                            </div>
                                            <div class="col">
                                                <h3
                                                    class="fw-400 fs-14 text-dark text-truncate-2 lh-1-4 mb-3 h-35px d-none d-sm-block">
                                                    <a href="{{ route('customer.product', $classified_product->slug) }}"
                                                        class="d-block text-reset hov-text-primary">{{ $classified_product->getTranslation('name') }}</a>
                                                </h3>
                                                <div class="fs-14 mb-3">
                                                    <span
                                                        class="text-secondary">{{ $classified_product->user ? $classified_product->user->name : '' }}</span><br>
                                                    <span
                                                        class="fw-700 text-primary">{{ single_price($classified_product->unit_price) }}</span>
                                                </div>
                                                @if ($classified_product->conditon == 'new')
                                                    <span
                                                        class="badge badge-inline badge-soft-info fs-13 fw-700 px-3 py-2 text-info"
                                                        style="border-radius: 20px;">{{ translate('New') }}</span>
                                                @elseif($classified_product->conditon == 'used')
                                                    <span
                                                        class="badge badge-inline badge-soft-secondary-base fs-13 fw-700 px-3 py-2 text-danger"
                                                        style="border-radius: 20px;">{{ translate('Used') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endif

    <!-- Top Brands -->
    @if (get_setting('top_brands') != null)
        <section class="mb-2 mb-md-3 mt-2 mt-md-3">
            <div class="container">
                <!-- Top Section -->
                <div class="d-flex mb-2 mb-md-3 align-items-baseline justify-content-between">
                    <!-- Title -->
                    <h3 class="fs-16 fs-md-20 fw-700 mb-2 mb-sm-0">{{ translate('Top Brands') }}</h3>
                    <!-- Links -->
                    <div class="d-flex">
                        <a class="text-blue fs-10 fs-md-12 fw-700 hov-text-primary animate-underline-primary"
                            href="{{ route('brands.all') }}">{{ translate('View All Brands') }}</a>
                    </div>
                </div>
                <!-- Brands Section -->
                <div class="bg-white px-3">
                    <div
                        class="row row-cols-xxl-6 row-cols-xl-6 row-cols-lg-4 row-cols-md-4 row-cols-3 gutters-16 border-top border-left">
                        @php
                            $top_brands = json_decode(get_setting('top_brands'));
                            $brands = get_brands($top_brands);
                        @endphp
                        @foreach ($brands as $brand)
                            <div
                                class="col text-center border-right border-bottom hov-scale-img has-transition hov-shadow-out z-1">
                                <a href="{{ route('products.brand', $brand->slug) }}" class="d-block p-sm-3">
                                    <img src="{{ isset($brand->brandLogo->file_name) ? my_asset($brand->brandLogo->file_name) : static_asset('assets/img/placeholder.jpg') }}"
                                        class="lazyload h-100 h-md-100px mx-auto has-transition p-2 p-sm-4 mw-100"
                                        alt="{{ $brand->getTranslation('name') }}"
                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                    <p class="text-center text-dark fs-12 fs-md-14 fw-700 mt-2">
                                        {{ $brand->getTranslation('name') }}
                                    </p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif--}}

@endsection

