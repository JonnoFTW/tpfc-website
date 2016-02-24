<div class="col-md-9">

<div class="panel panel-default">
<div class="panel-heading">
User Guide
</div>
<div class="panel-body">
<h3>Updating Pages</h3>
<p>
Select the page you wish to update from the menu on the side. The content of the page will appear in the center area.
Make your changes to the content and then press the save button at the bottom. Your changes will now be saved and the date of the update will be listed when the page is accessed normally.
</p>
<h3>Adding a New Gallery</h3>
<ol>
<li>Click the gallery link from the side menu</li>
<li>Use the "Make a new Gallery" form to give a title and description to the new gallery</li>
<li>You will then be taken to a page where you can upload images, remove images, or update the descriptions of existing images in that gallery</li>
</ol>
<h3>To update an existing gallery</h3>
<ol>
<li>Select the gallery you wish to edit from the side menu or the gallery page</li>
<li>Follow step 3 from above</li>
</ol>
</ol>

<?
echo heading("Update the Club Location and Email",2);
?>
<div class="clear"></div>
<p>
This will update the contact email for the club and the location of the club shown on the map on the training page. To update the location:

<ol>
<li>Click the new location on the map below</li>
<li>Click the save button</li>
</ol>
<? echo $msg; ?>
</p>
<?
echo form_open('admin/home/update_info',['class'=>'form-horizontal']);
echo form_fieldset('Update Club Info');
echo "<div class='form-group'>";
echo form_label('Email','email',['class'=>'control-label col-sm-2']);
echo '<div class="col-sm-10">';
echo form_input(['name'=>'email','value'=>$email, 'class'=>'form-control']);
echo "</div></div>";
echo "<div class='form-group'>";
echo form_label('Latitude','lat',['class'=>'control-label col-sm-2']);
echo '<div class="col-sm-10">';
echo form_input(['name'=>'lat','value'=>$LOCATION_Y, 'class'=>'form-control']);
echo "</div></div>";
echo "<div class='form-group'>";
echo form_label('Longtidue','lng',['class'=>'control-label col-sm-2']);
echo '<div class="col-sm-10">';
echo form_input(['name'=>'lng','value'=>$LOCATION_X,'class'=>'form-control']);
echo "</div></div>";
echo "<div class='form-group'>";
echo '<div class="col-sm-offset-2 col-sm-10">';
echo form_submit(['name'=>"submit", 'content'=>'Submit', 'value'=>"Submit", 'class'=>'btn btn-default']);
echo "</div>";
echo form_close();
?>
</div>
</div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-map fa-fw"></i> Select a new club location
    </div>
    <div class="panel-body">
        <div style="height:600px" id="map"></div>
    </div>
    <!-- /.panel-body -->
</div>
<script>
$(document).ready(function() {
var newNodeMarker = null;
     var lat =<? echo $LOCATION_Y; ?>,
        lng =<? echo $LOCATION_X; ?>;
var map = new GMaps({
    lat: lat,
    lng: lng,
     div: '#map',
     zoom: 15,
     click: function(e) {
         if (newNodeMarker != null)
            newNodeMarker.setMap(null);
         var targetLat = e.latLng.lat(),
             targetLng = e.latLng.lng();
         $('input[name="lat"]').val(targetLat);
         $('input[name="lng"]').val(targetLng);
         newNodeMarker = map.addMarker({
             lat: targetLat,
             lng: targetLng,
             title: "TPFC will be moved here",
             infoWindow: {
                content: 'TPFC will be moved here'
            }
         });

     }
 });
  newNodeMarker = map.addMarker({
      lat: lat,
      lng: lng,
      title: "Current Location",
      infoWindow: {
        content: 'TPFC is right here'
      }
  });
});
</script>
