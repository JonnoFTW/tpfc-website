<div class="col-md-9">
<div class="box">
<?
echo heading("Managing Gallery:{$gtitle['title']}",2);
echo "Set new title/description here";
echo "View images in gallery, with checkboxes to delete, image descriptions can also be updated";
 foreach($images as $i){
    echo img($i['iid']); //Something to change it's possibly null description too
} ?>
</div>
</div>
