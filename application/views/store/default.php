<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>

<div class="col-md-3">
    <div class="panel panel-primary">
        <div class="list-group">
            <a href="/store" class="list-group-item"><h4 class="list-group-item-heading">Categories</h4></a>
            <ul class="list-group">
            
             <? foreach($categories as $i){echo "<li class='list-group-item'>".anchor('store/cat/'.$i['category_id'],$i['category_name'])."</li>";} ?>
             </ul>
        </div>
        <a href="/store/checkout" class="list-group-item"><h4 class="list-group-item-heading">Checkout</h4></a>
        <ul class="list-group">
            <li class="list-group-item">Expensive item <span class="pull-right">$5</span></li>
            <li class="list-group-item"><b>Total</b><span class="pull-right">$400</span></li>
        </ul>
        
    </div>
</div>
