<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>
<div class="col-md-9"> 
    <div class="panel panel-default">
        <div class="panel-heading"><? echo anchor('admin/store', 'Store') ?> - <? echo anchor("admin/store/categories", "Categories"); ?></div>
        <div class="panel-body">
            <ul>
            <?
            foreach($categories as $i){
                echo '<li><h4>'.anchor('admin/store/edit_category/'.$i['category_id'],$i['category_name']).'</h4> <p>'.$i['description'].'</p></li>';
            }
            ?>
            </ul>
            <form method="post"s>
            <div class="form-group">
                <input class="form-control" placeholder="Name">
                                <input class="form-control" placeholder="Description">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
            </form>
        </div>
    </div>
</div>
