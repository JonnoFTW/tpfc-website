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
      <div class='col-md-12' id="carousel-container">
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
      </div>
    </div>


<div class="home-row" id="blue">
    <div class="container">
    <h1 class="text-primary-inverse text-center" >Come and Try!</h1>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 text-center">
            <div class="service-box">
               <i class="fa fa-5x fa-map-marker wow bounceIn text-primary-inverse" style="visibility: visible; animation-name: bounceIn;"></i>
                <h3>Where</h3>
                <p class="text-muted"><? echo anchor('contact#bigmap','Sheidow Park <br>Primary School Gym');?></p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 text-center">
                <div class="service-box">
                <i class="fa fa-5x fa-clock-o wow bounceIn text-primary-inverse" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.1s; animation-name: bounceIn;"></i>
                <h3>When</h3>
                <p class="text-muted">7-9 PM Wednesdays <br>during school terms</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 text-center">
                <div class="service-box">
                <i class="fa fa-5x fa-dollar wow bounceIn text-primary-inverse" data-wow-delay=".7s" style="visibility: visible; animation-delay: 0.2s; animation-name: bounceIn;"></i>
                <h3>Cost</h3>
                <p class="text-muted">Just $5<br>Save $50 with <a href="http://www.sportsvouchers.sa.gov.au/">Sports Vouchers</a></p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 text-center">
                <div class="service-box">
                <i class="fa fa-5x fa-child wow bounceIn text-primary-inverse" data-wow-delay=".8s" style="visibility: visible; animation-delay: 0.2s; animation-name: bounceIn;"></i>
                <h3>Equipment</h3>
                <p class="text-muted">Bring a water bottle,<br> sneakers &amp; trackpants</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="home-row parallax-img text-center"  data-pos-x="left" data-bleed="50" data-z-index="0" data-parallax data-src="/assets/images/sabre.jpg">
  <!--  <img class="parallax" id="sabre" data-parallax='{"y": 300}' src="/assets/images/sabre.jpg"> -->
    <p>All Equipment Provided</p>
</div>

<div class="home-row" id="red">
    <div class="container">
        <div class="row vertical-align" style="padding: 80px 0 80px">
            <div class="col-sm-3 col-sm-offset-1">
                <h1 class="text-primary-inverse text-center row-title"><a href="https://asf.org.au/project/fencing-equipment">Help Us <br>Grow</a></h1>
            </div>
            <div class="col-sm-1" style="padding-top:40px;">
                <i class="fa fa-4x fa-heart wow bounceIn text-primary-inverse text-center" data-wow-delay=".9s" style="width:100%; color:#fff;visibility: visible; animation-delay: 0.2s; animation-name: bounceIn;"></i>
            </div>
            <div class="col-sm-6 col-md-6 text-left" style="padding-top:40px;">
                <p>We're always looking for <? echo anchor('sponsors', 'sponsors');?>, you can make a tax deductable donation through our 
                <a href="http://asf.org.au/project/fencing-equipment/" target="_blank">Australian Sports Foundation</a> project</p>
            </div>
        </div>
    </div>
</div>

<div class="home-row parallax-img text-center" data-parallax data-pos-x="left" data-bleed="50" data-z-index="0"  data-src="http://i.imgur.com/4NSpamc.jpg">
   <!-- <img class="parallax" id="lunge" data-parallax='{"y": 100}' src="http://i.imgur.com/4NSpamc.jpg"> -->
    <p>Fun for ages 8 and up</p> 
</div>

<div class="home-row" id="group-row">
    <div class="container">
        <div class="row">
           <div class="col-xs-2 col-xs-offset-5"><img src="/assets/images/three.png" class="wow bounceIn" data-wow-delay="1s"/></div>
        </div>
        <h1 class="text-primary-inverse text-center">Group Sessions Available</h1>
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3 text-center">
                <p><a href="/contact">Contact us</a> about providing a special event for your community group or a series of lessons for your school</p>
            </div>
        </div>
    </div>
</div>

</div>
<script src="http://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.js"></script>
<!--<script src="/assets/scripts/jquery.easing.1.3.js"></script>
<script src="/assets/scripts/jquery.parallax-scroll.js"></script>-->
<script src="https://cdn.rawgit.com/pixelcog/parallax.js/v2.0.0-alpha/dist/jquery.parallax.min.js"></script>
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
        _.forEach(_.groupBy(data.slice(0,24), function(elem,idx){return Math.floor(idx/4)}),function(group) {
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
                elem.find('.img-responsive').css("background","url('"+val.source+"')");
                item.find('.row').append(elem);
            });
            car.append(item);
        });
        window.setupCarousel();
    }).fail(function(xhr) {
        $('#carousel-container').hide();
    });
};
$(document).ready(function() {
    new WOW().init();
    window.initCarousel();
});
/*
var mobileWidth = 1052;
var data_parallax = {};
var scale = 0.2;
var resize = function() {
    var width = $(window).width();
  //  var img = $('#lunge');
 //   console.log('dedoing parallax vals: ', img.width()*scale);
 //   img.removeAttr('data-parallax');
 //   img.removeAttr('style');
 //   img.attr('data-parallax', JSON.stringify({y:img.width()*scale}));
    $('.parallax').each(function() {
        data_parallax[$(this).attr('id')] = $(this).data('parallax');
    });
};

var togglep = function() {
  if($(window).width() > mobileWidth ){
    //parallax movement onscroll
    $(".parallax").each(function(){
      $(this).attr("data-parallax",JSON.stringify(data_parallax[$(this).attr('id')]));
    });
  } else {
    $(".parallax").each(function(){
      //NO MORE PARALLAX MOVEMENT
      $(this).removeAttr("data-parallax");
      $(this).removeAttr("style");
    });
  }
   resize();
};

$(window).resize(togglep);
$(document).ready(togglep);*/

</script>
</div> <!-- required to end a div -->
