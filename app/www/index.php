<?php
$rootDirectory = 1;
$title = "Quizinator";
require_once '../inc/init.php';
if(!LOGGED_IN)
{
include __ROOT__.'/inc/templates/head.php';
include __ROOT__.'/inc/templates/header.out.php';
?>
<!-- Hidden title -->
<div class="not-mobile banner">
  <header>
    <h1 class="h1">Welcome to Quizinator</h1>
    <p class="text">Create and play your custom quizes</p>
  </header>
</div>
<?php include __ROOT__.'/inc/templates/error.php';?>
<!-- Sign in / Register -->
<div class="column-wrapper">
  <!-- Sign in -->
  <div class="column-2">
    <div class="column-box">
      <div class="box-padding">
        <h2 class="h2" id="Sign_in">Sign in</h2>
        <form method="POST" name="signin" action="./php/login.php" onsubmit="return this.login.value?this.password.value?true:(this.password.focus(),false):(this.login.focus(),false)">
          <input type="text" name="login" placeholder="Email/Username" class="input block" required data-focus>
          <input type="password" name="password" placeholder="Password" class="input block" required pattern=".{6,25}" title="6 to 25 characters">
          <input name="submit" type="submit" value="Sign in" class="input-button block">

          <!--Facebook Login
          <fb:login-button scope="public_profile,email,user_birthday" onlogin="checkLoginState();">
          </fb:login-button>
          <div id="status">
          </div>-->

        </form>
      </div>
    </div>
  </div>
  <!-- Register -->
  <div class="column-2">
    <div class="column-box">
      <div class="box-padding">
        <h2 class="h2" id="Register">Register</h2>
        <form method="POST" name="register" action="./php/register.php" onsubmit="return this.registerEmail.value?this.registerPassword.value?this.registerPassword.value===this.registerConfirmPassword.value?true:(this.registerConfirmPassword.focus(),newError('Passwords must match!'),false):(this.registerPassword.focus(),newError('A password is required.'),false):(this.registerEmail.focus(),newError('An email is required.'),false)">
          <input type="email" name="registerEmail" placeholder="Email" class="input block" required>
          <input type="password" name="registerPassword" placeholder="Password" class="input block" required pattern=".{6,25}" title="6 to 25 characters">
          <input type="password" name="registerConfirmPassword" placeholder="Confirm Password" class="input block" required pattern=".{6,25}" title="6 to 25 characters">
          <input type="text" name="registerUsername" placeholder="Username" class="input block" required pattern=".{4,25}" title="4 to 25 characters">
          <input type="text" name="registerFirstName" placeholder="First Name" class="input block" required pattern=".{4,50}" title="4 to 50 characters">
          <input type="text" name="registerLastName" placeholder="Last Name" class="input block" required pattern=".{4,50}" title="4 to 50 characters">
          <p class="small-text">By registering, you agree to our
            <a href="javascript:void" onclick="window.open('./terms','_blank','scrollbars=yes,status=no,titlebar=no,menubar=no,resizable=yes,left=30,top=30,height=300,width=320')" class="link">Terms</a> and
            <a href="#privacy" class="link">Privacy Policy</a>, including our
            <a href="#cookies" class="link">Cookie Use</a>.
          </p>
          <input type="submit" value="Register" class="input-button block">
        </form>
      </div>
    </div>
  </div>
</div>

<?php
include __ROOT__.'/inc/templates/footer.php';
exit();
}
include __ROOT__.'/inc/templates/head.php';
include __ROOT__.'/inc/templates/header.in.php';
?>
<div class="box">
  <div class="box-padding">
    shet
  </div>
</div>
<?php
include __ROOT__.'/inc/templates/footer.php';
?>