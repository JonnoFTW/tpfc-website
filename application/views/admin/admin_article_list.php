<div class="col-md-9">
<div class="panel panel-default">
<div class="panel-heading">
Which Page Would you Like to edit?
</div>
<div class="panel-body">
<? echo $msg; ?>
<?
echo $article_list_edits; 
?>
<?
echo heading("Make a New Page",2);
if(isset($msg))
    echo $msg;
echo "<div id='login-forms'>";
echo form_open('admin/article/new_page');
echo form_fieldset('New Page');
echo "<p>";
echo form_label("New title",'title');
echo form_input('title');
echo "</p>";
echo "<p>";
echo form_label('Parent Article','parent');
echo form_dropdown('parent',$parents);
echo "</p>";
echo "<p>";
echo form_submit('submit','Create');
echo "</p>";
echo form_fieldset_close();
echo form_close();
?>
</div>
</div>
</div>
