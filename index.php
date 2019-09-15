<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>PHP Captch Code</title>
		<!-- external CSS file  -->
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<div class="login-page">
		  <div class="form">
			<!-- Start login form -->
			<form class="login-form" action method="POST">
			   <input type="text" name="user" placeholder="Username"/>
			   <input type="password" name="password" placeholder="Password"/>
			   <img alt="catcha" class="captcha_img" src="captcha.php" /><br>
			   <input type="text" name="captcha" placeholder="Enter Captch" />
			   <button>login</button>
			   
				<!-- Check captcha code, username and password -->
				<?php if($_POST): ?>
				<div style="background:#DDD;">
					<?php
						if($_POST['user']=='admin' 
						&& $_POST['password']=='admin' 
						&& $_POST['captcha']==$_SESSION['captcha_code_value']){
							echo '<p class="message success">Logged in sussessfully.</p>';
						}else{
							if($_POST['captcha']==$_SESSION['captcha_code_value']){
								echo '<p class="message fail">Invalid Username or Password.</p>';
							}else{
								echo '<p class="message fail">Wrong Captcha entered.</p>';
							}
						}
					?>
				</div>
				<?php endif; ?>			   
			</form>
		  </div>
		</div>	
	</body>
</html>
