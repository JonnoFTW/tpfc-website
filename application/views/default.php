<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <title>Trott Park Fencing Club :: <? echo str_replace('_',' ',$title); ?> </title>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <!-- Latest compiled and minified CSS -->
       <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"  crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/lavish-bootstrap.css">
    <link rel="stylesheet" href="/assets/css/bootstrap3-wysihtml5.min.css">
    <link href='http://fonts.googleapis.com/css?family=Signika:400,300|Cuprum:400,400italic|Sanchez|Pontano+Sans|Kreon:400,700|Cookie|Lato' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Latest compiled and minified JavaScript -->
<link rel="stylesheet" href="/assets/css/footer-distributed-with-address-and-phones.css">
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.3.0/lodash.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css">
	<link rel="stylesheet" href="/assets/css/homepage.css"/>
    <? 
    echo link_tag('favicon.ico', 'shortcut icon', 'image/ico');
    ?>
    <style type="text/css">
.main-title {
    font-family: 'Sanchez', serif;
    color: #fff !important;
    padding-bottom:30px;
}
#content {
    padding-bottom: 60px;
}
html,
body {
  height: 100%;
  /* The html and body elements cannot have any padding or margin. */
}
.page-header {
    border-bottom: 0;
}
#wrap {
  background-image: url('/assets/images/wavegrid.png');
 
  margin: 0 auto -60px;
  /* Pad bottom by footer height */
  padding: 0 0 0px;
}
#footer {
  height: 60px;
  background-color: #f5f5f5;
}
.navbar-header {
    font-size:14pt !important;
}
.navbar-nav > li {
    font-family:'Cuprum' ,'Helvetica Neue', Helvetica, Arial, sans-serif !important;
    font-weight:400 !important;
    font-size:14pt;
    letter-spacing: 0.04em;
}
.col-md-12 h1 {
    float:right; 
    font-family: tahoma, arial, sans-serif;
    color:blueViolet; 
    font-size:40px;
    padding-top:25px;
    
}
.jumbotron {
   /* background-image: radial-gradient(ellipse closest-side,#4527A0 ,#4F364C);*/
background: -moz-radial-gradient(center, ellipse cover, #4527A0 0%, #4F364C 100%); /* ff3.6+ */
background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, #4527A0), color-stop(100%, #4F364C)); /* safari4+,chrome */
background: -webkit-radial-gradient(center, ellipse cover, #4527A0 0%, #4F364C 100%); /* safari5.1+,chrome10+ */
background: -o-radial-gradient(center, ellipse cover, #4527A0 0%, #4F364C 100%); /* opera 11.10+ */
background: -ms-radial-gradient(center, ellipse cover, #4527A0 0%, #4F364C 100%); /* ie10+ */
background: radial-gradient(ellipse at center, #4527A0 0%, #4F364C 100%); /* w3c */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#4527A0', endColorstr='#4F364C',GradientType=0 ); /* ie6-9 */
}
.vertical-center {

}
.carousel {
    margin-bottom: 0;
    padding: 0 40px 30px 40px;
}

.btn-circle {
  width: 30px;
  height: 30px;
  text-align: center;
  padding: 6px 0;
  margin-top: 60px;
  font-size: 12px;
  line-height: 1.42;
  border-radius: 15px;
  background-color: #111;
  color: #fff;
}
.btn-circle:hover {
  background-color: #444;
}

h3,h4,h5 {
    font-family:Sanchez;
}
.carousel-indicators {
    right: 50%;
    top: auto;
    bottom: 0px;
    margin-right: -19px;
}
.glyphicon-refresh-animate {
    -animation: spin .7s infinite linear;
    -webkit-animation: spin2 .7s infinite linear;
}

@-webkit-keyframes spin2 {
    from { -webkit-transform: rotate(0deg);}
    to { -webkit-transform: rotate(360deg);}
}

@keyframes spin {
    from { transform: scale(1) rotate(0deg);}
    to { transform: scale(1) rotate(360deg);}
}
.carousel-indicators li {
    background: #fff;
}

.carousel-indicators .active {
    background: #333333;
}
.carousel-inner {
    height: 175px;
}
.img-responsive {
    height: 155px;
    background-size:100% !important;
    background-repeat:no-repeat;
}
@media (max-width: 992px) {
    .img-responsive {
        height: 300px;
    }
    .carousel-inner {
        height: 300px;
    }
}
.container .text-muted {
  margin: 20px 0;
}
footer {
    font-family: 'Cuprum';
}
.text-muted > a {
  color: #8E6AB3;
}
.page-header {
    font-family:Sanchez, serif;
}
a.navbar-brand {
    font-family:Sanchez, serif;
}
.bot-logo {
/*   -moz-transform: scaleX(-1);
    -o-transform: scaleX(-1);
    -webkit-transform: scaleX(-1);
    transform: scaleX(-1);
    filter: FlipH;
    -ms-filter: "FlipH";*/
}

#logo {
/*    -webkit-box-shadow: 0px 30px 40px -25px rgba(0, 0, 0, 1);
    -moz-box-shadow:    0px 30px 40px -25px rgba(0, 0, 0, 1);
    filter: drop-shadow(10px 10px 20px #222);        0px 30px 40px -25px rgba(0, 0, 0, 1);*/
}

    </style>

    <meta name="keywords" content="fencing, south australia, adelaide, sport, trott park, sheidow park, excersise, kids, marion, hallett cove"/>
    <meta name="description" content="Trott Park Fencing Club is a small fencing club based in Southern Adelaide with a focus on junior development"/>
  </head>
<body>
<div id="wrap">
<div id="fb-root"></div>
<script>
window.setupCarousel = function() {
    $('#myCarousel').carousel({
    interval: 5000
    })
};
window.initCarousel = function() {
    // load 30 latest images from facebook
    $.getJSON("/page/getFBgallery",function(data){
    var car = $(".carousel-inner");
    car.empty();
    var active = true;
    _.forEach(_.chunk(data.data.slice(0,24), 4),function(group) {
        var item = $("<div class='item'><div class='row'>");
        if(active) {
            item.addClass('active');
            active = false;
        }
        _.forEach(group, function(val, idx) {
            var elem = $("<div class='col-md-3'><a><div class='img-responsive thumbnail'></div></a></div>");
            if (idx) {
                elem.addClass('hidden-xs hidden-sm');
            }
            elem.find('a').attr("href",val.link).attr("alt",val.name).attr("title",val.name).attr('target', '_blank');
            elem.find('.img-responsive').css("background","url('"+val.images[4].source+"') 50% 50% no-repeat");
            item.find('.row').append(elem);
        });
        car.append(item);
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



 <nav class="navbar-inverse navbar-default navbar-static-top" style="margin-bottom:0px;">
      <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="/">
Trott Park Fencing Club  <div class="fb-like" 
      data-href="https://www.facebook.com/trottparkfencingclub" 
      data-layout="button_count" data-action="like" data-show-faces="true" data-share="false" style="width:79px;"></div>
      </a>
     </div>
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false">
    <span class="sr-only">Toggle Navigation</span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    </button>
 
     
    <div id="navbar" class="navbar-collapse collapse" aria-expanded="false">
     <? echo $menu; ?>
    </div><!--/.nav-collapse -->
      </div>
    </nav>
    <?
    if($title == "Home" || $title == "Test") {
    ?>
  <div class="jumbotron text-center">
      <div class="container">
      <? echo img(['src'=>'assets/images/hedgielogo.png', 'style'=>'width:130px','id'=>'logo']);?>
      <h1 class="main-title">
<?// echo img('assets/images/hedgielogo_small.png');?>

Trott Park Fencing Club</h1>
      <? 
       /*foreach(array('jquery.ui.core.min.js','jquery.ui.widget.min.js','jquery.ui.rcarousel.min.js') as $v) {
    echo "<script type='text/javascript' src='". base_url()."assets/carousel/lib/$v'></script>\n";
    }*/
    ?>
      <div class='col-md-12'>
      <?  # insert some images from the db'
    /* foreach($banner_images as $v) {
    echo anchor("gallery/view/{$v['gid']}/{$v['iid']}",img("assets/images/thumbs/{$v['link']}"))."\n";
    }*/?>
     <div id="myCarousel" class="carousel slide">
    <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li>
    <li data-target="#myCarousel" data-slide-to="4"></li>
    <li data-target="#myCarousel" data-slide-to="5"></li>
    </ol>
    <!-- Carousel items -->
    
    <div class="carousel-inner">
    <span class="glyphicon glyphicon-refresh glyphicon-refresh-animate vcenter text-center" style="color:#fff;font-size: 40px;margin-top: 50px;"></span>
    </div>
       
      </div><!--/myCarousel-->
    <a class="btn btn-default btn-circle left carousel-control" href="#myCarousel" data-slide="prev"><i class="fa fa-arrow-left"></i></a>
   <a class="btn btn-default btn-circle right carousel-control" href="#myCarousel" data-slide="next"><i class="fa fa-arrow-right"></i></a>
    </div>
    <script type="text/javascript">
    window.initCarousel();
    </script>
      
      
      </div>
    </div>
    <?
     }
?>
<?
if(isset($home_content)) {
	 // load the parallax stuff
	echo $home_content;
} else {
?>
<div class="container">

    <div class="row" id="content">
      <? 
      if($title != "Home") {
      ?>
    <div class="page-header text-center">
      <h1>
      <?
	if(isset($p)) echo $p;
      echo ucwords(str_replace('_',' ',(str_replace('_',' ',$title)))) ;
      
      ?></h1>
	</div>
      <?
      }
      ?>
    <? echo $main_content; ?>
    </div>
    </div>
</div>
</div>
</div>

<?
}
?>

<footer class="footer-distributed">
    <div class="footer-center">

        <div>
            <i class="fa fa-map-marker"></i>
            <p><? echo anchor('contact', 'Sheidow Park, South Australia');?></p>
        </div>

        <div>
            <i class="fa fa-phone"></i>
            <p><a href="tel:+61-8-<? echo $phone;?>"><? echo substr_replace($phone, ' ', 4, 0);?></a></p>
        </div>

        <div>
            <i class="fa fa-envelope"></i>
            <p><? echo safe_mailto($email)?></p>
        </div>
        
        <div>
            <a href="https://fb.com/trottparkfencingclub"><i class="fa fa-facebook"></i></a> 
            <p> <a href="https://fb.com/trottparkfencingclub">fb.com/trottparkfencingclub</a></p>

        </div>

    </div>

    <div class="footer-right">
    <div class="map_canvas" style="width:100%; height: 250px"></div>
    <? echo $this->load->view('training',$this->data,true);?>
	<div class="footer-company-about">
    Copyright &copy;<? echo date('Y');?> Trott Park Fencing Club Inc., website built by <a href="http://jonno.9ch.in">Jonathan Mackenzie</a>
	</div>
    </div>

</footer>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.22/gmaps.min.js"></script>
<? echo $scripts; ?>
</body>
</html> 
