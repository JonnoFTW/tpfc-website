<div class="col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
        <? echo anchor('admin/store', 'Store Admin') ?> 
        </div>
        <div class="panel-body">
            <ul>
                <li><? echo anchor("/admin/store/categories", "Manage Categories"); ?></li>
                <li><? echo anchor("/admin/store/items", "Manage Items"); ?></li>
                <li><? echo anchor("/admin/store/attributes", "Manage Attributes"); ?></li>
                <li><? echo anchor("/admin/store/orders", "Manage Orders"); ?></li>
            </ul>
        </div>
    </div>
</div>
