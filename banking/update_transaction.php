	<a href="logout.php">User logout</a><br>

<?php
	if(isset($_COOKIE['username'])) {
		session_start();
		$user=$_SESSION['userN'];
		include "dbconfig.php";
	    $con = mysqli_connect($host, $username, $password, $dbname)
	  				or die("<br>Cannot connect to DB:$dbname on $host, error: " . mysqli_connect_error());
		$numUpdated = 0;
		$numDelete = 0;

		# update note
		$note = $_POST['note'];
		if(!isset($note)) {
		    echo("no notes");
		}
		else {
			$noteCode = $_POST['noteCode'];
		    for($i = 0; $i < count($note); $i++) {
		    	$sqlNote="SELECT * FROM CPS3740_2022F.Money_furgusl where code='$noteCode[$i]' and note='$note[$i]'";
				$resultNote = mysqli_query($con, $sqlNote);
				$numRowsNote = mysqli_num_rows($resultNote); 
				if($numRowsNote==0) {
					$numUpdated+=1;
					$sqlUpdate = "UPDATE CPS3740_2022F.Money_furgusl set note='$note[$i]' where code='$noteCode[$i]'";
					$resultUpdate = mysqli_query($con, $sqlUpdate);
					echo "<br>The Note for code $noteCode[$i] has been updated in the database.\n";	
				}
		    }	
		}	
		mysqli_free_result($resultNote);

		# delete row
		if(isset($_POST["delete"])) {
			foreach ($_POST["delete"] as $delete) {
	 			 $numDelete+=1;
	 			 $sqlDelete ="DELETE FROM CPS3740_2022F.Money_furgusl WHERE code='$delete'";
	 			 $resultDelete = mysqli_query($con, $sqlDelete); 
	 			 echo "<br>The Code $delete has been deleted from the database.\n"; 
			}
		}
		mysqli_close($con);
		echo "<br> $numUpdated records was updated and $numDelete transactions was deleted.\n";
	} else die("<br>Please login first");	