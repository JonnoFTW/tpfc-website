<div class="col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <? echo anchor('admin/store', 'Store') ?> - Attributes
        </div>
        <div class="panel-body">
            <p>These attributes can be applied to any item in the store. It allows different items to share the same attributes</p>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Attribute</th>
                        <th>Values</th>
                    </tr>
                </thead>
                <tbody id="attr-table">
                
                    <?
                        foreach($attributes as $attr_id => $attr_values) {
                            $title = $attribute_names[$attr_id];
                            echo "<tr id='$attr_id' data-attribute-id='$attr_id' data-name='$title'><td class='col-md-2'>".title($title)."</td>";
                            echo "<td>".form_dropdown($attr_id,$attr_values, array_keys($attr_values), ['class'=>'form-control attr-input'])."</td>";
                            echo "</tr>";
                        }
                    ?>
                    
                </tbody>
            </table>
            <button role="button" class="btn btn-success" id="add-attr">Add Attribute</button>
            <button role="button" class="btn btn-primary" id="save-btn">Save</button>
        </div>
    </div>
</div>
<script type="text/javascript">
    var selects = function() {
        $('.attr-input').select2({multiple: true, tags: true});
        $('.name-col').change(function() {
            $this = $(this);
            $this.parent().parent().data('name', $this.val());
        });
    };
    selects();
    $('#add-attr').click(function() {
        $("#attr-table").append("<tr><td class='col-md-2'><input class='form-control name-col' type='text' placeholder='Attribute Name'/></td><td><select class='attr-input form-control'></select></td></tr>");
        selects();
    });
    $('#save-btn').click(function() {
        var data = {};
        $('#attr-table > tr').each(function() {
            var vals = [];
            $(this).find('.attr-input').first().select2('data').forEach(function(attr) {
                var obj = {};
                console.log(attr);
                ['id','selected','text'].forEach(function(e) {

                    obj[e] = attr[e];
                });
                vals.push(obj); 
            });
            data[$(this).data('name')] = vals;
        });
        $.post('/admin/store/update_attrs', data, function(res) {
            console.log(res);
        }).fail(function(err) {
            console.log(err);
        });
    });

</script>
