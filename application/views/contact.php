<div class="grid_4">
<div class="box">
<h2>Contact Person</h2>
<div class="block" id="tables">
		<table>
			<colgroup>
				<col class="colB" />
				<col class="colC" />
			</colgroup>
			<thead>
				<tr>
					<th>Phone</th>
					<th>Name</th>
				</tr>
			</thead>
			<tbody>
<? 
foreach($mails as $i){
	echo "<tr class=\"odd\"><td><a href='tel:+61-8-{$i['phone']}'>{$i['phone']}</a></td><td>{$i['first_name']}</td>";
}
 ?>			
			</tbody>
		</table>

 
 </div>
 </div>
 </div>
 <div class="grid_8">
 <div class="box">
	<h2>
		<a href="#" id="toggle-login-forms">Send us an email enquiry</a>
	</h2>
	<div class="block" >
   <p> Contact us using this email <? echo safe_mailto($email); ?> directly, or use the convenient form below.</p>
		<? echo form_open('contact'); ?>
			<fieldset class="login">
				<legend>Email</legend>
				<p class="notice"><? echo $msg; if(!$mailed){ ?></p>
                <p>
					<label>Your Name: </label>
					<input type="text" name="name" value="<? echo set_value('name'); ?>"/>
				</p>
				<p>
					<label>Email: </label>
					<input type="email" name="email" value="<? echo set_value('email'); ?>" />
				</p>
				<p>
					<label>Message: </label>
					<textarea cols="40" name="message"><? echo set_value('email'); ?></textarea>
				</p>
                
				<input class="login button" type="submit" value="Send" />
			</fieldset>
            <? } ?>

		</form>
	</div>
</div>
</div>
