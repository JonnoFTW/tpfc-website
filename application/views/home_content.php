<div class="home-row" id="blue">
    <div class="container">
    <h1 class="text-primary-inverse text-center" >Come and Try!</h1>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 text-center">
            <div class="service-box">
               <i class="fa fa-5x fa-map-marker wow bounceIn text-primary-inverse" style="visibility: visible; animation-name: bounceIn;"></i>
                <h3>Where</h3>
                <p class="text-muted"><? echo anchor('contact','Sheidow Park <br>Primary School Gym');?></p>
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
                <p class="text-muted">Just $5</p>
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

<div class="home-row parallax-img text-center">
    <img class="parallax" id="sabre" data-parallax='{"y": 300}' src="/assets/images/sabre.jpg"> 
    <p>All Equipment Provided</p>
</div>

<div class="home-row" id="red">
    <div class="container">
        <div class="row vertical-align" style="padding: 80px 0 80px">
            <div class="col-sm-3 col-sm-offset-1">
                <h1 class="text-primary-inverse text-center row-title">Help Us <br>Grow</h1>
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

<div class="home-row parallax-img text-center">
    <img class="parallax" id="lunge" data-parallax='{"y": 300}' src="http://i.imgur.com/4NSpamc.jpg"> 
    <p>Fun for ages 8 and up</p> 
</div>

<div class="home-row" id="group-row">
    <div class="container">
    
        <h1 class="text-primary-inverse text-center">Group Sessions Available</h1>
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3 text-center">
                <p><a href="/contact">Contact us</a> about providing a special event for your community group or school</p>
            </div>
        </div>
    </div>
</div>

</div>
<script src="http://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script src="/assets/scripts/jquery.easing.1.3.js"></script>
<script src="/assets/scripts/jquery.parallax-scroll.js"></script>
<script>
var mobileWidth = 1052;
var data_parallax = {};
var scale = 0.2;
var resize = function() {
    var width = $(window).width();
  /*  var img = $('#lunge');
    console.log('dedoing parallax vals: ', img.width()*scale);
    img.removeAttr('data-parallax');
    img.removeAttr('style');
    img.attr('data-parallax', JSON.stringify({y:img.width()*scale}));*/
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
$(document).ready(togglep);

</script>
</div> <!-- required to end a div -->
