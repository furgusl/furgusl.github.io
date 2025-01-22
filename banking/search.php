<HTML>
	<BODY>
	<a href="logout.php">User logout</a>
	</BODY>
</HTML>

<?php
	if(isset($_COOKIE['username'])) {
		session_start();
		$user=$_SESSION['userN'];
	   	include "dbconfig.php";
	   $con = mysqli_connect($host, $username, $password, $dbname) or die("<br>Cannot connect to DB:$dbname on $host, error: " . mysqli_connect_error());

	    if(isset($_GET['keywords'])) 
	    	$keywords= $_GET["keywords"];

	    if($keywords=='*') {
	    	$sql="SELECT m.mid as id, m.code as code, m.type, m.amount as amount, s.name as source, m.mydatetime, m.note 
				FROM CPS3740_2022F.Money_furgusl m, CPS3740.Sources s, CPS3740.Customers c
				where m.cid=c.id and m.sid=s.id and m.cid=(select id from CPS3740.Customers where login='$user')
				order by m.mid";
	    } 
	    else { 
		    $sql="SELECT m.mid as id, m.code as code, m.type, m.amount as amount, s.name as source, m.mydatetime, m.note 
					FROM CPS3740_2022F.Money_furgusl m, CPS3740.Sources s, CPS3740.Customers c
					where m.cid=c.id and m.sid=s.id and m.cid=(select id from CPS3740.Customers where login='$user') and note LIKE'%$keywords%'
					order by m.mid";
		}
		$result = mysqli_query($con, $sql); 
		$numRows = mysqli_num_rows($result);

		# balance 
		$sqlDeposited= "SELECT sum(amount) as deposited FROM CPS3740_2022F.Money_furgusl m, CPS3740.Sources s, CPS3740.Customers c where m.cid=c.id and m.sid=s.id and m.cid=(select id from CPS3740.Customers where login='$user') and type='D'";
		$sqlWithdraw= "SELECT sum(amount) as withdraw FROM CPS3740_2022F.Money_furgusl m, CPS3740.Sources s, CPS3740.Customers c where m.cid=c.id and m.sid=s.id and m.cid=(select id from CPS3740.Customers where login='$user') and type='W'";
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

		$user_name = $_COOKIE['username'];
		echo "<br>The transcations in customer <b>$user_name</b> records matched keyword $keywords are:</br>\n";

		# table 
		if ($result) {
			if ($numRows>0) {
				echo "<TABLE border=1>\n";
				echo "<TR>
						<TH>id</TH>
						<TH>Code</TH>
						<TH>Type</TH>
						<TH>Amount</TH>
						<TH>Source</TH>
						<TH>Date Time</TH>
						<TH>Note</TH>
					   </TR>";
			    while($row = mysqli_fetch_array($result)) {
			        $ID = $row["id"];
			        $Code = $row["code"];
			        $Type = $row["type"];
			        $Amount = $row["amount"];
			        $Source = $row["source"];
			        $DateTime = $row["mydatetime"];
			        $Note = $row["note"];

			       	if ($Type =="W")  {    
		        		$Type="Withdraw";
		        		$color="red";
		        	}
		        	else {
		        		$Type="Deposit";
		        		$color="blue";
		        	}
		        	if($color=='red') {
		        		echo "<TR>
			        		<TD>$ID</TD>
			        		<TD>$Code</TD>
			        		<TD>$Type</TD>
			        		<TD><font color='$color'>-$Amount</font></TD>
			        		<TD>$Source</TD>
			        		<TD>$DateTime</TD>
			        		<TD>$Note</TD>
			        	  </TR>\n";
		        	}else {
		        		echo "<TR>
			        		<TD>$ID</TD>
			        		<TD>$Code</TD>
			        		<TD>$Type</TD>
			        		<TD><font color='$color'>$Amount</font></TD>
			        		<TD>$Source</TD>
			        		<TD>$DateTime</TD>
			        		<TD>$Note</TD>
			        	  </TR>\n";
		        	}
		        }
			    echo "</TABLE>\n";
			    
			    if ($Balance<0) echo "<br>Total balance: <font color='red'>$Balance</font></br>\n";
				else echo "<br>Total balance: <font color='blue'>$Balance</font></br>\n";

			    mysqli_free_result($result);
			}
			else echo "<br>No record found with the search keyword: $keywords.\n";
		}
		else echo "Something is wrong with SQL:" . mysqli_error($con);	
		
		mysqli_close($con);
	} else die("<br>Please login first");	
?>