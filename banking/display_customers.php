<?php
	include "dbconfig.php";

	$con = mysqli_connect($host, $username, $password, $dbname)
      or die("<br>Cannot connect to DB:$dbname on $host, error: " . mysqli_connect_error());

	$sql="select * from dreamhome.customers2"; 
	$result = mysqli_query($con, $sql); 
	 #SELECT p.cid, p.category_name as category, c.category_name as parent, p.status 
	 #	FROM categories p LEFT JOIN categories c ON p.parent_cat=c.cid 
	echo "The following customers are in the bank system:\n";
	 
	if ($result) {
		if (mysqli_num_rows($result)>0) {
			echo "<TABLE border=1>\n";
			echo "<TR>
					<TH>ID</TH>
					<TH>login</TH>
					<TH>password</TH>
					<TH>Name</TH>
					<TH>Gender</TH>
					<TH>DOB</TH>
					<TH>street</TH>
					<TH>city</TH>
					<TH>state</TH>
					<TH>zipcode</TH>
				   </TR>";
		    while($row = mysqli_fetch_array($result)){
		        $id = $row["id"];
		        $name = $row["name"];
		        $login = $row["login"];
		        $password = $row["password"];
		        $DOB = $row["DOB"];
		        $gender = $row["gender"];
		        $street = $row["street"];
		        $city = $row["city"];
		        $state = $row["state"];
		        $zipcode = $row["zipcode"];

		        echo "<TR>
		        		<TD>$id</TD>
		        		<TD>$login</TD>
		        		<TD>$password</TD>
		        		<TD>$name</TD>
		        		<TD>$gender</TD>
		        		<TD>$DOB</TD>
		        		<TD>$street</TD>
		        		<TD>$city</TD>
		        		<TD>$state</TD>
		        		<TD>$zipcode</TD>
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
