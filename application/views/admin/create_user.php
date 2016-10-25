<div class="col-md-9">
<div class="panel panel-default">
<div class="panel-heading">
Create User
</div>
<?
echo $msg;
echo form_open('admin/users/new_user/', ['class'=>'form-horizontal']);
$fields = array('first name','last name','phone','email');
foreach($fields as $v) {
    echo "<div class='form-group'>";
    $u = str_replace(' ','_',$v);
    echo form_label(ucwords($v),$u, ['class'=>'col-sm-2 control-label']);
    echo form_input(['name'=>$u,'class'=>'form-control col-sm-7']);
    echo "</div>";
}
echo form_label('List Person as Contact');
echo form_checkbox('contact','contact',false);
echo form_submit('submit','Save');
echo form_close();
?>
</div>
</div>
