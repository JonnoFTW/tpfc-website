<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// Previewing all images in a gallery
?>
<div class="col-md-12">
<div class="row">
<?
echo "<p>$gdescription</p>";
//var_dump($images);
//echo $image_table;
$idx = 0;
foreach($images as $i) { 
 echo "<div class='col-md-2 box'><div class='thumbnail'>\n";
 $img = img(['src'=>'assets/images/thumbs/'.$i['link']]).'<div class="caption"><p>'.character_limiter($i['description'],40);
 echo anchor('gallery/view/'.$i['gid'].'/'.$i['iid'],$img);
 echo "</p></div>\n</div>\n</div>";
 $idx++;
 if($idx % 6 === 0) {
	echo "</div><div class='row'>";
}
}

 ?>
</div>
</div>

