<?php


/*
* Author: Alec Knutsen
* Date: May 8, 2016
* Description Handles a click event from a button on the Recording_Html page
*/

//Store the recording ID that the user passed in from the Recording_Html page
$record = $_POST["play"];


//Connect to KU EECS
$mysql = mysql_connect("mysql.eecs.ku.edu", "aknutsen", "Password123!");


//Select database
$selected = mysql_select_db("aknutsen",$mysql)
  or die("Could not select examples");


//Select the record (sequency of characters 1-7) for the specified ID and sound_type
$query = mysql_query("SELECT Record, Sound_Type FROM Music WHERE ID = '$record'");


//Loops through all results
while ($row =  mysql_fetch_array($query)) {

		//store the record in $ssound
		$sound = $row{"Record"};

		//store the sound type
		$sound_type = $row{"Sound_Type"};

		//Array to hold timings
		$time_array = array();
		$index =0;

		//Select all the timings from the Timings table for the specified record ID
		$query1 = mysql_query("SELECT TIME FROM Timings WHERE ID = '$record'")or die ("Error in query: $query1. ".mysql_error());

		//Stores all the timings in the timings_array
		while ($row1 =  mysql_fetch_array($query1)) {

			$time_array[$index] = $row1{"TIME"};
			$index = $index +1;
		}


}



?>

<!-- HTML and Javascript-->
<html>

<head>
<title></title>
</head>

<body style="background-color:lightgrey;">


