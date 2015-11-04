<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// Viewing a specific image
?>

<div class="col-md-10">
<div class="box">
<center>
<?
// Show the image
echo heading($img['title'],3);
echo img(array("src"=>'assets/images/gallery/'.$img['link'],"style"=>"border:1px solid black","alt"=>"")); echo '<br/><p>'.$img['description'].'</p><br/>'; 
// Show the next 2 and previous 2 images as thumbnails.
$iid = 0;
foreach($images as $k=>$v) {
    if($v['iid'] == $img['iid']) {
        $iid = $k;
        break;
    }
}
unset($images[$iid]);
$prev = array_slice($images,$iid-2,4);
//var_dump($prev);
foreach($prev as $v) {
    echo anchor('gallery/view/'.$v['gid'].'/'.$v['iid'],
            img(array(
                "src"=>'assets/images/thumbs/'.$v['link'],
                "style"=>"padding:5px"))
            );
}
echo '<br/>'.anchor('gallery/view/'.$img['gid'],'Back to Gallery');
?>
</center>
</div>
</div>
