<HTML>
	<BODY>
		<a href="logout.php">User logout</a><br>

<?php
	if(isset($_COOKIE['username'])) {
		session_start();
		# check if cookie us set
		$i=0;
		$user=$_SESSION['userN'];
		echo "<br>You can only update the <b>Note</b> column.\n";

		# transaction table
		include "dbconfig.php";
	    $con = mysqli_connect($host, $username, $password, $dbname)
	  		or die("<br>Cannot connect to DB:$dbname on $host, error: " . mysqli_connect_error());
		
		$sql="SELECT m.mid as id, m.code as code, m.type, m.amount as amount, s.name as source, m.mydatetime, m.note 
				FROM CPS3740_2022F.Money_furgusl m, dreamhome.Sources s, dreamhome.Customers2 c
				where m.cid=c.id and m.sid=s.id and m.cid=(select id from dreamhome.Customers2 where login='$user')
				order by m.mid";
		$result = mysqli_query($con, $sql); 
		$numRows = mysqli_num_rows($result); 
		
		# balance 
		$sqlDeposited= "SELECT sum(amount) as deposited FROM CPS3740_2022F.Money_furgusl m, dreamhome.Sources s, dreamhome.Customers2 c where m.cid=c.id and m.sid=s.id and m.cid=(select id from dreamhome.Customers2 where login='$user') and type='D'";
		$sqlWithdraw= "SELECT sum(amount) as withdraw FROM CPS3740_2022F.Money_furgusl m, dreamhome.Sources s, dreamhome.Customers2 c where m.cid=c.id and m.sid=s.id and m.cid=(select id from dreamhome.Customers2 where login='$user') and type='W'";
		$resultDeposited = mysqli_query($con, $sqlDeposited); 
		$resultWithdraw = mysqli_query($con, $sqlWithdraw); 
		$numRowsDeposited = mysqli_num_rows($resultDeposited);
		$numRowsWithdraw = mysqli_num_rows($resultWithdraw);

		if ($resultDeposited) {
		   if ($numRowsDeposited>0) {
			    while($row = mysqli_fetch_array($resultDeposited)) {
		          $deposited = $row["deposited"];
		          if($deposited=='') $deposited='0';
		        }
		    } else $deposited='0';
		  } 
		  else {
		    echo "<br> Something is wrong with SQL:". mysqli_error($con);  
		    mysqli_close($con);
		  } 

		  if ($resultWithdraw) {
		    if ($numRowsWithdraw>0) {
		       while($row = mysqli_fetch_array($resultWithdraw)) {
		          $withdraw = $row["withdraw"];
		          if($withdraw=='') $withdraw='0';
		        }
		    } else $withdraw='0';
		  } 
		  else {
		    echo "<br> Something is wrong with SQL:". mysqli_error($con);  
		    mysqli_close($con);
		  } 
		$Balance = $deposited-$withdraw;
	  	mysqli_free_result($resultDeposited);
	 	mysqli_free_result($resultWithdraw);
		 
		if ($result) {
			if ($numRows>0) {			

				echo '<form action="update_transaction.php" method="post">';

				echo "<TABLE border=1>\n";
				echo "<TR>
						<TH>id</TH>
						<TH>Code</TH>
						<TH>Type</TH>
						<TH>Amount</TH>
						<TH>Source</TH>
						<TH>Date Time</TH>
						<TH>Note</TH>
						<TH>Delete</TH>
					   </TR>";
				
			    while($row = mysqli_fetch_array($result)) {
					$Type = $row['type'];

					if ($Type =="W") {    
		        		$Type="Withdraw";
		        		$color="red";
		        	}
		        	else {
		        		$Type="Deposit";
		        		$color="blue";
		        	}

		        	if($color=='red') {
					    echo "<TR>";
			        	echo "<td><input type='hidden' name='mid[$i]' value='".$row['id']."'>" . $row['id'] . "</td>";
			        	echo "<td><input type='hidden' name='code[$i]' value='".$row['code']."'>" . $row['code'] . "</td>";
			        	echo "<td><input type='hidden' name='type[$i]' value='".$row['type']."'>" . $row['type'] . "</td>";
			        	echo "<td><font color='$color'><input type='hidden' name='amount[$i]' value='".$row['amount']."'>-" . $row['amount'] . "</td>";
			        	echo "<td><input type='hidden' name='source[$i]' value='".$row['source']."'>" . $row['source'] . "</td>";
			        	echo "<td><input type='hidden' name='mydatetime[$i]' value='".$row['mydatetime']."'>" . $row['mydatetime'] . "</td>";
			        	echo "<td><input type='text'style=background-color:yellow; name='note[$i]' value='".$row['note']."'></td>";
			      		echo "<input type='hidden' name='noteCode[$i]' value='".$row['code']."'>";
			        	echo "<td><input type='checkbox' name='delete[$i]' value='".$row['code']."'></td>";
		        		echo "</TR>";  
		        	} else {
		        		echo "<TR>";
			        	echo "<td><input type='hidden' name='mid[$i]' value='".$row['id']."'>" . $row['id'] . "</td>";
			        	echo "<td><input type='hidden' name='code[$i]' value='".$row['code']."'>" . $row['code'] . "</td>";
			        	echo "<td><input type='hidden' name='type[$i]' value='".$row['type']."'>" . $row['type'] . "</td>";
			        	echo "<td><font color='$color'><input type='hidden' name='amount[$i]' value='".$row['amount']."'>" . $row['amount'] . "</td>";
			        	echo "<td><input type='hidden' name='source[$i]' value='".$row['source']."'>" . $row['source'] . "</td>";
			        	echo "<td><input type='hidden' name='mydatetime[$i]' value='".$row['mydatetime']."'>" . $row['mydatetime'] . "</td>";
			        	echo "<td><input type='text'style=background-color:yellow; name='note[$i]' value='".$row['note']."'></td>";
			      		echo "<input type='hidden' name='noteCode[$i]' value='".$row['code']."'>";
			        	echo "<td><input type='checkbox' name='delete[$i]' value='".$row['code']."'></td>";
        				echo "</TR>";  
		        	}
		        	$i+=1; 
			    }
			    echo "</TABLE>\n";

		    	if ($Balance<0) echo "<br>Total balance: <font color='red'>$Balance</font></br>\n";
				else echo "<br>Total balance: <font color='blue'>$Balance</font></br>\n";

				mysqli_free_result($result);
?>
				<input type="submit" value="Update transaction">
			</form>
		</BODY>
	</HTML>
<?php	
			}
			else echo "<br>No record found.\n";   
		}
		else echo "Something is wrong with SQL:" . mysqli_error($con);	
		mysqli_close($con);
	} else die("<br>Please login first");	
?>