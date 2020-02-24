<?php include("../../path.php"); ?>
<?php include (ROOT_PATH . "/app/controllers/users.php"); 
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
<title>Admin Section - Manage Users</title>
</head>
<body>
		<!-- Include Admin header here -->
		<?php Include (ROOT_PATH . "/app/includes/adminHeader.php"); ?>


			<!-- Admin page wrapper -->
	<div class = "admin-wrapper">

		<!-- Left Side bar -->
		<?php Include (ROOT_PATH . "/app/includes/adminSidebar.php"); ?>
		<!-- //Left Side bar -->

		<!-- Admin Main Content -->
		<div class = "admin-content">
			<div class="button-group">
				<a href="create.php" class= "btn btn-big">Add Users</a>
				<a href="index.php" class= "btn btn-big">Manage Users</a>
			</div>

			<div class = "content">
				<h2 class="page-title">Manage Users</h2>

					<!-- display messages -->
				 <?php 
					include(ROOT_PATH ."/app/includes/messages.php");
				 ?>

				<table>
					<thead>
						<th>S/N</th>
						<th>Username</th>
						<th>Email</th>
						<th colspan="2">Action </th>
					</thead>
					<tbody>
							<?php foreach ($admin_users as $key => $user): ?>
								<tr>
									<td><?php echo $key + 1; ?> </td>
									<td> <?php echo $user['username'] ?> </td>
									<td><?php echo $user['email'] ?></td>
									<td><a href="edit.php?id=<?php echo $user['id']; ?>" class = "edit">Edit</a></td>
									<td><a href="index.php?delete_id=<?php echo $user['id']; ?>" class = "delete">Delete</a></td>
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




