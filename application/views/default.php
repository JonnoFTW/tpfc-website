<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
echo doctype('html');
 ?>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<title>Trott Park Fencing Club :: <? echo str_replace('_',' ',$title); ?> </title>
		<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
			<!-- Latest compiled and minified CSS -->
			
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

            <!-- Optional theme -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">

            <!-- Latest compiled and minified JavaScript -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
		<? 
			echo link_tag('favicon.ico', 'shortcut icon', 'image/ico');
			
		
            if($title == "Home")
                echo link_tag("assets/carousel/css/rcarousel.css")."\n";	
		?>

       
    <style type="text/css">
.navbar-nav > li {
  /*  padding-left:30px;
    padding-right:30px;*/
}
.col-md-12 h1 {
    float:right;
    font-family: tahoma, arial, sans-serif;
    color:blueViolet; 
    font-size:40px;
    padding-top:25px;
    
}
div#carousel {
    margin-left:10px;
}

.container .text-muted {
  margin: 20px 0;
}
.footer-row {
  width: 100%;
  /* Set the fixed height of the footer here */
  height: 60px;
  background-color: #f5f5f5;
}

    </style>
	
	<meta name="keywords" content="fencing, south australia, adelaide, sport, trott park, sheidow park, excersise, kids, marion, hallett cove"/>
	<meta name="description" content="Trott Park Fencing Club is a small fencing club based in Southern Adelaide with a focus on junior development"/>
    
  </head>
<body>
<div id="fb-root"></div>
<script>
window.setupCarousel = function() {
	$("#carousel").rcarousel( {
	            visible:9,
	            step:1,
	            margin:5,
	            speed:700,
	            auto: {enabled:true}
	});      
};
window.initCarousel = function() {
	// load 30 latest images from facebook
	$.getJSON("/page/getFBgallery",function(data){
		var car = $("#carousel");
		car.empty();
	     	$.each(data.data.slice(0,30),function(idx,val) {
	     	    var elem = $("<a></a>");
	     	    elem.attr("href",val.link);
	     	    elem.attr("alt",val.name);
 	    	    elem.attr("title",val.name);
	     	    var img = $("<img>");
	     	    img.attr("src",val.picture);
	     	    elem.append(img);
	     	    car.append(elem);
	     	});
	     	window.setupCarousel();
	     	
	});
	 
};
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&appId=502666093201010&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>



 <nav class="navbar navbar-default navbar-static-top" style="margin-bottom:0px;">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="/">Trott Park Fencing Club</a>
          <div class="fb-like" 
          data-href="https://www.facebook.com/trottparkfencingclub" 
          data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
         <? echo $menu; ?>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	<?
        if($title == "Home") {
        ?>
  <div class="jumbotron">
      <div class="container">
        <h1>Trott Park Fencing Club</h1>
          <? 
           foreach(array('jquery.ui.core.min.js','jquery.ui.widget.min.js','jquery.ui.rcarousel.min.js') as $v) {
                echo "<script type='text/javascript' src='". base_url()."assets/carousel/lib/$v'></script>\n";
            }
            echo "<div class='col-md-12' id='carousel'>";
            # insert some images from the db'
            /* foreach($banner_images as $v) {
                echo anchor("gallery/view/{$v['gid']}/{$v['iid']}",img("assets/images/thumbs/{$v['link']}"))."\n";
            }*/
            echo "</div>";
            ?>
            <script type="text/javascript">
            window.initCarousel();
            </script>
          
          
      </div>
    </div>
    <?
     }
?>
<div class="container">
     
<div class="row" id="content">
<div class="page-header">
  <h1><? 
  echo ucwords(str_replace('_',' ',(str_replace('_',' ',$title)))) ;
  
  ?></h1>
</div>
<? echo $main_content; ?>
</div>
</div>
<div class="footer navbar-fixed-bottom footer-row">
	<div class="container">
		<p class="text-muted">TPFC website created by <a href="http://jonno.9ch.in">Jonathan Mackenzie</a>, all rights reserved. All content Copyright&copy; <? echo date("Y");?> TPFC </p>
	</div>
</div>


</div>
<? echo $scripts; ?>
</body>
</html> 
