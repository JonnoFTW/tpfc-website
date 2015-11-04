<style type="text/css">
    #side_list, ul {margin-bottom:5px;}
</style>
<div class="grid_3">
<div class="box" id="side_list">
   <h2>Manage</h2>

    <?
    echo heading(anchor('admin/users',"Users"),3); 
    echo heading(anchor('admin/article','Pages'),3); 
    echo $article_list;
    ?>
    <h3><? echo anchor('admin/gallery','Gallery'); ?></h3>
    <ul>
     <? foreach($galleries as $i){echo "<li>".anchor('admin/gallery/gid/'.$i['gid'],$i['title'])."</li>";} ?>
     </ul>
</div>
</div>