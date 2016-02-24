<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>

<div class="col-md-12"> 

<div class="box">
<ul>
<?
foreach($galleries as $i){
    echo '<li><h4>'.anchor('gallery/view/'.$i['gid'],$i['title']).'</h4> <p>'.$i['description'].'</p></li>';
}
?>
</ul>
All images appear here with the given consent of those persons that appear within them.
</div>
</div>
