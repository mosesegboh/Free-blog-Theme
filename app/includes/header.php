	<header>
		<a href = "  <?php echo BASE_URL . '/index.php' ?>  " class="logo">
			<h1 class = "logo-text"><span>Egboh</span>|Free Blog Theme</h1>	
		</a>
		<i class = "fa fa-bars menu-toggle" ></i>
		<ul class = "nav">
			<li><a href="  <?php echo BASE_URL . '/index.php' ?>  ">Home</a></li>
			<li><a href="#">About</a></li>
			<li><a href="#">Services</a></li>

			<?php if (isset($_SESSION['id'])): ?> <!-- to check if a user is loggedin just check if they have a piece of information in the session -->
				<li>
				<a href="#">
					<i class="fa fa-user"></i>
					<?php echo $_SESSION['username']; ?>
					<i class = "fa fa-chevron-down" style = "font-size: .8em;"></i> <!-- show these if logged in -->
				</a>
				<ul>
				<?php if ($_SESSION['admin']): ?> <!-- this is checking if the user is an admin user and not if its set -->
					<li><a href="<?php echo BASE_URL . '/admin/dashboard.php'; ?> ">Dashboard</a></li>
				<?php endif ?> <!-- else statement not needed -->

					<li><a href="<?php echo BASE_URL . '/logout.php'; ?>" class = "logout">Logout</a></li>

				</ul>
			<?php else: ?>
						<li><a href=" <?php echo BASE_URL . '/register.php'; ?> ">Sign-Up</a></li>   <!-- else show these -->
						<li><a href=" <?php echo BASE_URL . '/login.php'; ?> ">Login</a></li>
				
			<?php endif; ?>
		
		
		</ul>
	</header>