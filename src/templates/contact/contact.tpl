<!-- css -->
<link rel="stylesheet" type="text/css" href="templates/contact/contact.css"/>
<!-- contact page -->
<div class="container contact-page">
  <h1 class="display-2 text-center">Contact</h1>
  
  <div class="row justify-content-center">
    <div class="container text col-6">
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
    <div class="col-4" id="map" style="width:100%;">
       <script>  
          function myMap() {
          var mapOptions = {
          center: new google.maps.LatLng(51.5, -0.12),
          zoom: 10,
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
