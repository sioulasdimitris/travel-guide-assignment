@php
$img_home_banner = getImageUrl(setting('home_banner'));
if (setting('home_banner')) {
    $home_banner = "style=background-image:url({$img_home_banner})";
} else {
    $home_banner = 'style=background-image:url(/assets/images/home-bsn-banner.jpg)';
}
@endphp
@extends('frontend.layouts.template_02')
@section('main')
    <main id="main" class="site-main home-main business-main">
        <div class="site-banner" {{ $home_banner }}>
            <div class="container">
                <div class="site-banner__content">
                    <h1 class="site-banner__title">{{ __('Business Listing') }}</h1>
                    <p><i>{{ $city_count }}</i> {{ __('cities') }}, <i>{{ $category_count }}</i>
                        {{ __('categories') }},
                        <i>{{ $place_count }}</i> {{ __('places') }}.
                    </p>
                    <form action="{{ route('page_search_listing') }}" class="site-banner__search layout-02">
                        <div class="field-input">
                            <label for="input_search">{{ __('Find') }}</label>
                            <input class="site-banner__search__input open-suggestion" id="input_search" type="text"
                                placeholder="{{ __('Ex: fastfood, beer') }}" autocomplete="off">
                            <input type="hidden" name="category[]" id="category_id">
                            <div class="search-suggestions category-suggestion">
                                <ul>
                                    <li><a href="#"><span>{{ __('Loading...') }}</span></a></li>
                                </ul>
                            </div>
                        </div><!-- .site-banner__search__input -->
                        <div class="field-input">
                            <label for="location_search">{{ __('Where') }}</label>
                            <input class="site-banner__search__input open-suggestion" id="location_search" type="text"
                                placeholder="{{ __('Your city') }}" autocomplete="off">
                            <input type="hidden" id="city_id">
                            <div class="search-suggestions location-suggestion">
                                <ul>
                                    <li><a href="#"><span>{{ __('Loading...') }}</span></a></li>
                                </ul>
                            </div>
                        </div><!-- .site-banner__search__input -->
                        <div class="field-submit">
                            <button><i class="las la-search la-24-black"></i></button>
                        </div>
                    </form><!-- .site-banner__search -->
                </div><!-- .site-banner__content -->
            </div>
        </div><!-- .site-banner -->

        <div class="business-category">
            <div class="container">
                <h2 class="title title-border-bottom align-center">{{ __('Browse Businesses by Category') }}</h2>
                <div class="slick-sliders">
                    <div class="slick-slider business-cat-slider slider-pd30" data-item="6" data-arrows="true"
                        data-itemScroll="6" data-dots="true" data-centerPadding="50" data-tabletitem="3"
                        data-tabletscroll="3" data-smallpcitem="4" data-smallpcscroll="4" data-mobileitem="2"
                        data-mobilescroll="2" data-mobilearrows="false">

                        @foreach ($categories as $cat)
                            <div class="bsn-cat-item rosy-pink">
                                <a href="{{ route('page_search_listing', ['category[]' => $cat->id]) }}"
                                    style="background-color:{{ $cat->color_code }};">
                                    <img src="{{ getImageUrl($cat->icon_map_marker) }}" alt="{{ $cat->name }}">
                                    <span class="title">{{ $cat->name }}</span>
                                    <span class="place">{{ $cat->place_count }} {{ __('Places') }}</span>
                                </a>
                            </div>
                        @endforeach

                    </div>
                    <div class="place-slider__nav slick-nav">
                        <div class="place-slider__prev slick-nav__prev">
                            <i class="las la-angle-left"></i>
                        </div><!-- .place-slider__prev -->
                        <div class="place-slider__next slick-nav__next">
                            <i class="las la-angle-right"></i>
                        </div><!-- .place-slider__next -->
                    </div><!-- .place-slider__nav -->
                </div>
            </div>
        </div><!-- .business-category -->

        <div class="trending trending-business">
            <div class="container">
                <h2 class="title title-border-bottom align-center">{{ __('Suggested Places by Visitors Reviews') }}</h2>
                <div class="slick-sliders">
                    <div class="slick-slider trending-slider slider-pd30" data-item="4" data-arrows="true"
                        data-itemScroll="4" data-dots="true" data-centerPadding="30" data-tabletitem="2"
                        data-tabletscroll="2" data-smallpcscroll="3" data-smallpcitem="3" data-mobileitem="1"
                        data-mobilescroll="1" data-mobilearrows="false">

                        @foreach ($trending_places as $place)
                            <div class="place-item layout-02">
                                <div class="place-inner">
                                    <div class="place-thumb">
                                        <a class="entry-thumb" href="{{ route('place_detail', $place->slug) }}"><img
                                                src="{{ getImageUrl($place->thumb) }}" alt="{{ $place->name }}"></a>
                                        <a href="#"
                                            class="golo-add-to-wishlist btn-add-to-wishlist @if ($place->wish_list_count) remove_wishlist active @else @guest open-login @else add_wishlist @endguest @endif"
                                            data-id="{{ $place->id }}">
                                            <span class="icon-heart">
                                                <i class="la la-bookmark large"></i>
                                            </span>
                                        </a>
                                        @if (isset($place['categories'][0]))
                                            <a class="entry-category rosy-pink"
                                                href="{{ route('page_search_listing', ['category[]' => $place['categories'][0]['id']]) }}"
                                                style="background-color:{{ $place['categories'][0]['color_code'] }};">
                                                <img src="{{ getImageUrl($place['categories'][0]['icon_map_marker']) }}"
                                                    alt="{{ $place['categories'][0]['name'] }}">
                                                <span>{{ $place['categories'][0]['name'] }}</span>
                                            </a>
                                        @endif
                                    </div>
                                    <div class="entry-detail">
                                        <div class="entry-head">
                                            <div class="place-type list-item">
                                                @foreach ($place['place_types'] as $type)
                                                    <span>{{ $type->name }}</span>
                                                @endforeach
                                            </div>
                                            <div class="place-city">
                                                <a
                                                    href="{{ route('page_search_listing', ['city[]' => $place['city']['id']]) }}">{{ $place['city']['name'] }}</a>
                                            </div>
                                        </div>
                                        <h3 class="place-title"><a
                                                href="{{ route('place_detail', $place->slug) }}">{{ $place->name }}</a>
                                        </h3>
                                        <div class="entry-bottom">
                                            <div class="place-preview">
                                                <div class="place-rating">
                                                    @if ($place->reviews_count)
                                                        {{ number_format($place->avgReview, 1) }}
                                                        <i class="la la-star"></i>
                                                    @endif
                                                </div>
                                                <span class="count-reviews">({{ $place->reviews_count }}
                                                    {{ __('reviews') }})</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="place-slider__nav slick-nav">
                        <div class="place-slider__prev slick-nav__prev">
                            <i class="las la-angle-left"></i>
                        </div><!-- .place-slider__prev -->
                        <div class="place-slider__next slick-nav__next">
                            <i class="las la-angle-right"></i>
                        </div><!-- .place-slider__next -->
                    </div><!-- .place-slider__nav -->
                </div>
            </div>
        </div><!-- .trending -->

        @guest
        <div class="trending trending-business">
            <div class="container">
                <h2 class="title title-border-bottom align-center red-message">{{ __('Log in to view personalized suggestions!') }}</h2>
            </div>
        </div>
        @else
            <div class="trending trending-business">
                <div class="container">
                    <h2 class="title title-border-bottom align-center">{{ __('Suggested Places by your Searches') }}</h2>
                    <div class="slick-sliders">
                        <div class="slick-slider trending-slider slider-pd30" data-item="4" data-arrows="true"
                            data-itemScroll="4" data-dots="true" data-centerPadding="30" data-tabletitem="2"
                            data-tabletscroll="2" data-smallpcscroll="3" data-smallpcitem="3" data-mobileitem="1"
                            data-mobilescroll="1" data-mobilearrows="false">

                            @foreach ($favorite_places as $place)
                                <div class="place-item layout-02">
                                    <div class="place-inner">
                                        <div class="place-thumb">
                                            <a class="entry-thumb" href="{{ route('place_detail', $place->slug) }}"><img
                                                    src="{{ getImageUrl($place->thumb) }}" alt="{{ $place->name }}"></a>
                                            <a href="#"
                                                class="golo-add-to-wishlist btn-add-to-wishlist @if ($place->wish_list_count) remove_wishlist active @else @guest open-login @else add_wishlist @endguest @endif"
                                                data-id="{{ $place->id }}">
                                                <span class="icon-heart">
                                                    <i class="la la-bookmark large"></i>
                                                </span>
                                            </a>
                                            @if (isset($place['categories'][0]))
                                                <a class="entry-category rosy-pink"
                                                    href="{{ route('page_search_listing', ['category[]' => $place['categories'][0]['id']]) }}"
                                                    style="background-color:{{ $place['categories'][0]['color_code'] }};">
                                                    <img src="{{ getImageUrl($place['categories'][0]['icon_map_marker']) }}"
                                                        alt="{{ $place['categories'][0]['name'] }}">
                                                    <span>{{ $place['categories'][0]['name'] }}</span>
                                                </a>
                                            @endif
                                        </div>
                                        <div class="entry-detail">
                                            <div class="entry-head">
                                                <div class="place-type list-item">
                                                    @foreach ($place['place_types'] as $type)
                                                        <span>{{ $type->name }}</span>
                                                    @endforeach
                                                </div>
                                                <div class="place-city">
                                                    <a
                                                        href="{{ route('page_search_listing', ['city[]' => $place['city']['id']]) }}">{{ $place['city']['name'] }}</a>
                                                </div>
                                            </div>
                                            <h3 class="place-title"><a
                                                    href="{{ route('place_detail', $place->slug) }}">{{ $place->name }}</a>
                                            </h3>
                                            <div class="entry-bottom">
                                                <div class="place-preview">
                                                    <div class="place-rating">
                                                        @if ($place->reviews_count)
                                                            {{ number_format($place->avgReview, 1) }}
                                                            <i class="la la-star"></i>
                                                        @endif
                                                    </div>
                                                    <span class="count-reviews">({{ $place->reviews_count }}
                                                        {{ __('reviews') }})</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="place-slider__nav slick-nav">
                            <div class="place-slider__prev slick-nav__prev">
                                <i class="las la-angle-left"></i>
                            </div><!-- .place-slider__prev -->
                            <div class="place-slider__next slick-nav__next">
                                <i class="las la-angle-right"></i>
                            </div><!-- .place-slider__next -->
                        </div><!-- .place-slider__nav -->
                    </div>
                </div>
            </div><!-- .trending -->

            <div class="trending trending-business">
                <div class="container">
                    <h2 class="title title-border-bottom align-center">{{ __('Suggested Places by your Wishlist') }}</h2>
                    <div class="slick-sliders">
                        <div class="slick-slider trending-slider slider-pd30" data-item="4" data-arrows="true"
                            data-itemScroll="4" data-dots="true" data-centerPadding="30" data-tabletitem="2"
                            data-tabletscroll="2" data-smallpcscroll="3" data-smallpcitem="3" data-mobileitem="1"
                            data-mobilescroll="1" data-mobilearrows="false">

                            @foreach ($wishlist_places as $place)
                                <div class="place-item layout-02">
                                    <div class="place-inner">
                                        <div class="place-thumb">
                                            <a class="entry-thumb" href="{{ route('place_detail', $place->slug) }}"><img
                                                    src="{{ getImageUrl($place->thumb) }}" alt="{{ $place->name }}"></a>
                                            <a href="#"
                                                class="golo-add-to-wishlist btn-add-to-wishlist @if ($place->wish_list_count) remove_wishlist active @else @guest open-login @else add_wishlist @endguest @endif"
                                                data-id="{{ $place->id }}">
                                                <span class="icon-heart">
                                                    <i class="la la-bookmark large"></i>
                                                </span>
                                            </a>
                                            @if (isset($place['categories'][0]))
                                                <a class="entry-category rosy-pink"
                                                    href="{{ route('page_search_listing', ['category[]' => $place['categories'][0]['id']]) }}"
                                                    style="background-color:{{ $place['categories'][0]['color_code'] }};">
                                                    <img src="{{ getImageUrl($place['categories'][0]['icon_map_marker']) }}"
                                                        alt="{{ $place['categories'][0]['name'] }}">
                                                    <span>{{ $place['categories'][0]['name'] }}</span>
                                                </a>
                                            @endif
                                        </div>
                                        <div class="entry-detail">
                                            <div class="entry-head">
                                                <div class="place-type list-item">
                                                    @foreach ($place['place_types'] as $type)
                                                        <span>{{ $type->name }}</span>
                                                    @endforeach
                                                </div>
                                                <div class="place-city">
                                                    <a
                                                        href="{{ route('page_search_listing', ['city[]' => $place['city']['id']]) }}">{{ $place['city']['name'] }}</a>
                                                </div>
                                            </div>
                                            <h3 class="place-title"><a
                                                    href="{{ route('place_detail', $place->slug) }}">{{ $place->name }}</a>
                                            </h3>
                                            <div class="entry-bottom">
                                                <div class="place-preview">
                                                    <div class="place-rating">
                                                        @if ($place->reviews_count)
                                                            {{ number_format($place->avgReview, 1) }}
                                                            <i class="la la-star"></i>
                                                        @endif
                                                    </div>
                                                    <span class="count-reviews">({{ $place->reviews_count }}
                                                        {{ __('reviews') }})</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="place-slider__nav slick-nav">
                            <div class="place-slider__prev slick-nav__prev">
                                <i class="las la-angle-left"></i>
                            </div><!-- .place-slider__prev -->
                            <div class="place-slider__next slick-nav__next">
                                <i class="las la-angle-right"></i>
                            </div><!-- .place-slider__next -->
                        </div><!-- .place-slider__nav -->
                    </div>
                </div>
            </div><!-- .trending -->
        @endguest

        <div class="featured-cities">
            <div class="container">
                <h2 class="title title-border-bottom align-center">
                    {{ __('Featured Cities') }}<span>{{ __("Choose the city you'll be living in next") }}</span></h2>
                <div class="slick-sliders">
                    <div class="slick-slider featured-slider slider-pd30" data-item="4" data-arrows="true"
                        data-itemScroll="4" data-dots="true" data-centerPadding="30" data-tabletitem="2"
                        data-tabletscroll="2" data-mobileitem="1" data-mobilescroll="1" data-mobilearrows="false">

                        @foreach ($popular_cities as $city)
                            <div class="slick-item">
                                <div class="cities__item hover__box">
                                    <div class="cities__thumb hover__box__thumb">
                                        <a title="London"
                                            href="{{ route('page_search_listing', ['city[]' => $city->id]) }}">
                                            <img src="{{ getImageUrl($city->thumb) }}" alt="{{ $city->name }}">
                                        </a>
                                    </div>
                                    <h4 class="cities__name">{{ $city['country']['name'] }}</h4>
                                    <div class="cities__info">
                                        <h3 class="cities__capital">{{ $city->name }}</h3>
                                        <p class="cities__number">{{ $city->places_count }} {{ __('places') }}</p>
                                    </div>
                                </div><!-- .cities__item -->
                            </div>
                        @endforeach

                    </div>
                    <div class="place-slider__nav slick-nav">
                        <div class="place-slider__prev slick-nav__prev">
                            <i class="las la-angle-left"></i>
                        </div><!-- .place-slider__prev -->
                        <div class="place-slider__next slick-nav__next">
                            <i class="las la-angle-right"></i>
                        </div><!-- .place-slider__next -->
                    </div><!-- .place-slider__nav -->
                </div>
            </div>
        </div><!-- .featured-cities -->

    </main><!-- .site-main -->
@stop
