<?php include("../path.php"); ?>
<?php include(ROOT_PATH . "/app/controllers/posts.php"); 
adminOnly(); //<!-- redirects the user if not an admin function created earlier in middleware.php -->
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
<link rel="stylesheet" href="../assets/css/style.css">

<!-- Custom Styling -->
<link rel="stylesheet" href="../assets/css/admin.css">

<!-- Google fonts -->
<link href="https://fonts.googleapis.com/css?family=Candal|Lora&display=swap" rel="stylesheet">
<title>Admin Section - Dashboard</title>

</head>
<body>

			<!-- Include Admin Header Here -->
		<?php Include(ROOT_PATH . '/app/includes/adminHeader.php'); ?>


			<!-- Admin page wrapper -->
	<div class = "admin-wrapper">

		<!-- Left Side bar -->
		
		<?php Include(ROOT_PATH . '/app/includes/adminSidebar.php'); ?>

		<!-- //Left Side bar -->

		<!-- Admin Main Content -->
		<div class = "admin-content">
		

			<div class = "content">
				<h2 class="page-title">Dashboard</h2>

				<?php 
				include(ROOT_PATH . "/app/includes/messages.php");
			 	?>
			</div>
		</div>
		<!-- //Admin Main Content -->

	</div>
	<!-- End Page Wrapper -->


	<!-- JQuery -->
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

	 <!-- Ck editor -->
	 <script src = "../ckeditor/ckeditor.js"></script>
	 <script>
	 ClassicEditor.create(document.getElementById('body'));
	 </script>

	<!-- Custom Script -->
	<script  src="../assets/js/scripts.js"></script>


</body>
</html>


