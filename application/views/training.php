<script type="text/javascript" src=
"https://maps.googleapis.com/maps/api/js?key=AIzaSyDX2D42AuYwSEcYb6056DkYSCTvn8bRvMo"></script>

<script type="text/javascript">
(function initialize() {
  var pointLNG = <? echo $LOCATION_X; ?>;
  var pointLAT = <? echo $LOCATION_Y; ?>;
  var point = new google.maps.LatLng(pointLAT,pointLNG);
  var mapOpts = {
    center: new google.maps.LatLng(-35.070891,138.532675),
    zoom: 16,
    mapTypeId: google.maps.MapTypeId.ROAD
  }; var contentString = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h3 id="firstHeading" class="firstHeading">Trott Park Fencing Club</h3>'+
      '<div id="bodyContent">'+
      '<b>TPFC</b>, meets at 7 PM on Wednesdays during <br>school terms in the gym ' +
      ' at Sheidow Park Primary School'+
      '</div>'+
      '</div>';

  var maps = document.getElementsByClassName('map_canvas');
  for(var i =0; i <maps.length; i++) {
      var map  = new google.maps.Map(maps[i] ,mapOpts);
      var club = new google.maps.Marker({position:point,title:'Trott Park Fencing Club'});
      club.setMap(map);

      var infowindow = new google.maps.InfoWindow({
        content: contentString
      });

      club.addListener('click', function() {
        infowindow.open(map, club);
        console.log(map.getCenter().toUrlValue());
      });
      infowindow.open(map, club);
  }
  
  
  
})();
</script>
