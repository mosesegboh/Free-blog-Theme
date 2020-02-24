<?php include("path.php") ?>
<?php include(ROOT_PATH . "/app/controllers/users.php"); 
guestOnly(); // pur function to manage user status as created earlier in the middle ware function
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta content="width=device-width, initial-scale=1" name="viewport">
<meta http-equiv = "X-UA-Compatible" content="ie=edge">
<!-- Font awesome -->
<script src="https://kit.fontawesome.com/1c29199772.js" crossorigin="anonymous"></script>

<!-- Custom Styling -->
<link rel="stylesheet" href="css/style.css">
<!-- Google fonts -->
<link href="https://fonts.googleapis.com/css?family=Candal|Lora&display=swap" rel="stylesheet">
<title>Login</title>
</head>
<body>

	<!-- header included here -->
	<?php 
		include(ROOT_PATH ."/app/includes/header.php");
	 ?>
			
	<div class="auth-content">
		<form action = "login.php" method="post">
			<h2 class="form-title">Login</h2>

			<?php 
				include(ROOT_PATH . "/app/helpers/formErrors.php");
			?>

			<div>
				<label>Username</label>
				<input type="text" name="username" value = "<?php echo $username; ?>" class="text-input">
			</div>		
			<div>
				<label>Password</label>
				<input type="password" name="password" value = "<?php echo $password; ?>" class="text-input">
			</div>	
			<div>
				<button type="submit" name="login-btn" class = "btn btn-big">Login</button>
			</div>
			<p>Or <a href=" <?php echo BASE_URL . '/register.php' ?> ">Sign Up</a></p>	 
		</form>
	</div>
	
	<!-- JQuery -->
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>


	<!-- Custom Script -->
	<script type="text/javascript" src="js/scripts.js"></script>
</body>


</html>