<script language="javascript" >

	//Array to hold sounds
	 var  sound_array = [];
	 //Array to hold timings
	 var time_array = [];

	 //Variable for sound type
	 var sound_type = 1;

	// Function that uses JSON to convert the PHP variables holding the record and timings array to valid javascript variables
	 function storeArray() {


		//Get the timing array into a valid javascript array
		time_array =  '<?php echo json_encode($time_array); ?>';
		time_array = JSON.parse( time_array );

		//Converts the record into an array with a character (0-7) at each index
		var temp_sound =  '<?php echo $sound; ?>';
		for(var i=0; i < temp_sound.toString().length; i++) {
		sound_array[i] = parseInt(temp_sound.toString().substring(i,i+1));
		}

		//Store the sound type
		sound_type = '<?php echo $sound_type; ?>';
		
		//Alert if invalid ID (i.e. sound array is empty)
		if(sound_array.length ==0) {
			
				alert("Invalid ID!");
		}
		
		



	 }

	 //Function to switch sound types
	function switchSets(){

		if(sound_type == 2){
      document.getElementById("audio1").src = "Sounds/DrumSet2/crash-808.wav"
			document.getElementById("audio2").src = "Sounds/DrumSet2/snare808.wav"
			document.getElementById("audio3").src = "Sounds/DrumSet2/hihat808.wav"
			document.getElementById("audio4").src = "Sounds/DrumSet2/tom808Hi.wav"
			document.getElementById("audio5").src = "Sounds/DrumSet2/tom808Lo.wav"
			document.getElementById("audio6").src = "Sounds/DrumSet2/kick808.wav"
			document.getElementById("audio7").src = "Sounds/DrumSet2/cowbell808.wav"

		}
		else if(sound_type == 1){
			document.getElementById("audio1").src = "Sounds/DrumSet1/crash.wav"
			document.getElementById("audio2").src = "Sounds/DrumSet1/snare.wav"
			document.getElementById("audio3").src = "Sounds/DrumSet1/hihat.wav"
			document.getElementById("audio4").src = "Sounds/DrumSet1/hiTom.wav"
			document.getElementById("audio5").src = "Sounds/DrumSet1/floorTom.wav"
			document.getElementById("audio6").src = "Sounds/DrumSet1/kick_Acoustic.wav"
			document.getElementById("audio7").src = "Sounds/DrumSet1/ride.wav"

		}

	}

	 //Plays sound depending on the value of the sound_array at the specified index
	 function playSound(index) {


		//First and not last index
		if(index==0 && index!=sound_array.length) {
			
			//Hide visibility when sounds start
			document.getElementById("pic").style.visibility = "hidden";
			document.getElementById("text").style.visibility = "hidden";
			document.getElementById("text1").style.visibility = "hidden";
			
			//Start patrick gif
			document.getElementById("patrick").style.visibility = "visible";

			//Store all audios
			var audio = document.getElementById('audio1');
			var audio2 = document.getElementById('audio2');
			var audio3 = document.getElementById('audio3');
			var audio4 = document.getElementById('audio4');
			var audio5 = document.getElementById('audio5');
			var audio6 = document.getElementById('audio6');
			var audio7 = document.getElementById('audio7');

			/*
			* Play sounds depeing on what is in the sound_array
			*
			*/
			if(sound_array[index] == 0) {

				if (audio.paused) {
					audio.play();
				}
				else {

					audio.currentTime = 0;
				}

			}

			else if(sound_array[index] == 1) {

				if (audio2.paused) {
					audio2.play();
				}
				else {

					audio2.currentTime = 0;
				}

			}

			else if(sound_array[index] == 2){

				if (audio3.paused) {
					audio3.play();
				}
				else {

					audio3.currentTime = 0;
				}

			}
			else if(sound_array[index] == 3){

				if (audio4.paused) {
					audio4.play();
				}
				else {
					audio4.currentTime = 0;
				}
			}
			else if(sound_array[index] == 4){

				if (audio5.paused) {
					audio5.play();
				}
				else {
					audio5.currentTime = 0;
				}
			}
			else if(sound_array[index] == 5){

				if (audio6.paused) {
					audio6.play();
				}
				else {
					audio6.currentTime = 0;
				}
			}
			else if(sound_array[index] == 6){

				if (audio7.paused) {
					audio7.play();
				}
				else {
					audio7.currentTime = 0;
				}
			}


			/*
			* Delay the next function call by the value in the time_array and recurse
			*
			*/
			setTimeout(function(){playSound(index+1)}, time_array[index]);
			return;

		}

		//Somewhere in the middle (not first or last)
		else if(index!=0 && index!=sound_array.length) {

			//Store all audios
			var audio = document.getElementById('audio1');
			var audio2 = document.getElementById('audio2');
			var audio3 = document.getElementById('audio3');
			var audio4 = document.getElementById('audio4');
			var audio5 = document.getElementById('audio5');
			var audio6 = document.getElementById('audio6');
			var audio7 = document.getElementById('audio7');


			/*
			* Play sounds depeing on what is in the sound_array
			*
			*/

			if(sound_array[index] == 0) {

				if (audio.paused) {
					audio.play();
				}
				else {

					audio.currentTime = 0;
				}

			}

			else if(sound_array[index] == 1) {

				if (audio2.paused) {
					audio2.play();
				}
				else {

					audio2.currentTime = 0;
				}

			}

			else if(sound_array[index] == 2){

				if (audio3.paused) {
					audio3.play();
				}
				else {

					audio3.currentTime = 0;
				}

			}
			else if(sound_array[index] == 3){

				if (audio4.paused) {
					audio4.play();
				}
				else {
					audio4.currentTime = 0;
				}
			}
			else if(sound_array[index] == 4){

				if (audio5.paused) {
					audio5.play();
				}
				else {
					audio5.currentTime = 0;
				}
			}
			else if(sound_array[index] == 5){

				if (audio6.paused) {
					audio6.play();
				}
				else {
					audio6.currentTime = 0;
				}
			}
			else if(sound_array[index] == 6){

				if (audio7.paused) {
					audio7.play();
				}
				else {
					audio7.currentTime = 0;
				}
			}

			/*
			* Delay the next function call by the value in the time_array and recurse
			*
			*/
			setTimeout(function(){playSound(index+1)}, time_array[index]);
			return;

		}

		//Last index
		else {

			//Store all audioss
			var audio = document.getElementById('audio1');
			var audio2 = document.getElementById('audio2');
			var audio3 = document.getElementById('audio3');
			var audio4 = document.getElementById('audio4');
			var audio5 = document.getElementById('audio5');
			var audio6 = document.getElementById('audio6');
			var audio7 = document.getElementById('audio7');


			/*
			* Play sounds depeing on what is in the sound_array
			*
			*/


			if(sound_array[index] == 0) {

				if (audio.paused) {
					audio.play();
				}
				else {

					audio.currentTime = 0;
				}

			}

			else if(sound_array[index] == 1) {

				if (audio2.paused) {
					audio2.play();
				}
				else {

					audio2.currentTime = 0;
				}

			}

			else if(sound_array[index] == 2){

				if (audio3.paused) {
					audio3.play();
				}
				else {

					audio3.currentTime = 0;
				}

			}
			else if(sound_array[index] == 3){

				if (audio4.paused) {
					audio4.play();
				}
				else {
					audio4.currentTime = 0;
				}
			}
			else if(sound_array[index] == 4){

				if (audio5.paused) {
					audio5.play();
				}
				else {
					audio5.currentTime = 0;
				}
			}
			else if(sound_array[index] == 5){

				if (audio6.paused) {
					audio6.play();
				}
				else {
					audio6.currentTime = 0;
				}
			}
			else if(sound_array[index] == 6){

				if (audio7.paused) {
					audio7.play();
				}
				else {
					audio7.currentTime = 0;

				}
			}

			//Reset time and sound arrays on last sounds
			time_array = [];
			sound_array =[];
			
			//Show visibility when sounds end
			document.getElementById("pic").style.visibility = "visible";
			document.getElementById("text").style.visibility = "visible";
			document.getElementById("text1").style.visibility = "visible";
			
			//End patrick gif
			document.getElementById("patrick").style.visibility = "hidden";

			//Return
			return;

		}

	}



	</script>
	
	<center>
		<p id ="text1"><a href ="Recording_Page.html">GO BACK TO RECORDING PAGE</a></p>
		<p id ="text"><b>CLICK NOTES TO PLAY</b></p>
		<!--Clickable image to play sounds-->
		<div>
		<img src="New_Notes.png" id ="pic" height="50" width="1500" id ="image" onclick="storeArray();switchSets(); playSound(0)" />
		</div>
		
		<img src="patrick.gif"  id="patrick" width="600" height="600" style="visibility:hidden;>


			<!--Audio Sources are below-->
	<form action="" method="post">
		<audio id="audio4" src="FinalProjectSounds/DrumSet1/hiTomReal.ogg"></audio>

		<div id="embed"></id>
	</form>
	<form action="" method="post">
                <audio id="audio6" src="FinalProjectSounds/DrumSet1/kick_AcousticReal.ogg"></audio>

		<div id="embed"></div>
	</form>
	<form action="" method="post">
                <audio id="audio1" src="FinalProjectSounds/DrumSet1/crashReal.ogg"></audio>

		<div id="embed"></div>
	</form>
	<form action="" method="post">
                <audio id="audio2" src="FinalProjectSounds/DrumSet1/snareReal.ogg"></audio>

		<div id="embed"></div>
	</form>
	<form action="" method="post">
                <audio id="audio3" src="FinalProjectSounds/DrumSet1/hihatReal.ogg"></audio>

		<div id="embed"></div>
	</form>
	<form action="" method="post">
                <audio id="audio7" src="FinalProjectSounds/DrumSet1/rideReal.ogg"></audio>

		<div id="embed"></div>
	</form>
	<form action="" method="post">
                <audio id="audio5" src="FinalProjectSounds/DrumSet1/floorTomReal2.ogg"></audio>

		<div id="embed"></div>
	</form>
		
	</center>



</body>
</html>
