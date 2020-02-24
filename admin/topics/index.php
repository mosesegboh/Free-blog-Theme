<?php include("../../path.php"); ?>
<?php include (ROOT_PATH . "/app/controllers/topics.php"); 
adminOnly(); //<!-- redirects the user if not an admin function created earlier in middleware.php -->
?>



<!DOCTYPE html>
<html lang="en">
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
<title>Admin Section - Manage Topics</title>
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
				<li><a href="../posts/index.html">Manage Posts</a></li>
				<li><a href="../users/index.html">Manage Users</a></li>
				<li><a href="index.html">Manage Topics</a></li>
			</ul>

		</div>
		<!-- //Left Side bar -->

		<!-- Admin Main Content -->
		<div class = "admin-content">
			<div class="button-group">
				<a href="create.php" class= "btn btn-big">Add Topic</a>
				<a href="index.php" class= "btn btn-big">Manage Topic</a>
			</div>

			<div class = "content">
				<h2 class="page-title">Manage Topics</h2>

				<!-- display messages -->
				 <?php 
					include(ROOT_PATH ."/app/includes/messages.php");
				 ?>

				<table>
					<thead>
						<th>S/N</th>
						<th>Name</th>
						<th colspan="2">Action </th>
					</thead>
					<tbody>

							<?php foreach ($topics as $key => $topic): ?>
							<tr>
							<td> <?php echo $key + 1; ?> </td> <!--  this is the serial number ....+1 to start counting from 1 -->
							<td> <?php echo $topic['name']; ?> </td> <!-- this is the topic name which is the value of the array key name -->
							<td><a href=" edit.php?id=<?php echo $topic['id']; ?>" class = "edit">Edit</a></td> <!-- the code in the href is to select the particular topic with the id displayed above (you can see this in the url) for editing -->
							<td><a href="index.php?del_id=<?php echo $topic['id']; ?> " class = "delete">Delete</a></td> <!-- we are generating a get is request to be used to delete the value with the id above -->
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


