<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WANG CHAN LI</title>
    <link rel="stylesheet" href="Style/stylelogin.css" />
</head>
<head>
    <title>BIBLIO WANG CHAN LI</title>
  </head>
  <body>
    <div class="container" id="container">
      <!-- sign in page -->
      <div class="form-container sign-in-container">

	  <?php if(isset($_SESSION['message'])): ?>
				<div class="alert alert-<?php echo $_SESSION['message']['alert'] ?> msg"><?php echo $_SESSION['message']['text'] ?></div>
			<script>
				(function() {
					// removing the message 3 seconds after the page load
					setTimeout(function(){
						document.querySelector('.msg').remove();
					},3000)
				})();
			</script>
			<?php 
				endif;
				// clearing the message
				unset($_SESSION['message']);
			?>

        <form action="login_query.php" method="POST" class="form" id="login">
          <h1 class="form__title">Login</h1>
          <div class="form__input-group">
            <label for="username">Username: </label>
            <input type="text" class="form__input" name="username" id="username" maxlength="20" required> 
          </div>
          <div class="form__input-group">
            <label for="pass">Password: </label>
            <input type="password" class="form__input" name="password" id="pass" maxlength="20" required> 
          </div>
          <div class="form__input-group">
            <button type="submit" name="login" class="form__button">Submit</button>
          </div>
       </form>


      </div>
      
     <!--  create account page -->
     <div class="form-container sign-up-container">
       <form action="register_query.php" method="POST" class="form" id="register">
         <h1 class="form__title">Register</h1>
         <div class="form__input-group">
           <label for="username"> Username: </label>
           <input type="text" class="form__input" name="username" id="username" maxlength="20" required>
         </div>
          <div class="form__input-group">
            <label for="pass">Password: </label>
            <input type="password" class="form__input" name="password" id="password" maxlength="20" required> 
          </div>
         <button class="form__button" type="submit" name="register">Register</button>
       </form>
     </div> 
      
     <div class="overlay-container">
          <div class="overlay">
              <div class="overlay-panel overlay-left">
                  <h1>Welcome Back!</h1>
                  <p>Please login with your personal info</p>
                  <button class="ghost" id="signIn">Sign In</button>
              </div>
              <div class="overlay-panel overlay-right">
                  <h1>Hello, Friend!</h1>
                  <p>Enter your personal details and start journey with us</p>
                  <button class="ghost" id="signUp" name="register">Sign Up</button>
              </div>
          </div>
      </div>
   </div>
    
    
    <script src="js/jslogin.js"></script>
    
  </body>
