<?php

/*
* Author: Alec Knutsen
* Date: May 8, 2016
* Description handles deletng record from Music table
*/

//Connect to the sql database 
$mysqli = new mysqli("mysql.eecs.ku.edu", "aknutsen", "Password123!", "aknutsen");

// Check the sql conenction 
if ($mysqli->connect_errno) {
	printf("Connect failed: %s\n", $mysqli->connect_error);
	exit();
}

//Select all the records from Music
$query = "SELECT ID FROM Music";



if ($result = $mysqli->query($query)) {
	
	

	//Loops through all the records
	while ($row = $result->fetch_assoc()) {
		
			
		//Store record ID
		$my_row = $row["ID"];
		
		
		
		//If the checkbox on the Recording_Page is checked with the specified post ID
		if(isset($_POST[$my_row])) {

			//Create a query to delete the Record
			$delete_query = "DELETE FROM Music WHERE ID = $my_row";
			//Delete the record and print a message
			if ($result1 = $mysqli->query($delete_query)) {
				echo "Record with Post ID " . $my_row . " Deleted!" . "<br>";
			}
		}
	}
	
	echo "<p><a href = \"Recording_Page.html\">Go Back to Recording Page</a></p>";

	/* free result set */
	$result->free();
}


?>