 <?php 
 include(ROOT_PATH ."/app/database/db.php");
 include(ROOT_PATH ."/app/helpers/middleware.php");
 include(ROOT_PATH ."/app/helpers/validateUsers.php");

 		$table = 'users'; //we will be using 'users' a lot as the table name,hence lets initialize a variable with that name and replace it in the functions below...also we brought this variable to the top so that we can use it in our select all function

 		$admin_users = selectAll($table, ['admin' => 1]);//if ypu want the admin to be able to edit or add all users instead of admin users.just remove this second admin parameter in this function

		$errors = array();//this variable was declared at the top here so that it will be available in our form at register.php...remember thus file was included
		$id = '';
		$username = '';
		$email = '';
		$password = '';
		$passwordConf = '';
		$admin = '';
		


		function loginUser($user){//this code was repeated twice below, so we create a functin here to be called when we need it
				$_SESSION['id'] = $user['id'];//to identify the user if they take sertain action on the website
				$_SESSION['username'] = $user['username'];//to dipsplay username in the navigation bar
				$_SESSION['admin'] = $user['admin'];//to know if the user is an admin user....you can save user info data in sessions when loggin in if you think you will use that info later on.
				$_SESSION['message'] = 'You are now logged in!';// inorder to display user success message
				$_SESSION['type'] = 'success';//the css success class we defined earlier
				if ($_SESSION['admin']) {	//using is statement to redirect the user if admin or not
					header('location: ' . BASE_URL . '/admin/dashboard.php');
				} else {
					header('location: ' . BASE_URL . '/index.php');
				}		
				exit();
		}

	if(isset($_POST['register-btn']) || isset($_POST['create-admin'])){//the $_post variabe is an array which serves individual inputs  from the form if you use var_dump($_POST) it will print out individual posts inputs too the screen
			$errors = validateUser($_POST);// this function was called because it was cut because it was too long and it was then used as a function in the vallidateUsers file

		if (count($errors)===0) {
			unset($_POST['register-btn'], $_POST['passwordConf'], $_POST['create-admin'] );//this function removes some keys in an array ...we used it here becasue we dont have password conf and register btn keys in our database,also we need to unset the create admin buttton as well
			$_POST ['password'] = password_hash($_POST ['password'], PASSWORD_DEFAULT);//encrypt the password

			if (isset($_POST['admin'])) {//if the form values has an admin properties
				$_POST['admin'] = 1;
				$user_id = create($table, $_POST);
				$_SESSION['message'] = 'Admin User created successfully!';// inorder to display user success message
				$_SESSION['type'] = 'success';//the css success class we defined earlier
				header('location: ' . BASE_URL . '/admin/users/index.php');
				exit();
			} else {
				
			$_POST['admin'] = 0;//we also need to add a new value key pair to our function because we have an admin field in the database and it is set to zero because a user is 0 at first
			$user_id = create($table, $_POST);//remember the create method returns the user id in the other page
			$user = selectOne($table, ['id'=> $user_id]);
			//the ablove lines of codes registers the user
			// the below sets of code logs the user in using the session...login is basically storing user values in the session even though they migrate to other pages on the website
			loginUser($user);//invoke the login user method
			}
			
		}else{
			$username = $_POST['username'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$passwordConf = $_POST['passwordConf'];
			$admin = isset($_POST['admin']) ? 1 : 0;
		}
	}

	if (isset($_POST['update-user'])) {
		adminOnly(); //<!-- redirects the user if not an admin function created earlier in middleware.php -->
		//dd($_POST); //to check if any item was actually submitted
		$errors = validateUser($_POST);// this function was called because it was cut because it was too long and it was then used as a function in the vallidateUsers file

		if (count($errors)===0) {
			$id = $_POST['admin'];//before being unset below we have to give it a value because we wont be updating it in the table
			unset($_POST['passwordConf'], $_POST['update-user'], $_POST['id'] );//this function removes some keys in an array ...we used it here becasue we dont have password conf and register btn keys in our database,also we need to unset the create admin buttton as well
			$_POST ['password'] = password_hash($_POST ['password'], PASSWORD_DEFAULT);//encrypt the password
			$_POST['admin'] = isset($_POST['admin']) ? 1 : 0;//we are getting the admin properties from the form if it was checked
			$count = update($table, $id, $_POST);//invoke the update method which returns a count of the number of affected rows
			$_SESSION['message'] = 'Admin User created successfully!';// inorder to display user success message
			$_SESSION['type'] = 'success';//the css success class we defined earlier
			header('location: ' . BASE_URL . '/admin/users/index.php');
			exit();
			} 
			
		else{
			$username = $_POST['username'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$passwordConf = $_POST['passwordConf'];
			$admin = isset($_POST['admin']) ? 1 : 0;
		}
	}


	if (isset($_GET['id'])) {
		$user = selectOne($table, ['id' => $_GET['id']]);
		//dd($user);//lets confirm if our code works
		$id = $user['id'];
		$username = $user['username']; //then assign these values with the values gotten from the database from the select onr function
		$admin = $user['admin']== 1 ? 1 : 0;//this is an else if statement in short form
		$email = $user['email'];
		//after we get them we can then place then as a value in out edit.php form attribute
	} 
	


	if (isset($_POST['login-btn'])) {
		//dd($_POST); you can do this to test if the user actually logged in
		$errors = validateLogin($_POST);
		if (count($errors)===0) {
			$user = selectOne($table, ['username' => $_POST['username']]);
			if ($user && password_verify($_POST['password'], $user['password'])) {
				//login user
			loginUser($user);	//invoke the login user method
			}else{
				array_push($errors, 'Invalid Username or Password!'); 
			}
		}	
		$username = $_POST['username'];
		$password = $_POST['password'];
	}

	if (isset($_GET['delete_id'])) {
		adminOnly(); //<!-- redirects the user if not an admin function created earlier in middleware.php -->
		$count = delete($table, $_GET['delete_id']);
		$_SESSION['message'] = 'Admin User deleted successfully!';// inorder to display user success message
		$_SESSION['type'] = 'success';//the css success class we defined earlier
		header('location: ' . BASE_URL . '/admin/users/index.php');
		exit();
	}
 
 //some causes of errors
	//1. not unsetting certain feilds when using the functions created with forms
	//2. not includeing certain files
	//3. syntax errors
	//3 when emppty string is entered as in the case of forms
	//5. if a variable is declared above a function
	//5. empty strings being inserted initially can also cause problems
	//7 bind param can be caused by the sql query or function aswell, you can solve it by declaring a variable to replace any quoted value in the sql statement