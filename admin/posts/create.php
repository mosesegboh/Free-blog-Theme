<?php include("../../path.php"); ?>
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
<link rel="stylesheet" href="../../assets/css/style.css">

<!-- Custom Styling -->
<link rel="stylesheet" href="../../assets/css/admin.css">

<!-- Google fonts -->
<link href="https://fonts.googleapis.com/css?family=Candal|Lora&display=swap" rel="stylesheet">
<title>Admin Section - Add Posts</title>

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
			<div class="button-group">
				<a href="create.php" class= "btn btn-big">Add a Post</a>
				<a href="index.php" class= "btn btn-big">Manage Post</a>
			</div>

			<div class = "content">
				<h2 class="page-title">Add Posts</h2>

				<?php 
				include(ROOT_PATH . "/app/helpers/formErrors.php");
			 	?>

			<form action = "create.php" method="post" enctype="multipart/form-data"> <!-- the last attribute multi-part must be present when uploading images -->
				<div>
					<label>Title</label>
					<input type="text" value ="<?php echo $title; ?>" name="title"  class="text-input">
				</div>
				<div>
					<label>Body</label>
					<textarea name="body"  id="body"><?php echo $body; ?></textarea>
				</div>
				<div>
					<label>Image</label>
					<input type="file" name="image" class="tex-input">
				</div>
				<div>
					<label>Topic</label>
					<select name="topic_id" class= "text-input">
						<option value=""></option>

						<?php foreach ($topics as $key => $topic): ?>

							<?php if (!empty($topic_id) && $topic_id == $topic[id]): ?> <!-- if the topic user selected on the form = topic being looped over, -->
								<option selected value=" <?php echo $topic['id'] ?> "><?php echo $topic['name'] ?></option> <!--if conition above is met.mark as select the id was chosen because that is what relates to each other between the topic an dthe post. -->
							<?php else: ?>
								<option value=" <?php echo $topic['id'] ?> "><?php echo $topic['name'] ?></option> <!-- else.marke as unselected......the id was chosen because that is what relates to each other between the topic an dthe post. -->
							<?php endif ?>


							
						<?php endforeach ?>

						

					</select>
				</div>
				<div>
					<?php if (empty($published)): ?> <!-- to check if it was selected by the user when errors display -->
					<label>
							<input type = "checkbox" name="published" >
							Publish
					</label>
					<?php else: ?>
					<label>
							<input type = "checkbox" name="published" checked>
							Publish
					</label>
					<?php endif ?>
						
				</div>	

				<div>
					<button type="submit" name="add-post" class="btn btn-big">Add Posts</button>
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
	<script  src="../../assets/js/scripts.js"></script>


</body>
</html>


