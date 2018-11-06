<div class="col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <? echo anchor('admin/store', 'Store') ?> - <? echo anchor("admin/store/items", "Items"); ?> - <? echo $item['name'];?>
        </div>
        <div class="panel-body">
            <form>
            <?
                foreach(['name','item_description'] as $f) {
                    echo '<div class="form-group">';
                    echo form_label(ucwords(str_replace('_',' ', $f)), $f);
                    echo form_input($f, $item[$f], ['class'=>'form-control']);
                    echo '</div>';
                }
            ?>
            <div class="form-group">
               <label class="btn btn-primary" for="my-file-selector">
                <input id="my-file-selector" type="file" style="display:none"  accept="image/*"
                onchange="$('#upload-file-info').html(this.files[0].name)">
                Select Image
                </label>
                <span class='label label-info' id="upload-file-info"></span>
                <img src="https://placem.at/things?w=200&h=200&" class="img-rounded rounded img-fluid" alt="Product Image"/>
            
            </div>
            <div class="form-group">

                <? echo form_label("Category", 'category_id')?>
                <? echo form_dropdown('category_id', $categories, [$item['category_id']], ['class'=>'form-control']); ?>
            </div>
             <div class="form-group">
                
                <? echo form_label("Attributes", 'attributes')?>
                <?
                    $all_attrs = [];
                    foreach($all_attributes as $a) {
                        $all_attrs[$a['id']] = $a['attribute'];
                    }
                ?>
                <? echo form_dropdown('category', $all_attrs, array_column($attributes, 'attribute_id'), ['class'=>'form-control select2']); ?>
            </div>
            <button role="submit" class="btn btn-primary">Save</button>
        
            </form>
        </div>
    </div>
</div>
<script>
$('.select2').select2({multiple: true});
</script>
