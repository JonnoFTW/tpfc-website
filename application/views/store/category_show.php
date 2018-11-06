<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>


<div class="col-md-9"> 

    <div class="panel panel-default">
        <div class="panel-heading">Category: <? echo($category['category_name']); ?></div>
        <div class="panel-body">
            <ul>
            <?
            foreach($items as $i){
                echo '<li><h4>'.anchor('store/item/'.$i['id'],$i['name']).'</h4> <p>'.$i['item_description'].'</p></li>';
            }
            ?>
            </ul>
        </div>
    </div>
</div>
