<style type="text/css">
</style>
<div class="col-md-3">
<div class="panel panel-primary">
<div class="panel-heading">Manage</div>
<div class="list-group">
    <?
    echo '<div class="list-group-item">'.anchor('admin/users',"Users").' <br/>'. anchor('admin/members#table','Members')."<br>".anchor('admin/members/attendance', 'Attendance').'<br>'.anchor('admin/members/registrations', 'Registrations').'<br>'.anchor('admin/forms', 'Forms')."</div>"; 
    echo anchor('admin/article','<h4 class="list-group-item-heading">Pages</h4>',['class'=>'list-group-item active']); 
    echo $article_list;

    echo anchor('admin/gallery','<h4 class="list-group-item-heading">Gallery</h4>',['class'=>'list-group-item active']); 
    ?>
    <ul class="list-group">
     <? foreach($galleries as $i){echo "<li class='list-group-item'>".anchor('admin/gallery/gid/'.$i['gid'],$i['title'])."</li>";} ?>
     </ul>
</div>
</div>
</div>
