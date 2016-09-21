
<?php

/*
* Author: Alec Knutsen
* Date: May 8, 2016
* Description handles recording from main html drum page. When a button is clicked on the main page, this file runs 
*/

//Stores value from the username input box
$author = $_POST["author"];
//Store the value of the record - The record is a String of characters represented 0-7
$record = $_POST["hidden"];
//Store the timings - The timings are a sequency of characters which stores the time betweeen sounds in milliseconds seperated by the character 'a'
$time = $_POST["hidden1"];
//Store the sound type [we have two types]
$sound_type = $_POST["hidden2"];

//Boolean whether to insert post or not
$insert_post = true;

//Connect to KU EECS
$mysql = mysql_connect("mysql.eecs.ku.edu", "aknutsen", "Password123!");


//Selected database
$selected = mysql_select_db("aknutsen",$mysql) 
  or die("Could not select examples");



//If the author was empty, set the boolean to false and echo a message 
if($author == ""){
	$insert_post = false;
   
}

//If the recor was empty, set the boolean to false and echo a message 
if($record == ""){
	$insert_post = false;
   
}



//If the post was not empty and the username exists 
if($insert_post == true) {
	//Enter the author and record and sound_type into the Music Table
	$result = mysql_query("INSERT INTO Music(Author, Record, Sound_Type)
	VALUES ('$author','$record', '$sound_type')");
	
	//Query to get the ID's of the Music recordds from the Music table
	$get_id = mysql_query("SELECT ID FROM Music");

	$max = 0;
	//Gets the maximum ID and stores it in $max. The maximum ID represents the ID of the record just insereted
	while($row =  mysql_fetch_array($get_id))
	{
		if($max <$row{"ID"}) {
			
			$max = $row{"ID"};
			
		}

	}


	$my_time = "";


	//This loop takes the ID and time into the Timings database
	for($i=0; $i <strlen($time); $i++) {
		//Once we have reached the character separator, run the query to store the time
		if($time[$i] == 'a') {
				
			mysql_query("INSERT INTO Timings (ID, TIME)
			VALUES ('$max','$my_time')") or die(mysql_error());
		
			//Reset the my_time string
			$my_time = "";
			continue;
				
		}
		
		//If we have not reached the character separator, keep going
		else {
			
			$my_time = $my_time . $time[$i];
			
		}
	}
	
	//Some embedded html to display a recording if the image was saved
		$image = 'Simon-Cowell-Happy.jpg';
		echo "<html>";
			echo "<head>";
			echo "<title>Recording Database</title>";
			echo "</head>";

			echo"<body>";
			
			echo "<center>";
			
			echo "<p><b>Post saved!</b></p>";
			echo "<p><a href = \"Recording_Page.html\">Recording Database</a></p>";
			echo "<p><a href = \"FinalProject_DABS.html\">Go Back to Main Page</a></p>";

			echo "<img src=".$image." height=\"600\" width=\"700\">";

			echo "</body>";
		echo"</html>";
	

	
}

//If the author or recording was empty
else {
	
		//Some embedded html to display a picture if the image was not saved
		$image = 'simon_cowell.jpg';
		echo "<html>";
			echo "<head>";
			echo "<title>Record</title>";
			echo "</head>";

			echo"<body>";
			
			echo "<center>";
			
			echo "<p><b>Missing Author Content or Record Content! Post not saved!</b></p>";
			echo "<p><a href = \"FinalProject_DABS.html\">Go Back to Main Page</a></p>";

			echo "<img src=".$image." height=\"700\" width=\"700\">";

			echo "</body>";
		echo"</html>";
	
}

?>