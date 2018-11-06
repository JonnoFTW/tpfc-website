<div class="col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <? echo anchor('admin/store', 'Store') ?> - <? echo anchor("admin/store/categories", "Categories") ?>
        </div>
        <div class="panel-body">
            <? echo heading($category['category_name'], 3); ?>
            <form method='post'>
            <?
                foreach(['category_name', 'description'] as $f){
                    echo '<div class="form-group">';
                    echo form_label(title($f), $f);
                    echo form_input($f, $category[$f], ['class'=>'form-control']);
                    echo "</div>";
                }
            ?>

            <button type="submit" class="btn btn-primary" role="button">Save</button>

            </form>
        </div>
    </div>
</div>
