<?php 



function validateTopic($topic){ //we are creating this function to help us validate users instead of doing it inside the users.php page
		$errors  = array();
		if (empty($topic['name'])) { //note that the post variable was change to user becaause thats what was used when creating the function
			array_push($errors, "Topic name is required");
		}


		$existingTopic = selectOne('topics', ['name' => $topic['name']]); //the function we created earlier
		if ($existingTopic) {
			array_push($errors, "Topic already exist");
		}
	return $errors; 
}
