<div class="grid_4 prefix_4">
<div class="box">
<h2>
<? echo $title ?>
</h2>
	<div id="login-forms" class="block">
		<?
        if($this->session->userdata('logged')){
        ?>
        
            <fieldset class="login">
				<legend>Logout</legend>
        <?
            // User is already logged in
            echo form_open('login/logout');
            echo "<p>";
            echo form_submit('Logout','Logout');
            echo "</p>";
            echo "</fieldset>";
            echo form_close();
            ?>
				
       <? }
        else{
            echo form_open('login');?>
                <fieldset class="login">
                    <legend>Login</legend>
                    <p>
                        <label>Email: </label>
                        <input type="text" name="user" />
                    </p>
                    <p>
                        
                        <? echo form_label('Password','pass'); echo form_password('pass');
            if(isset($err)){
                echo "<p color='red'>$err</p>";
            }
            else if($logged_out){
                echo "<p>You have been logged out</p>";
            }?>
                    </p>
                    <input class="login button" type="submit" value="Login" />
                </fieldset>
        <?
        }
        ?>
		</form>
	</div>
</div>
</div>
