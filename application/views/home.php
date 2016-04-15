<div class="col-md-12">
	    <div class="panel panel-default">
	    <div class="panel-body">
		<? 
		echo $article['article'];?>
        <br> Last edited on <? echo $article['updated'];
        if($this->session->userdata('logged') == true){
			echo " by {$article['first_name']} {$article['last_name']}</br>";
			echo anchor("admin/article/edit/{$article['title']}","Edit this page");
        }?>
        </div>
</div>

