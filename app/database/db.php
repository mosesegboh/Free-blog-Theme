<?php 
session_start();//this starts this session which will be available in every page it is included in.plus most of the files that use db will also use sessions
require('connect.php'); 


//temporary fuction to test and dump results from the database similar to var_dump
function dd($value){
	echo "<pre>", print_r($value, true), "</pre>"; //makes the database connection in a readable format
	die();
}

 function executeQuery($sql,$data)//this function just executes the query to avoid repitition of code below which is good practice
{
	global $conn;
	$stmt = $conn->prepare($sql);
	$values = array_values($data);//this function extracts the values from our an array which is conditions
	$types = str_repeat('s', count($values));//as you can see this functtion repeats the number of strings passed as conditions into the types variable which is then ussed below
	$stmt->bind_param($types, ...$values);//bind param to prevent sql injection and the types varaible there tells the function how many condition with datatype was passed and the dot dot dot will seperate the values for you.
	$stmt->execute();
	return $stmt;
}

//function that select records from the database which can be reused
function selectAll($table, $conditions = []){		//the second parameter is optional hence we gave it an initial value which is that empty array but if it has a value then it is not optional
	global $conn;
	$sql = "SELECT * FROM $table";
	if (empty($conditions)) {
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
	return $records;
}else{
	//return records that match the condition using a for each loop
	$i=0;
	foreach ($conditions as $key => $value) {
			if ($i==0) {
				$sql = $sql . " WHERE $key=?";
			}else{
				$sql = $sql . " AND $key=?";
			}	
			$i++;
		}	
		$stmt = executeQuery($sql, $conditions);//remember we were binding and executing here before we created the execute function above
		$records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
		return $records;
	}	
}


function selectOne($table, $conditions){//the second parameter is optional hence we gave it an initial value which is that empty array but if it has a value then it is not optional
	global $conn;
	$sql = "SELECT * FROM $table";
	$i=0;
	foreach ($conditions as $key => $value) {
		if ($i==0) {
			$sql = $sql . " WHERE $key=?";//we are basically concatenating with the sql statement here and other places where such exists
		}else{
			$sql = $sql . " AND $key=?";
		}	
		$i++;
	}	
	$sql = $sql . " LIMIT 1";

	$stmt = executeQuery($sql, $conditions);//remember we were binding and executing here before we created the execute function above
	$records = $stmt->get_result()->fetch_assoc();
	return $records;
}

function create($table, $data){
	global $conn;
	$sql = "INSERT INTO $table SET ";
	//username=?, admin=?, email=?, password=?

	$i=0;
	foreach ($data as $key => $value) {
		if ($i==0) {
			$sql = $sql . " $key=?";
		}else{
			$sql = $sql . ", $key=?";
		}	
		$i++;
	}	
	
	$stmt = executeQuery($sql, $data);//remember we were binding and executing here before we created the execute function above
	$id = $stmt -> insert_id;//this function basically gets the id of the affected row from the database
	return $id;
}


function update($table, $id, $data){
	global $conn;
	$sql = "UPDATE $table SET ";

	$i=0;
	foreach ($data as $key => $value) {
		if ($i==0) {
			$sql = $sql . " $key=?";
		}else{
			$sql = $sql . ", $key=?";
		}	
		$i++;
	}	

	$sql= $sql . " WHERE id=? ";
	$data['id'] = $id;//add a new key value pair to the array,attach the id to the array similar to python array treatment because the number of parameters in the sql statement must be equal to data parameters
	$stmt = executeQuery($sql, $data);//remember we were binding and executing here before we created the execute function above
	return $stmt->affected_rows;//if it gives 0 ,it didnt update but if it gives one then is updated the affected rows
}


function delete($table, $id){
	global $conn;
	$sql = "DELETE FROM $table WHERE id=?";

	$stmt = executeQuery($sql, ['id'=> $id]);//the reason why the id is inputed as an associative array is beasuse the execute funtoion as defined earlier only takes in an associative arrya as second parameter..check above to confirm
	return $stmt->affected_rows;//if it gives 0 ,it didnt update but if it gives one then is updated the affected rows
}

function getPublishedposts() { //to address the issue of post by since the data comes  from 2 different tables
	global $conn;
	//"SELECT * FROM posts WHERE published=1"

	$sql ="SELECT p.*, u.username FROM posts AS p JOIN users AS u  ON p.user_id=u.id WHERE p.published=? ";//this query selects from 2 tables
	$stmt = executeQuery($sql, ['published' => 1]);//we decided to put the condtions here
	$records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
	return $records;
}

function getPostsByTopicId($topic_id) { //to address the issue of post by since the data comes  from 2 different tables
	global $conn;
	//"SELECT * FROM posts WHERE published=1"

	$sql ="SELECT p.*, u.username FROM posts AS p JOIN users AS u  ON p.user_id=u.id WHERE p.published=? AND topic_id=? ";//this query selects from 2 tables
	$stmt = executeQuery($sql, ['published' => 1, 'topic_id' => $topic_id]);//we decided to put the condtions here
	$records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
	return $records;
}


function searchPosts($term) { //to address the issue of post by since the data comes  from 2 different tables
	$match = '%' . $term . '%';//we declared a vairbale here to solve the bind param error
	global $conn;
	//"SELECT * FROM posts WHERE published=1"

	$sql ="SELECT p.*, u.username
			 FROM posts AS p
			  JOIN users AS u 		
			    ON p.user_id=u.id 
			    WHERE p.published=? 
			    AND p.title LIKE ? OR p.body LIKE ? 
			    ";//this query selects from 2 tables
	$stmt = executeQuery($sql, ['published' => 1, 'title' => $match, 'body' => $match]);//we decided to put the condtions here...you can add more than one term...then we put the match here and questoin mark above to avoid sql injection
	$records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
	return $records;
}











