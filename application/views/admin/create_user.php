<div class="grid_9">
<div class="box">
<?
echo heading("Create New User",2);
echo $msg;
echo "<div id='login-forms'>";
echo form_open('admin/users/new_user/');
echo form_fieldset('New User');
$fields = array('first name','last name','phone','email');
foreach($fields as $v) {
    echo "<p>";
    $u = str_replace(' ','_',$v);
    echo form_label(ucwords($v),$u);
    echo form_input($u);
    echo "</p>";
}
echo "<p>";
echo form_label('List Person as Contact');
echo form_checkbox('contact','contact',false);
echo "</p>";
echo "<p>";
echo form_submit('submit','Save');
echo "</p>";
echo form_fieldset_close();
echo form_close();
?>
</div>
</div>
</div>