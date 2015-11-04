<script type="text/javascript" src=
"https://maps.googleapis.com/maps/api/js?key=AIzaSyDX2D42AuYwSEcYb6056DkYSCTvn8bRvMo&sensor=false"></script>
<script type="text/javascript">
(function initialize() {
  var pointLNG = <? echo $LOCATION_X; ?>;
  var pointLAT = <? echo $LOCATION_Y; ?>;
  var point = new google.maps.LatLng(pointLAT,pointLNG);
  var mapOpts = {
    center: point,
    zoom: 14,
    mapTypeId: google.maps.MapTypeId.HYBRID
  };
  var map  = new google.maps.Map(document.getElementById("map_canvas"),mapOpts);
  var club = new google.maps.Marker({position:point,title:'Trott Park Fencing Club'});
  club.setMap(map);

})();
</script>