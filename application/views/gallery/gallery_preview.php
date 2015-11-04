<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// Previewing all images in a gallery
?>
<div class="col-md-12">
<div class="box">
<?
echo "<p>$gdescription</p>";
//var_dump($images);
echo $image_table;
/*
foreach($images as $i) { 
 echo "<div class='grid_2 box'>\n";
 $img = img('assets/images/thumbs/'.$i['link']).'<br/>'.character_limiter($i['description'],40);
 echo anchor('gallery/view/'.$i['gid'].'/'.$i['iid'],$img);
 echo "\n</div>\n";
}
*/
 ?>
</div>
</div>

