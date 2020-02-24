<?php 

function usersOnly($redirect = '/index.php'){ //this function redirects to the index.php page if the user is a normal user
	if (empty($_SESSION['id'])) {  //if user is not logged in
		$_SESSION['message'] = 'You need to login first';
		$_SESSION['type'] = 'error';
		header('location:' . BASE_URL . $redirect );
		exit(0);
	}
}

function adminOnly($redirect = '/index.php'){ //if the user is not an admin
	if (empty($_SESSION['id']) || empty($_SESSION['admin'])) {		//remember we wer always storing the admin property of users....if user is not logged in but not an admin user
		$_SESSION['message'] = 'You are not authorized';
		$_SESSION['type'] = 'error';
		header('location:' . BASE_URL . $redirect );
		exit(0);
	}
}

function guestOnly($redirect = '/index.php'){
	if (isset($_SESSION['id'])) {  //if user is not logged in
		header('location:' . BASE_URL . $redirect );
		exit(0);

	}
 }

 ?>