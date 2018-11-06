<div class="panel panel-default">
<div class="panel-body">
<div class="row">
<div class="col-md-6">
    <h3>Contact Persons</h3>
		<table class="table table-striped table-bordered" >
			<thead>
				<tr>
					<th>Phone</th>
					<th>Name</th>
				</tr>
			</thead>
			<tbody class="table-hover">
<? 
foreach($mails as $i){
	echo "<tr class=\"odd\"><td><a href='tel:+61-8-{$i['phone']}'>{$i['phone']}</a></td><td>{$i['first_name']}</td>";
}
 ?>			
			</tbody>
		</table>
         <h3>Postal Address</h3>
<p>Please send us an email to get our postal address.</p>
	<h3>
		Send us an email enquiry
	</h3>
	<div class="block" >
   <p> Contact us using this email <? echo safe_mailto($email); ?> directly, or use the convenient form below.</p>
		<? echo form_open('contact',['class'=>'form-horizontal']); ?>
			
				<legend>Email</legend>
				<p class="notice"><? echo $msg; if(!$mailed){ ?></p>
				 <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-7">
                      <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email" value="<? echo set_value('email'); ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="inputName" name="name" placeholder="Name" value="<? echo set_value('name'); ?>">
                    </div>
                  </div>
                 <div class="form-group">
                    <label for="inputMessage" class="col-sm-2 control-label">Message</label>
                    <div class="col-sm-7">
                      <textarea type="text" class="form-control" rows="4" id="inputMessage" name="message"  value="<? echo set_value('message'); ?>"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <div class="g-recaptcha" data-sitekey="<? echo config_item('recaptcha')['site_key'];?>" data-callback="recapCallback"></div>
                  <button type="submit" value="send" class="btn btn-default disabled" id="final-submit">Send</button>
                </div>
              </div>
			
            <? } ?>

		</form>
	</div>
</div>
<div class="col-md-6"  id="bigmap">

    <h3>Directions</h3>
<ul class="content-list">
<li>By car, heading south from the city towards Noarlunga, get onto Lonsdale Road (also called Ocean Boulevard and Brighton Road)</li>
<li>Turn left onto Lander Road with St Martin de Porres Primary School on the corner</li>
<li>Turn left at the first roundabout (Adams Road)Take the second right with Sheidow Park Primary School on the corner (Warakilya Road)</li>
<li>Take the first left (Alkira Road) and park in one of the angled parks about 50 metres along</li>
<li>Walk up the asphalt path to the gym</li>
</ul>
<div class="map_canvas" style="width:100%;height:950px;"></div>
    </div>
</div>
</div>

</div>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript">
    var recapCallback = function () {
        $('#final-submit').removeClass('disabled');
    };
    $(document).ready(function() {
        
    });
</script>
