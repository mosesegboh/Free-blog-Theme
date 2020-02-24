<?php 
include(ROOT_PATH ."/app/database/db.php");
include(ROOT_PATH ."/app/helpers/middleware.php");
include(ROOT_PATH ."/app/helpers/validatePosts.php");

$table = 'posts';//we put this variable ontop becasue we are calling the function below so that it does not say undefined
//to populate the drop down for topics in create posts with the values of topics from our database
$topics = selectAll('topics');
$posts = selectAll($table);


$errors = array();
$id = "";
$title = "";//we have to initialize these variables outside the if statement so that we can use them in the else stament otherwise it undefined
$body = "";//and make them an empty string so that when the form when renders the values will be empty
$topic_id = "";
$published = "";

//access the get varibale if it is set
if (isset($_GET['id'])) { //get variable is a variable in php that helps you receive parameters from the url
	$post = selectOne($table, ['id' => $_GET['id']]);
	//dd($post); we then use the post record to set those values declared above in the form
	$id = $post['id'];
	$title = $post['title'];
	$body = $post['body'];
	$topic_id = $post['topic_id'];
	$published = $post['published'];
} 


//access the get varibale if it is set for the delete id button
if (isset($_GET['delete_id'])) { //get variable is a variable in php that helps you receive parameters from the url
	adminOnly(); //<!-- redirects the user if not an admin function created earlier in middleware.php -->
	$count = delete($table, $_GET['delete_id']);
	$_SESSION['message'] = "Post deleted successfully" ;
	$_SESSION['type'] = "success" ;
	//dd($post_id);//lets be sure the value was submitted
	header("location: " . BASE_URL . "/admin/posts/index.php");
	exit();
} 


if (isset($_GET['published']) && isset($_GET['p_id'])) {
	adminOnly(); //<!-- redirects the user if not an admin function created earlier in middleware.php -->
	$published = $_GET['published'];
	$p_id = $_GET['p_id'];  
	// ...update published
	$count = update($table, $p_id, ['published' => $published]);//the values here is what was gotten from the get variable when updating
	$_SESSION['message'] = "Post publish status has been changed successfully" ;
	$_SESSION['type'] = "success" ;
	//dd($post_id);//lets be sure the value was submitted
	header("location: " . BASE_URL . "/admin/posts/index.php");
	exit();

}

if (isset($_POST['add-post'])) {
	adminOnly(); //<!-- redirects the user if not an admin function created earlier in middleware.php -->
	//dd($_FILES['image']['name']);//php uses the super global to handle all files that has been submitted by out form we dont use post for files
	//note that the files superglobal is an assay of arryay which also has a key value pair relationship
	$errors = validatePost($_POST);
		if (!empty($_FILES['image']['name'])) {
			$image_name = time() . '_' . $_FILES['image']['name'];//by concatenating the time function here makes the image unique it just stated the time the image was uploaded
			$destination = ROOT_PATH . "/assets/images/" . $image_name; //the directory we want to store the image

			$result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);//this function moves the temporary file created when uploading the images to the destination we specified and it return a boolean whether true or false
			if ($result) {
				$_POST['image'] = $image_name; //if its successful, it sets the image as an array value in the $Post variable
				//basicall what was done above is the file was moved to a location in the application an dthe name saved in the database,then when is needed to be displayed,it will point to thay particular location in the app an ddisplayed along eith the post name and details
			} else {
				array_push($errors, "Failed to upload image");
			}
			
		} else {
			array_push($errors, "post image required");
		}

		if (count($errors) === 0) {
			unset($_POST['add-post']);//unset the feilds that are not included in our database table
			//then we add those other values to complete the database table,remember the created at column is updated automatically by mysql
			$_POST['user_id'] = $_SESSION['id'];//we entered this manually for now but we later changed it to their user id because when he is logged in ,it is assumed he is the person that created the post
			$_POST['published'] = isset($_POST['published']) ? 1 : 0;//this statmene basically stated that if the published is set to 1 its published & vice versa basically that us just a shorthand form of an if else statement.
			$_POST['body'] = htmlentities($_POST['body']); //to prevent xxs - cross site scripting to prevent html tags from being entered into the database
			$post_id = create($table, $_POST);
			$_SESSION['message'] = "Post created successfully" ;
			$_SESSION['type'] = "success" ;
			//dd($post_id);//lets be sure the value was submitted
			header("location: " . BASE_URL . "/admin/posts/index.php");
			exit();
		}else{
			$title = $_POST['title'];//the valuse will be left on the form feild so that the user can correct them
			$body = $_POST['body'];
			$topic_id = $_POST['topic_id'];
			$published = isset($_POST['published']) ? 1 : 0;//checkboxes are differenct because if its empty,it wont even be defined.thats why we have to check if it exists forst of all

		}

}


if (isset($_POST['update-post'])){
		adminOnly(); //<!-- redirects the user if not an admin function created earlier in middleware.php -->
			$errors = validatePost($_POST);

		if (!empty($_FILES['image']['name'])) {
			$image_name = time() . '_' . $_FILES['image']['name'];//by concatenating the time function here makes the image unique it just stated the time the image was uploaded
			$destination = ROOT_PATH . "/assets/images/" . $image_name; //the directory we want to store the image

			$result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);//this function moves the temporary file created when uploading the images to the destination we specified and it return a boolean whether true or false
		if ($result) {
				$_POST['image'] = $image_name; //if its successful, it sets the image as an array value in the $Post variable
				//basicall what was done above is the file was moved to a location in the application an dthe name saved in the database,then when is needed to be displayed,it will point to thay particular location in the app an ddisplayed along eith the post name and details
		} else {
				array_push($errors, "Failed to upload image");
				}
				
		} else {
				array_push($errors, "post image required");
				}

		if (count($errors) == 0) {
			$id = $_POST['id'];//we get the id here and unset it on the following line so that it can be used in our update function
			unset($_POST['update-post'], $_POST['id'] );//unset the feilds that are not included in our database table
			//then we add those other values to complete the database table,remember the created at column is updated automatically by mysql
			$_POST['user_id'] = $_SESSION['id'];//we entered this manually for now, we will fix this later on....we also changed this aswell to the user id logged in
			$_POST['published'] = isset($_POST['published']) ? 1 : 0;//this statmene basically stated that if the published is set to 1 its published & vice versa basically that us just a shorthand form of an if else statement.
			$_POST['body'] = htmlentities($_POST['body']); //to prevent xxs - cross site scripting to prevent html tags from being entered into the database
			$post_id = update($table, $id, $_POST);
			//dd($post_id);
			$_SESSION['message'] = "Post updated successfully" ;
			$_SESSION['type'] = "success" ;
			//dd($post_id);//lets be sure the value was submitted
			header("location: " . BASE_URL . "/admin/posts/index.php");
		}else{
			$title = $_POST['title'];//the valuse will be left on the form feild so that the user can correct them
			$body = $_POST['body'];
			$topic_id = $_POST['topic_id'];
			$published = isset($_POST['published']) ? 1 : 0;//checkboxes are differenct because if its empty,it wont even be defined.thats why we have to check if it exists forst of all

		}
}

