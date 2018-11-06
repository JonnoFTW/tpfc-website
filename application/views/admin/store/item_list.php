<div class="col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <? echo anchor('admin/store', 'Store') ?> - Store Items
        </div>
        <div class="panel-body">       
            <?
            $groups = [];
            foreach($items as $i) {
                $groups[anchor("/admin/store/edit_category/{$i['category_id']}",$i['category_name'])][] = anchor("/admin/store/edit_item/{$i['id']}",$i['name']);
            }
             echo ul($groups); 
             ?>
         <div class="form-group">
            <h4>New Item</h4>
            <input type="text" placeholder="Item Name" class="form-control">
            
            <input type="number" class="form-control" placeholder="Cost">
            <button role=button" class="btn btn-primary">Add</button>
         </div>
    </div>
</div>

