<?php include("path.php") ?>
<?php include (ROOT_PATH . "/app/controllers/posts.php"); 


//getting the id of the post via our url
if (isset($_GET['id'])) {
	$post = selectOne('posts', ['id' => $_GET['id']]);
	//dd($post); check if isset
}

$topics = selectAll('topics');
$posts = selectAll('posts', ['published' => 1] );


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
<title><?php echo $post['title']; ?> | Egboh Free blog theme</title>
</head>
<body>
	<!-- facebook page plugin sdk -->
	<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v5.0"></script>

	<!-- header included here -->
	<?php 
		include(ROOT_PATH ."/app/includes/header.php");
	 ?>

			<!-- page wrapper -->
	<div class = "page-wrapper">
		

		<!-- Content -->
		<div  class = "content clearfix">
			<!-- Main Content wrapper -->
			<div class="main-content-wrapper">
				<div class="main-content single">
				<h1 class="post-title"><?php echo $post['title']; ?></h1>	
					<div class="post-content">
						<?php 

						echo html_entity_decode($post['body']);

						 ?>

						
					</div>		
				</div>
			</div>
			<!-- Main Content end -->

			<!-- sidebar -->
				<div class="sidebar single">

					<div class="fb-page" data-href="https://www.facebook.com/mozettyservices/" data-tabs="" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/mozettyservices/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/mozettyservices/">mozettyservices.com</a></blockquote></div>

					<div class="section popular">
						<h2 class="section-title">Popular</h2>

							<?php foreach ($posts as $p): ?> <!-- we used p here to avoid confusion with the other variable described above -->
									<div class="post clearfix">
										<img src="<?php echo BASE_URL . '/assets/images/' . $p['image']; ?>" alt="">
										<a href="" class="title">
										<h4><?php echo $p['title'] ?></h4></a>
									</div>
							<?php endforeach ?>


					

					</div>
					<div class="section topics">
						<h2 class="section-title">Topics</h2>
						<ul>
							<?php foreach ($topics as $topic): ?>
							<li><a href="<?php echo BASE_URL . '/index.php?t_id=' . $topic['id'] . '&name=' . $topic['name'] ?>"><?php echo $topic['name'] ?>"><?php echo $topic['name']; ?></a></li> <!-- we are poiting the ink to the index pahge an dpassing the topic id as a parameter in the get variable -->
								
							<?php endforeach ?>
							
							
						</ul>

					</div>
				</div>	
			<!-- sidebar end -->
		</div>



		<!-- Content-end -->
	</div>
	<!-- Page Wrapper -->

	<!-- footer included here -->
	<?php 
		include(ROOT_PATH ."/app/includes/footer.php");
	 ?>

	<!-- JQuery -->
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

    <!-- Slick Carousel script -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.min.js"></script>

	<!-- Custom Script -->
	<script type="text/javascript" src="js/scripts.js"></script>
</body>


</html>


