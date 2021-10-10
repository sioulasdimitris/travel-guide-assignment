@extends('admin.layouts.template')

@section('main')
    <div class="page-title">
        <div class="title_left">
            <h3>Place create</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_content">
                    <div class="col-lg-3">
                        <ul class="nav nav-tabs tabs-left place_create_menu">
                            <li class=""><a href="#genaral">Genaral</a></li>
                            <li class=""><a href="#hightlight">Hightlight</a></li>
                            <li class=""><a href="#location">Location</a></li>
                            <li class=""><a href="#contact_info">Contact info</a></li>
                            <li class=""><a href="#social_network">Social network</a></li>
                            <li class=""><a href="#opening_hours">Open hourses</a></li>
                            <li class=""><a href="#menus">Menu</a></li>
                            <li class=""><a href="#media">Media</a></li>
                            <li class=""><a href="#link_affiliate">Booking link</a></li>
                            <li class=""><a href="#golo_seo">Golo SEO</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-8 col-xs-12 place_create">
                        @if($place)
                            @include('admin.place.form_edit')
                        @else
                            @include('admin.place.form_create')
                        @endif
                    </div>
                    <div class="clearfix"></div>
                </div>

            </div>
        </div>
    </div>
@stop

@push('scripts')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    @if(setting('map_service', 'google_map') === 'google_map')
        <script src="{{asset('admin/js/page_place_create.js')}}"></script>
    @else
        <script src='https://api.mapbox.com/mapbox-gl-js/v2.0.1/mapbox-gl.js'></script>
        <link href='https://api.mapbox.com/mapbox-gl-js/v2.0.1/mapbox-gl.css' rel='stylesheet' />
        <!-- Load the `mapbox-gl-geocoder` plugin. -->
        <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.2/mapbox-gl-geocoder.min.js"></script>
        <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.2/mapbox-gl-geocoder.css" type="text/css">
         
        <!-- Promise polyfill script is required -->
        <!-- to use Mapbox GL Geocoder in IE 11. -->
        <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>
        <script>
            mapboxgl.accessToken = 'pk.eyJ1IjoibWluaHRoZSIsImEiOiJja2phc2l1eWc0OHF1MnJtMGw3ZzFjeXdxIn0.mJAsm20swzej4lWDUBucow';
        </script>
        <script src="{{asset('admin/js/page_place_create_mapbox.js')}}"></script>
    @endif
@endpush