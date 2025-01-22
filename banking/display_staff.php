<?php
	include "dbconfig.php";

	$con = mysqli_connect($host, $username, $password, $dbname)
      or die("<br>Cannot connect to DB:$dbname on $host, error: " . mysqli_connect_error());

	$sql="select * from dreamhome.Staff"; 
	$result = mysqli_query($con, $sql); 
	 
	#echo "<br>SQL: $sql\n";
	 
	if ($result) {
		if (mysqli_num_rows($result)>0) {
			echo "<TABLE border=1>\n";
			echo "<TR>
					<TH>Staffno</TH>
					<TH>fname</TH>
					<TH>lname</TH>
					<TH>position</TH>
					<TH>sex</TH>
					<TH>DOB</TH>
					<TH>salary</TH>
					<TH>branchno</TH>
				   </TR>";
		    while($row = mysqli_fetch_array($result)){
		        $Staffno = $row["staffNo"];
		        $fname = $row["fName"];
		        $lname = $row["lName"];
		        $position = $row["position"];
		        $sex = $row["sex"];
		        $DOB = $row["DOB"];
		        $salary = $row["salary"];
		        $branchNo = $row["branchNo"];

		        if ($sex =="F")      
		        	$color="red";
		        else
		        	$color="blue";

		        echo "<TR>
		        		<TD>$Staffno</TD>
		        		<TD>$fname</TD>
		        		<TD>$lname</TD>
		        		<TD>$position</TD>
		        		<TD> <font color='$color'> $sex </font></TD>
		        		<TD>$DOB</TD>
		        		<TD>$salary</TD>
		        		<TD>$branchNo</TD>
		        	  </TR>\n";
		    }
		    echo "</TABLE>\n";
		    mysqli_free_result($result);
		}
		else
			echo "<br>No record found\n";
	}
	else {
	  echo "Something is wrong with SQL:" . mysqli_error($con);	
	}

	mysqli_close($con);
?>
