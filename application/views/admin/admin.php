<div class="grid_9">
<div class="box">
<h2>User Guide</h2>
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
<li>Go to <a href="maps.google.com">maps.google.com</a></li>
<li>Find the club</li>
<li>Right click on the clubs location and select "What's here?"</li>
<li>The latitude and longitude will appear in the search bar of google maps, copy these 2 values into the form below</li>
<li>Click the save button</li>
</ol>
<? echo $msg; ?>
</p>
<?
echo form_open('admin/home/update_info');
echo form_fieldset('Update Club Info');
echo "<p>";
echo form_label('Email','email');
echo form_input('email',$email);
echo "</p>";
echo "<p>";
echo form_label('Latitude','lat');
echo form_input('lat',$LOCATION_Y);
echo "</p>";
echo "<p>";
echo form_label('Longtidue','lng');
echo form_input('lng',$LOCATION_X);
echo "</p>";
echo "<p>";
echo form_submit("submit","Submit");
echo "</p>";
echo form_close();
?>
</div>
</div>
