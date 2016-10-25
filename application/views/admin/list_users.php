<div class="col-md-9">
<div class="panel panel-default">
<div class="panel-heading">
Which User Would You Like to Manage?
</div>
<?
$this->table->set_template([ 'table_open'  => '<table class="table table-striped table-bordered table-condensed">']);
$this->table->set_heading(array('Name','Email','Phone',"Reset Password"));
foreach($users as $v) {
    $resetbtn = form_open("admin/users/resetPassword/{$v['uid']}", ['class'=>'form-inline', 'style'=>'margin-bottom:0px;']).form_submit(['value'=>"Reset ",'name'=>"reset",'class'=>'btn btn-danger']).form_close();
    $this->table->add_row(array(
        anchor('admin/users/user/'.$v['uid'],
        "{$v['first_name']} {$v['last_name']}"),
        $v['email'],$v['phone'],
        $resetbtn));
};
echo $this->table->generate();
if(isset($msgreset))
    echo $msgreset;
?>
</div>
</div>
