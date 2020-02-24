<?php if (isset($_SESSION['message'])): ?> <!-- if message exists in the session -->
	 <div class = "msg <?php echo $_SESSION['type']; ?>"> <!-- the echoed type is the css session already created when we were login in the user -->
	 	<li> <?php echo $_SESSION['message'] ; ?> </li>
	 </div>	
	 <?php endif; ?>

	 <?php 
	 	unset($_SESSION['message']);//unset the messages after displaying them once
	 	unset($_SESSION['type']);
	 ?>