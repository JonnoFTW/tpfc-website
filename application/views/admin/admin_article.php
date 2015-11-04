<div class="grid_9">
<div class="box">
<!--<script src="<? echo base_url();?>assets/scripts/nicEdit.js" type="text/javascript"></script>-->
<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> 
<script type="text/javascript">
bkLib.onDomLoaded(function() {
    new nicEditor({buttonList:['bold','italic','ol','ul','subscript','superscript','indent','image','link','removeformat','fontFormat','xhtml']}).panelInstance('edit');
});

</script>
						
<?
echo "<h2>Now editing: {$article['title']}</h2>"; 
echo $msg;
echo form_open("admin/article/edit/{$article['title']}");
echo "<p>";
echo form_textarea(array('value'=>$article['article'],'cols'=>'82','id'=>'edit','name'=>'article'));
echo "</p>";
if(!$article['permanent']) {
    echo "<p>";
    echo form_label('Title','title');
    echo form_input('title',$article['title']);
    echo "</p>";
    echo "<p>";
    echo form_label('Parent Article','parent');
    echo form_dropdown('parent',$parents,$article['parent']);
    echo "</p>";
    echo "<p>";
    echo form_label('Permanently Delete this Article','Delete');
    echo form_checkbox('delete',"delete");
    echo "</p>";
}
echo form_submit('save','Save');
echo form_close();
?>
</div>
</div>