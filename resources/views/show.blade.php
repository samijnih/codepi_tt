@extends('layout.master')

@section('content')
    <div class="row">
        <!-- Artist -->
        <div id="artist-show">
            <a href="{{ route('index') }}" class="pull-right m-t-30 return-to-index">{{ trans('show.return_to_index') }}</a>
            <h2>{{ $show->artist->name }} {{ trans('show.show_header_at') }} {{ $show->place }} {{ trans('show.show_header_separator') }} {{ $show->city }}</h2>

            <div class="artist-cover m-t-30" style="background-image: url({{ $show->artist->image }})"></div>

            <div class="artist-description m-t-30">
                <p>{{ $show->artist->description }}</p>
            </div>

            <h3>{{ trans('show.artist_videos') }}</h3>

            <!-- YOUTUBE -->
            <div class="embed-responsive embed-responsive-16by9 m-b-30">
                <iframe width="560" height="315" src="" frameborder="0" allowfullscreen class="embed-responsive-item" id="player"></iframe>
            </div>

            <div class="col-lg-12 m-b-30">
                <a href="#" class="pull-right scroll-top">{{ trans('show.go_to_top') }}</a>
                <a href="{{ route('index') }}" class="pull-left">{{ trans('show.return_to_index') }}</a>
            </div>
        </div>

        <!-- Show -->
        <div class="bordered m-t-10" id="show-order">
            <h3>{{ trans('show.order_show_place') }}</h3>

            <p class="">{{ trans('show.order_info') }}</p>

            <div class="col-lg-12">
                <label class="pull-left">
                    {{ trans('show.label_artist') }}
                </label>

                <p class="pull-right">{{ $show->artist->name }}</p>
            </div>

            <div class="col-lg-12">
                <label class="pull-left">
                    {{ trans('show.label_date') }}
                </label>

                <p class="pull-right">{{ $show->date }} {{ $show->time }}</p>
            </div>

            <div class="col-lg-12">
                <label class="pull-left">
                    {{ trans('show.label_place') }}
                </label>

                <p class="pull-right">{{ $show->place }}</p>
            </div>

            <div class="col-lg-12">
                <label class="pull-left">
                    {{ trans('show.label_address') }}
                </label>

                <p class="pull-right">{{ $show->address }}</p>
            </div>

            <div class="col-lg-12">
                <label class="pull-left">
                    {{ trans('show.label_city') }}
                </label>
                
                <p class="pull-right" id="city">{{ $show->city }}</p>
            </div>

            <div id="map" class="col-lg-12 m-t-10"></div>

            <button type="button" class="btn btn-info col-lg-10 col-lg-offset-1 m-t-20 m-b-30" id="order-button">
                <i class="fa fa-shopping-cart fa-2 m-r-10"></i> <span>{{ trans('show.pre_order_button') }}</span>
            </button>
        </div>
    </div>
@endsection

@section('script')
    {!! Html::script(URL::asset('js/index.js')) !!}
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0HX0kSeMKR_QWBYx-HE-6Wui9zL66ePU" defer></script>
    <script src="https://apis.google.com/js/client.js?onload=onInit" defer></script>
    <script>    
        // YOUTUBE
        function onInit() {
            gapi.client.setApiKey('AIzaSyD0HX0kSeMKR_QWBYx-HE-6Wui9zL66ePU');
            gapi.client.load("youtube", "v3").then(makeRequest);
        }

        function makeRequest() {
            var request = gapi.client.youtube.search.list({
                q: "{{ $show->artist->name }}",
                part: 'snippet',
                type: 'video'
            });

            request.execute(function(response) {
                $("#player").attr("src", "https://www.youtube.com/embed/" + response.result.items[0].id.videoId);
            });
        }
    </script>
@endsection

@section('js')
    $(".scroll-top").click(function () {
        $(this).scrollTop();
    });

    // GMAP
    var geocoder;
    var map;

    geocoder = new google.maps.Geocoder();

    var latlng     = new google.maps.LatLng(-34.397, 150.644);
    var mapOptions = {
        zoom: 15,
        center: latlng
    };

    map = new google.maps.Map(document.getElementById("map"), mapOptions);

    var address = '{{ $show->address }}, {{ $show->city }}, France';

    geocoder.geocode({address: address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);

            var marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location
            });

            $("p#city").append(", " + results[0].address_components[6].short_name);
        } else {
            alert("Geocode was not successful for the following reason: " + status);
        }
    });
@endsection