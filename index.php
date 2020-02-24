
<?php include("path.php"); ?>
<?php include (ROOT_PATH . "/app/controllers/topics.php"); 

 //$posts = selectAll('posts', ['published' => 1]);//this is the reason he is using $post instead of global post variable
 //dd($posts);//lets display the posts and see what was gotten from the database
	
	//dd($posts);

	$posts = array();
	$postTitle = 'Recent Posts';

	if (isset($_GET['t_id'])) { //notice how we brought these functions to the top
		$posts = getPostsByTopicId ($_GET['t_id']); 
		$postTitle = "You searched for posts under '" . $_GET['name'] . "'";//we were able to use the topic name variable here by sending the parameter via the get variabl as well
		
	}else if (isset($_POST['search-term'])) { //receive search form submission
	$postTitle = "You searched for:'" . $_POST['search-term'] . "'";
	$posts = searchPosts($_POST['search-term']) ;
	}else{
		$posts = getPublishedPosts();
	}
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
<link rel="stylesheet" href="assets/css/style.css">
<!-- Google fonts -->
<link href="https://fonts.googleapis.com/css?family=Candal|Lora&display=swap" rel="stylesheet">
<title>Blog</title>
</head>
<body>

	<!-- include header here -->
	<?php 
		include(ROOT_PATH ."/app/includes/header.php");
	?>

	 <?php 
		include(ROOT_PATH ."/app/includes/messages.php");
	 ?>

	 

			<!-- page wrapper -->
	<div class = "page-wrapper">
		<!-- Post Slider -->
				<div class = "post-slider">
					<h1 class = "slider-title">Trending Posts</h1>
					<i class = "fas fa-chevron-left prev"></i>
					<i class = "fas fa-chevron-right next"></i>
					<div class = "post-wrapper">

						<?php foreach ($posts as $key => $post): ?>
							<!-- single post -->
						<div class = "post">
							<img src="<?php echo BASE_URL . '/assets/images/' . $post['image']; ?>" alt="" class="slider-image"> <!-- what was done here regarding the image is that when we saved the images we saved it with a particulr name and moved the files to our folder,so when we want to display it,we just get the name from the database which is the $post variable and point it to that location -->
							<div class= "post-info">
								<h4><a href="single.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h4><!-- we pull the particular post title -->
								<i class = "far fa-user"><?php echo $post['username'] ?></i>
								&nbsp;
								<i class = "far fa-calender"> <?php echo date('F j, Y', strtotime($post['created_at'])); ?></i> <!-- lets display the date in a more readable format -->
							</div>
						</div>
						<!-- single post end -->
							
						<?php endforeach ?>

						
				
						
					</div>
				</div>
		<!-- Post Slider end -->

		<!-- Content -->
		<div  class = "content clearfix">

			<!-- Main Content -->
			<div class="main-content">
				<h1 class="recent-post-title"><?php echo $postTitle; ?></h1>

				<?php foreach ($posts as $post): ?>

					<div class="post clearfix">
						<img src="<?php echo BASE_URL . '/assets/images/' . $post['image']; ?>" alt="" class="post-image">
						<div class="post-preview">
							<h2><a href="single.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h2>
							<i class="far fa-user"><?php echo $post['username'] ?></i>
							&nbsp;
							<i class="far calendar"><?php echo date('F j, Y', strtotime($post['created_at'])); ?></i>
							<p class="preview-text">
							<?php echo html_entity_decode(substr($post['body'], 0, 200)) . '...' ?> <!-- the substr function breaks the string -->
							</p>
							<a href="single.php?id=<?php echo $post['id']; ?>" class = "btn read-more">Readmore</a>
						</div>
					</div>
					
				<?php endforeach ?>
			</div>
					


				

			



			<!-- Main Content -->
			<div class="sidebar">
				<div class="section search">
					<h2 class="section-title">Search</h2>
					<form action = "index.php" method = "post">
						<input type = "text" name="search-term" class= "text-input" placeholder="Search....."></input>
					</form>
				</div>

				<div class="section topics">
					<h2 class="section-title">Topics</h2>
					<ul>
					<?php foreach ($topics as $key => $topic): ?>
						<li><a href="<?php echo BASE_URL . '/index.php?t_id=' . $topic['id'] . '&name=' . $topic['name']; ?>"><?php echo $topic['name'] ?></a></li> <!-- we can send more than one get variable to the url which is what we have done here by appending -->
					<?php endforeach; ?>
					</ul>

				</div>
			</div>	
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
	<script type="text/javascript" src="assets/js/scripts.js"></script>
</body>


</html>


