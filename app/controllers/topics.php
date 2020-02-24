<?php 
include(ROOT_PATH ."/app/database/db.php");
include(ROOT_PATH ."/app/helpers/middleware.php");
include(ROOT_PATH ."/app/helpers/validateTopic.php");

//lets define some globlae variables here which will be available for the form feild

$errors =array();//intitialize errors variable for validating the form
$table = 'topics';
$id = '';
$name = '';
$description = '';


$topics = selectAll($table); //function created ealier....topics was replaces with table because it was overused
//dd($topics); // you can call this function to confirm if it is still fetching data and it did so lets continue


 
 //if the add topic button was clicked
if (isset($_POST['add-topic'])) {
	adminOnly(); //<!-- redirects the user if not an admin function created earlier in middleware.php -->
	$errors = validateTopic($_POST); //calling the validate topics function to validate the errors form..i personall put in the name field instead of the wholr $_POST variable which the teacher did becasue it didnt work
	if (count($errors) === 0 ) {
		unset($_POST['add-topic']); //to remove the add topic field from the post array which is not included in the topic table and our create method created does not take it aswell
		$topic_id = create('topics', $_POST);//the create table we did earlier
		$_SESSION['message'] = 'Topic created succesfully';
		$_SESSION['type'] = 'success';//the css class we created earlier
		header('location: ' . BASE_URL . '/admin/topics/index.php'); //redirect
		exit();//after redirect you exit
	}else{
		$name = $_POST['name']; //put errors back into the form for the users to be able to correct and display them
		$description = $_POST['description'];
	}
}

//we want to fetch the topic details from the id of the url and display the values on the edit page forms for editing
if (isset($_GET['id'])) { //we are using the get variable here since the id is displayed in the url as stated in the edit link earlier
	$id = $_GET['id'];//get the id from the url and save in the variable
	$topic = selectOne($table, ['id' => $id]);//use the select one functon created ealier and put in the parameters with the id as the key value pair
	$id = $topic['id']; //save the values from the daabase in the variable so that it can be displayed in the form
	$name = $topic['name']; 
	$description = $topic['description']; 
}

if (isset($_GET['del_id'])){ //if there is any variable in the supre global get i.e if the get request is set,
	adminOnly(); //<!-- redirects the user if not an admin function created earlier in middleware.php -->
	$id= $_GET['del_id'];
	$count = delete($table, $id);
	$_SESSION['message'] = 'Topic deleted succesfully';
	$_SESSION['type'] = 'success';//the css class we created earlier
	header('location: ' . BASE_URL . '/admin/topics/index.php'); //redirect
	exit();//after redirect you exit


}



//if the user clicks on the update button
if (isset($_POST['update-topic'])) {
	adminOnly(); //<!-- redirects the user if not an admin function created earlier in middleware.php -->

	$errors = validateTopic($_POST); //calling the validate topics function to validate the errors form..i personall put in the name field instead of the wholr $_POST variable which the teacher did becasue it didnt work
	if (count($errors) === 0 ) {
		//dd($_POST);use this to check if the values was actually sent
		$id = $_POST['id'];//remember the id does not change in the update method but we will use it for something else which is the update one function
		unset($_POST['update-topic'], $_POST['id']);//we dont need this in our function so we unset
		$topic_id = update($table, $id, $_POST);
		$_SESSION['message'] = 'Topic updated succesfully';
		$_SESSION['type'] = 'success';//the css class we created earlier
		header('location: ' . BASE_URL . '/admin/topics/index.php'); //redirect
		exit();//after redirect you exit
	}else{
		$id = $_POST['id']; //since we updating ,the user will also be passing the id so this is necassary here
		$name = $_POST['name']; //put errors back into the form for the users to be able to correct and display them
		$description = $_POST['description'];
	}
	
}



 ?>