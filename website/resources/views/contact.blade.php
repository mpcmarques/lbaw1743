@extends ('layouts.app')

@section('title', 'Contact')

@section('content')

<div id="contact" class="container contact-page">
    <h1 class="text-center">Contact</h1>


    <div class="row justify-content-center">
        <div class="container-fluid text col-md-6">
            <p>
                Hi! Here's how and where you can reach us:
            </p>
            <p>
                Email: support@plenum.com
            </p>
            <p>
                Telephone: 223 675 890
            </p>
            <p>
                Feel free to visit us at:
            </p>
        </div>
        <div class="col-md-4" id="map">
            <script>
                function myMap() {
                    var mapOptions = {
                        center: new google.maps.LatLng(41.1779222,-8.5977577),
                        zoom: 18,
                        mapTypeId: google.maps.MapTypeId.HYBRID
                    }
                    var map = new google.maps.Map(document.getElementById("map"), mapOptions);
                }
            </script>
            <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDg-dL9OBc70icOOetIjeMoESbT9d2vIc0&language=pt&region=PT&callback=myMap">
        </script>

    </div>
</div>
</div>

@endsection
