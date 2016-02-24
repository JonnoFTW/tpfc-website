<?
$home = false;
if(isset($article_title)) {
	$home = strcasecmp($article_title,'home') == 0;
}
if ($home) {
?>

<div class="col-md-3">
	<div class="panel panel-default">
        	<div class="panel-heading">
                	Come 'n' Try
                </div>
                <div class="panel-body">
                	<h4>Where?</h4><p>Sheidow Park Primary School Gym</p>
                        <h4>When?</h4><p>7PM, Wednesday during school terms</p>
                        <h4>Cost?</h4><p>$5 come 'n' try</p>
                        <hr>
                <? /*
                //      echo anchor('http://www.playbytherules.net.au/',img(array('src'=>'assets/images/vertical_large.jpg','style'=>'width:100%')));
                // echo <hr>
                                */
               ?>
                           <div class="fb-like-box" data-href="https://www.facebook.com/trottparkfencingclub" data-height="290"
                                        data-width="230" data-colorscheme="light" data-show-faces="true" data-header="true"
                                        data-stream="false" data-show-border="true">
                           </div>
                </div>
         </div>
</div>
<div class="col-md-9">
<?
} else {
?>
<div class="col-md-12">
<?
}
?>

	    <div class="panel panel-default">
	    <div class="panel-body">
		<? 
		echo $article['article'];?>
        Last edited on <? echo $article['updated'];
        if($this->session->userdata('logged') == true){
			echo " by {$article['first_name']} {$article['last_name']}</br>";
			echo anchor("admin/article/edit/{$article['title']}","Edit this page");
        }?>
        </div>
</div>

