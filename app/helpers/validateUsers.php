<?php 



function validateUser($user){ //we are creating this function to help us validate users instead of doing it inside the users.php page
		$errors  = array();
		if (empty($user['username'])) { //note that the post variable was change to user becaause thats what was used when creating the function
			array_push($errors, "Username is required");
		}

		if (empty($user['email'])) {
			array_push($errors, "Email is required");	
		}

		if (empty($user['password'])) {
			array_push($errors, "Password is required");	
		}

		if ($user['passwordConf'] != $_POST['password']) {
			array_push($errors, "Passwords do not match");	
		}

		$existingUser = selectOne('users', ['email' => $user['email']]); //the function we created earlier
		if ($existingUser) { // we removed the isset method,becauss the isset method is just to check is a variable exists just the variable name will be enough to check if the user actually exist in the database
			array_push($errors, "Email already exist");
		}
	return $errors; 
}

//validate login
function validateLogin($user){ //we are creating this function to help us validate Login instead of doing it inside the users.php page
		$errors  = array();
		if (empty($user['username'])) { //note that the post variable was change to user becaause thats what was used when creating the function
			array_push($errors, "Username is required");
		}

		if (empty($user['password'])) {
			array_push($errors, "Password is required");	
		}

	return $errors; 
}