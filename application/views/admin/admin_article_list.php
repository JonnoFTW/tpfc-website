<div class="grid_9">
<div class="box">
<div class="clear">
<? echo $msg; ?>
</div>
<h2>Which Page Would you Like to edit?</h2>
<ul>
<?
echo $article_list_edits; 
?>
</div>
<div class="box">
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
