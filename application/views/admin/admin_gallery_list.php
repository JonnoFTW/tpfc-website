<div class="col-md-9">
<div class="box">
<h2>Which Gallery Would you Like to edit?</h2>
<ul>
<?
foreach($gallery as $i){
    echo "<li>".anchor("admin/gallery/gid/{$i['gid']}",$i['title'])."</li>";
}
echo "</ul>";

?></div><div class="box"><?
echo heading("Make a New Gallery",2);
echo "<div id='login-forms'>";
echo form_open('admin/gallery/new_gallery');
echo form_hidden('gallery','gallery');
echo form_fieldset('New Gallery');
echo "<p>";
echo form_label("Title",'title');
echo form_input('title');
echo "</p>";
echo "<p>";
echo form_label("Description",'descr');
echo form_input('descr');
echo "</p>";
echo "<p>";
echo form_submit('submit','Create');
echo "</p>";
echo form_fieldset_close();
echo form_close();
?>
</div>
</div>
</div>