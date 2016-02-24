
<style>
.form-signin {
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 10px;
}
.form-signin .checkbox {
  font-weight: normal;
}
.form-signin .form-control {
  position: relative;
  height: auto;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
p.message {
    padding: 15px;
}
</style>
<div class="col-md-4 col-md-offset-4">
	<?
    if($this->session->userdata('logged')){
        // User is already logged in
        echo form_open('login/logout', ['class'=>'form-signin']);
        echo ' <button class="btn btn-lg btn-danger btn-block" value="login" type="submit">Sign out</button>';
        echo "</p>";
        echo form_close();
        ?>
			
   <? }
    else{
        echo form_open('login', ['class'=>'form-signin']);?>
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" name="user" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only" >Password</label>
        <input type="password" id="inputPassword" class="form-control" name="pass" placeholder="Password" required>
          <?
        if(isset($err) && $err){
            echo "<p class='bg-danger message'>$err</p>";
        }
        if($logged_out){
            echo "<p class='bg-info message'>You have been logged out</p>";
        }?>
        <button class="btn btn-lg btn-primary btn-block" value="login" type="submit">Sign in</button>
      </form>
    
              
               
    <?
    }
    ?>
	</form>
</div>
