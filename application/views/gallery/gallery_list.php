<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>

<div class="grid_12"> 

<div class="box">
<h2>Galleries</h2>
<ul>
<?
foreach($galleries as $i){
    echo '<li><h5>'.anchor('gallery/view/'.$i['gid'],$i['title']).'</h5> <p>'.$i['description'].'</p></li>';
}
?>
</ul>
All images appear here with the given consent of those persons that appear within them.
</div>
</div>
