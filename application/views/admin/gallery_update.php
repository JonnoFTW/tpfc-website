<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Show the images in this gallery
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready( function() { 
    // When update form is submitted
    $("form#images").submit( function(event) {
        event.preventDefault();
        var forms = {}; // hold all the data from the images
        $("form#images div.col-md-3").each( function() {
            var id = $(this).attr("imgid");
            forms[id] = {
                "delete":$(this).find("input").last().is(":checked"),
                "title":$(this).find("input").first().attr("value"),
                "description":$(this).find('input[name="description"]').first().attr("value")
            };
        });
        var del = $("form#images  div.col-md-3  input:checked").length;
        if(del){
            var answer = confirm('You are about to delete '+del+' images, is this okay?');
            $('input:checked').parent().remove();
        }
        else {
            var answer = true;
        }
        if(answer) {
            $.ajax({
                url : "<? echo site_url("admin/gallery/update_images"); ?>",
                type : "POST",
                data : {"images": JSON.stringify(forms),
                        'csrf_test_name':'<?php echo $this->security->get_csrf_hash(); ?>'
                },
                success: function(data) {
                    $("#list_report").html(data).hide().fadeIn(1000);
                }
            });
        }
    });
});
</script>
<div class="col-md-9">
<div class="box block">
<? 
echo "<div class='clear'></div>";
echo heading("Editing Gallery ".$gTitle,2);
?>
To change the description for an image, use the form below the image. To delete the image, tick the checkbox beneath it. Once you've made your changes, press the submit button below.
<?
echo $msg;
// Edit existing images
echo form_open('admin/gallery/update_images',array("id"=>"images"));
echo form_fieldset("Update/Delete Existing Images");
foreach($images as $i) {
    echo "<div class='col-md-3 box' imgid='{$i['iid']}' style='background: #DDD;'>".img('assets/images/thumbs/'.$i['link']);
    echo "<p>";
    echo form_label('Title','title');
    echo form_input('title',$i['title']);
    echo "</p>";
    echo "<p>";
    echo form_label('Description','description');
    echo form_input('description',$i['description']);
    echo "</p>";
    echo form_label("Delete?",$i['iid']).form_checkbox($i['iid'],'delete',false);
    echo "</div>";
}
echo "<div class='clear'></div>";
echo "<div id='list_report'></div>";
echo form_submit("submit","Submit Changes");
echo form_fieldset_close();
echo form_close();
// Upload new images
echo form_open_multipart('admin/gallery/add_image');
echo form_fieldset("Add New Image");

echo "Please submit changes to existing images before uploading another image<p>";
echo form_label("Description","description");
echo form_input("description");
echo "</p>";
echo "<p>";
echo form_label("Title","title");
echo form_input("title");
echo "</p>";
echo form_hidden('gid',$gid);
echo "<p>";
echo form_label("File","userfile");
echo form_upload('userfile');
echo "</p>";

echo form_submit('Submit','Submit');
echo form_fieldset_close();
echo form_close();

echo "<div class='clear'></div>";
echo form_open('admin/gallery/update_gallery');
echo form_fieldset("Update Gallery Details");
echo "<p>";
echo form_label("Name","name");
echo form_input("name",$gTitle);
echo "</p>";
echo "<p>";
echo form_label("Description","description");
echo form_input("description",$gDescr);
echo "</p>";
echo form_hidden('gid',$gid);
echo form_submit('Submit','Submit');
echo form_fieldset_close();
echo form_close();

echo "<div class='clear'></div>";
echo form_open('admin/gallery/delete_gallery/'.$gid);
echo form_fieldset("Delete Gallery and Images");
echo form_submit('Submit','Submit');
echo form_fieldset_close();
echo form_close();

?>

</div>
</div>