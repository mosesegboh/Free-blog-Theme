<?php include("../../path.php"); ?>
<?php include(ROOT_PATH . "/app/controllers/topics.php"); 
adminOnly(); // redirects the user if not an admin function created earlier in middleware.php -->
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
<link rel="stylesheet" href="../../css/style.css">

<!-- Custom Styling -->
<link rel="stylesheet" href="../../css/admin.css">

<!-- Google fonts -->
<link href="https://fonts.googleapis.com/css?family=Candal|Lora&display=swap" rel="stylesheet">
<title>Admin Section - Add Topics</title>

</head>
<body>
	<!-- Admin header here -->
	<?php include (ROOT_PATH . "/app/includes/adminHeader.php"); ?>


			<!-- Admin page wrapper -->
	<div class = "admin-wrapper">

		<!-- Left Side bar -->
		<?php include (ROOT_PATH . "/app/includes/adminSidebar.php"); ?>
		<!-- //Left Side bar -->

		<!-- Admin Main Content -->
		<div class = "admin-content">
			<div class="button-group">
				<a href="create.php" class= "btn btn-big">Add Topic</a>
				<a href="index.php" class= "btn btn-big">Manage Topic</a>
			</div>

			<div class = "content">
				<h2 class="page-title">Add Topic</h2>
				<?php 
				include(ROOT_PATH . "/app/helpers/formErrors.php");
			 	?>

			<form action = "create.php" method="post">
				<div>
					<label>Name</label>
					<input type="text" name="name" value=" <?php echo $name; ?> " class="text-input">
				</div>
				<div>
					<label>Description</label>
					<textarea name="description" id="body"><?php echo $description; ?></textarea>
				</div>
		
				<div>
					
					<button type="submit" name="add-topic" class="btn btn-big">Add Topic</button>
				</div>
			</form>
			</div>
		</div>
		<!-- //Admin Main Content -->

	</div>
	<!-- End Page Wrapper -->


	<!-- JQuery -->
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

	 <!-- Ck editor -->
	 <script src = "../../ckeditor/ckeditor.js"></script>
	 <script>
	 ClassicEditor.create(document.getElementById('body'));
	 </script>

	<!-- Custom Script -->
	<script  src="../../js/scripts.js"></script>


</body>
</html>


