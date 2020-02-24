<?php 

function validatePost($post){ //we are creating this function to help us validate posts instead of doing it inside the users.php page
		$errors  = array();
		
		if (empty($post['title'])) { //note that the post variable was change to post becaause thats what was used when creating the function
			array_push($errors, "Title is required");
		}

		if (empty($post['body'])) {
			array_push($errors, "body is required");	
		}

		if (empty($post['topic_id'])) {
			array_push($errors, "please select a topic");	
		}


		$existingPost = selectOne('posts', ['title' => $post['title']]); //the function we created earlier
		if (isset($existingPost)) { // we removed the isset method,becauss the isset method is just to check is a variable exists just the variable name will be enough to check if the user actually exist in the database
			if (isset($_POST['update-post']) && $existingPost['id'] != $_POST['id']) { //we need to validate this our post function
				array_push($errors, "Post with such title already exist");
			}

			if (isset($_POST['add-post'])) {
					array_push($errors, "Post with such title already exist");//to check when the user is tring to create a post
				}	
		}
	return $errors; 
}


 ?>