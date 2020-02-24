<?php
	//creating a function that points the the root of the application,if you use var dump and go to 'path url',it should show the directory to the root folder 
	define('ROOT_PATH', realpath(dirname(__FILE__)));
	define('BASE_URL', "http://localhost/blog");//similar to roopath but for links and urls make sure you include the path.php at the top of all pages
	
?>

 