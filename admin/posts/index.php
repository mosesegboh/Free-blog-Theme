<?php include("../../path.php"); ?>
<?php include (ROOT_PATH . "/app/controllers/posts.php"); 
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
<link rel="stylesheet" href="../../css/style.css">

<!-- Custom Styling -->
<link rel="stylesheet" href="../../css/admin.css">

<!-- Google fonts -->
<link href="https://fonts.googleapis.com/css?family=Candal|Lora&display=swap" rel="stylesheet">
<title>Admin Section - Manage Posts</title>
</head>
<body>
	<header>
		<div class="logo">
			<h1 class = "logo-text"><span>Egboh</span>|Free Blog Theme</h1>	
		</div>
		<i class = "fa fa-bars menu-toggle" ></i>
		<ul class = "nav">
			<li>
				<a href="#">
					<i class="fa fa-user"></i>
					Egboh Moses
					<i class = "fa fa-chevron-down" style = "font-size: .8em;"></i>
				</a>
				<ul>
					<li><a href="#" class = "logout">Logout</a></li>
				</ul>
			</li>
		</ul>
	</header>
			<!-- Admin page wrapper -->
	<div class = "admin-wrapper">

		<!-- Left Side bar -->
		<div class = "left-sidebar">
			<ul>
				<li><a href="index.php">Manage Posts</a></li>
				<li><a href="../users/index.php">Manage Users</a></li>
				<li><a href="../topics /index.php">Manage Topics</a></li>
			</ul>

		</div>
		<!-- //Left Side bar -->

		<!-- Admin Main Content -->
		<div class = "admin-content">
			<div class="button-group">
				<a href="create.php" class= "btn btn-big">Add a Post</a>
				<a href="index.php" class= "btn btn-big">Manage Post</a>
			</div>

			<div class = "content">
				<h2 class="page-title">Manage Posts</h2>

						<!-- display messages -->
						 <?php 
							include(ROOT_PATH ."/app/includes/messages.php");
						 ?>

				<table>
					<thead>
						<th>S/N</th>
						<th>Title</th>
						<th>Author</th>
						<th colspan="3">Action </th>
					</thead>
					<tbody>

						<?php foreach ($posts as $key => $post): ?>

						<tr>
							<td> <?php echo $key+1; ?> </td>
							<td> <?php echo $post['title']; ?> </td>
							<td>Egboh</td>
							<td><a href="edit.php?id=<?php echo $post['id']; ?>" class = "edit">Edit</a></td> <!-- get request with a post with that particular id -->
							<td><a href=" edit.php?delete_id=<?php echo $post['id']; ?> " class = "delete">Delete</a></td>

							<?php if ($post['published']): ?>
								<td><a href="edit.php?published=0&p_id=<?php echo $post['id']; ?>" class = "unpublish">unpublish</a></td> <!-- using the get request to get the published attribute and post id from the form.to unpublish means to set the unpublish feild to 0 as indicated -->
							<?php else: ?>
							<td><a href=" edit.php?published=1&p_id=<?php echo $post['id']; ?> " class = "publish">Publish</a></td>
							<?php endif ?>
						</tr>
							
						<?php endforeach ?>



					</tbody>
				</table>
			</div>
		</div>


		<!-- //Admin Main Content -->

	</div>
	<!-- End Page Wrapper -->


	<!-- JQuery -->
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>


	<!-- Custom Script -->
	<script type="text/javascript" src="../../js/scripts.js"></script>
</body>


</html>


