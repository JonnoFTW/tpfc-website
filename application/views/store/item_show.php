<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>

<div class="col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading"><?echo (anchor('/store/cat/'.$item['category_id'], $item['category_name'])." - {$item['name']}"); ?></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <img src="https://placem.at/things?w=400&h=400&" class="img-rounded rounded img-fluid" alt="Product Image">
                </div>
                <div class="col-md-6">
                    <p><? echo($item['item_description']); ?></p>
                    <?
                    if($this->session->userdata('logged')) {
                        echo anchor("/admin/store/edit_item/{$item['id']}", "Edit");
                    }
                    ?>
                    <form>
                        <?
                        foreach($attributes as $a=>$v) {
                            echo '<div class="form-group">';
                            echo form_label(title($a),$a);
                            echo form_dropdown($a, $v, [], ['class'=>'form-control']); 
                            echo "</div>";
                        }
                        ?>
                        <div class="form-group">
                            <label for="quantity">Quantity:</label>
                            <input name="quantity" class="form-control" type="number" value="1" min="0" max="10"/>
                        </div>
                    <? // For each available attribute, list the possible values ?>
                         <h5>Price: <? echo price($item['price']);?></h5>
                        <div class="form-group">
                            <button role="button" class="btn btn-primary">Add to cart</button>
                        </div>
                  </form>
              </div>
           </div>
        </div>
    </div>
</div>
