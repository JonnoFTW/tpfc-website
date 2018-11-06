<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>

<div class="col-md-9"> 

    <div class="panel panel-default">
        <div class="panel-heading">Categories</div>
        <div class="panel-body">
            <ul>
            <?
            foreach($categories as $i){
                echo '<li><h4>'.anchor('store/cat/'.$i['category_id'],$i['category_name']).'</h4> <p>'.$i['description'].'</p></li>';
            }
            ?>
            </ul>
        </div>
    </div>
</div>
