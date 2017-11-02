<div class="col-md-9">
<div class="panel panel-default">
<? /*
<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> 
<script type="text/javascript">
bkLib.onDomLoaded(function() {
    new nicEditor({buttonList:['bold','italic','ol','ul','subscript','superscript','indent','image','link','removeformat','fontFormat','xhtml']}).panelInstance('edit');
});

</script>
*/
?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.min.js"></script> 
<script type="text/javascript">
$(document).ready(function() {
    $('#edit').summernote({
        toolbar: [
            ['style', ['style']],
            ['text', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['para',[ 'ul', 'ol', 'paragraph']],
            ['link', ['linkDialogShow', 'unlink', 'video', 'picture', 'hr']],
            ['misc', ['fullscreen', 'codeview', 'undo', 'redo', 'help']]
        ],

        callbacks: {
            onChange: function(content, editable) {
                console.log('changed');
                $('input[name="article"]').val(content);
            }
        }
    });
});
</script>
<div class="panel-heading">				
<?
echo "Editing: {$article['title']}"; 
?>
</div>
<div class="panel-body">
<?
echo $msg;
echo form_open("admin/article/edit/{$article['title']}",['class'=>'form-horizontal', 'id'=>'edit-form']);
echo form_hidden('aid', $article['aid']);
echo "<div class='form-group'>";
echo "<div id=\"edit\" name=\"article\">{$article['article']}</div>";
//echo form_textarea(['value'=>$article['article'],'style'=>'width:100%', 'id'=>'edit','name'=>'article']);
echo "</div>";
if(!$article['permanent']) {
    echo form_hidden('article', $article['article']);
    echo "<div class='form-group'>";
    echo form_label('Title','title',['class'=>'control-label col-sm-2']);
    echo '<div class="col-sm-10">';
    echo form_input(['name'=>'title','value'=>$article['title'], 'class'=>'form-control','id'=>'title']);
    echo "</div></div>";
    
    echo "<div class='form-group'>";
    echo form_label('Parent Article','parent',['class'=>'control-label col-sm-2']);
    echo '<div class="col-sm-10">';
    $parents[-1] = 'Hidden from menu';
    echo form_dropdown('parent',$parents,$article['parent'],"class='form-control' id='parent'");
    echo "</div></div>";
    
    echo "<div class='form-group'>";
    echo form_label('Permanently Delete','delete',['class'=>'control-label col-sm-2','id'=>'delete']);
    echo '<div class="col-sm-10"><div class="checkbox">';
    
    echo form_checkbox(['name'=>'delete','value'=>"delete",'id'=>'delete','checked'=>false]);
    echo "</div></div></div>";
}
echo '<div class="form-group"><div class="col-sm-offset-2 col-sm-10">';
echo form_submit(['name'=>"save", 'content'=>'Save', 'value'=>"Save", 'class'=>'btn btn-default']);
echo "</div></div>";
echo form_close();
?>
</div>
</div>
