<?
$home = false;
if(isset($article_title))
	$home = strcasecmp($article_title,'home') == 0;
?>
<div class="col-md-12">
	<?
	if($home)
		echo '<div class="col-md-9">';
		?>
    <div class="panel panel-default">
    <div class="panel-body">
		<? echo $article['article'];?>
        Last edited on <? echo $article['updated'];
        if($this->session->userdata('logged') == true){
			echo " by {$article['first_name']} {$article['last_name']}</br>";
			echo anchor("admin/article/edit/{$article['title']}","Edit this page");
        }
        ?>
    </div>
    </div>
	<?
	if($home) {
		?>
		</div>
		<div class="col-md-3">
		<div class="panel panel-default">
  <div class="panel-body">
		<?
			echo anchor('http://www.playbytherules.net.au/',img(array('src'=>'assets/images/vertical_large.jpg','style'=>'width:100%')));
		?>
		<div class="fb-like-box" data-href="https://www.facebook.com/trottparkfencingclub" data-height="290" data-width="200" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
		</div>
		</div>
		</div>
		<?
	}
	?>
</div>
