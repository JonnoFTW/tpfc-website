<div class="grid_9">
<div class="box">
<?
echo heading("View User",2);
echo $msg;
echo "<div id='login-forms'>";
echo form_open('admin/users/update_user/'.$uid);
echo form_fieldset('Edit User');
$fields = array('first name','last name','phone','email');
foreach($fields as $v) {
    echo "<p>";
    $u = str_replace(' ','_',$v);
    $value = $user[$u];
    echo form_label(ucwords($v),$u);
    echo form_input($u,$value);
    echo "</p>";
}
echo "<p>";
echo form_label('List Person as Contact');
echo form_checkbox('contact','contact',true==$user['contact']);
echo "</p>";
echo "<p>";
echo form_submit('submit','Save');
echo "</p>";
echo form_fieldset_close();
echo form_close();

echo form_open('admin/users/delete/'.$uid);
echo form_fieldset('Delete User');
echo "<p>";
echo form_submit('delete','Delete User');
echo "</p>";
echo form_fieldset_close();
echo form_close();
?>
</div>
</div>
</div>