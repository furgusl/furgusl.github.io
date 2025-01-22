<HTML>
	<BODY>
	<a href="logout.php">User logout</a>
	</BODY>
</HTML>

<?php
   session_start();
   include "dbconfig.php";
   $user_log=" ";
   $con = mysqli_connect($host, $username, $password, $dbname)
      		or die("<br>Cannot connect to DB:$dbname on $host, error: " . mysqli_connect_error());

   if(isset($_POST['username']))
		$login= $_POST["username"];
	else
		die("<br>please enter username first!");
   if(isset($_POST['password']))
		$bpassword= $_POST["password"];
	else
		die("<br>please enter password first!");

   $sql= "SELECT * FROM dreamhome.customers2 WHERE login='$login'";
   $result = mysqli_query($con, $sql); 
   $row = mysqli_fetch_array($result);
   $num = mysqli_num_rows($result);

   #user broswer & OS
   $browser = $_SERVER['HTTP_USER_AGENT'];
   echo "<br> Your browser and OS: $browser\n";

   # User IP
   $ip = $_SERVER['REMOTE_ADDR'];
   echo "<br> Your IP: $ip\n";
   $IPV4 = explode(".", $ip);
   if($IPV4[0]== '10')
   	echo "<br> You are from Kean University wifi domain.\n";
   else 
   	echo "<br> You are NOT from Kean domain.\n";

   #user login
    if ($num==0) 
		echo "<br> Login $login doesn’t exist in the database\n";
	else if ($num > 0) {
		$user_password = $row['password'];
		$user_log = $row['login'];
		$customerName = $row['name'];
		$userID = $row['id'];

		if($user_log==$login) {
			if($user_password==$bpassword) {
				echo "<br> Welcome Customer: <b>$customerName</b>\n";
				setcookie('username', $customerName, time()+600);
				setcookie('userid', $userID, time()+600);
				$_SESSION['userN']= $user_log;
				#$cookie2=$_COOKIE['userid']; #this is wrong, cookie is empty, doot do this
				
				# user age
				$DOB = $row['DOB'];
				$today = date("Y-m-d");
				$age = date_diff(date_create($DOB), date_create($today))->format('%y');
				echo "<br>Age is: $age\n";

				# user address
				$street = $row['street'];
				$city = $row['city'];
				$zipcode = $row['zipcode'];
				echo "<br> Address: $street, $city, $zipcode\n";

				# user image
				$img= $row['img'];
				echo "<br><img src='data:image/jpeg;base64," . base64_encode($img) ."'/>\n";

				mysqli_free_result($result);

				# transaction table
				$sql="SELECT m.mid as id, m.code as code, m.type, m.amount as amount, s.name as source, m.mydatetime, m.note 
						FROM CPS3740_2022F.Money_furgusl m, dreamhome.Sources s, dreamhome.Customers2 c
						where m.cid=c.id and m.sid=s.id and m.cid=(select id from dreamhome.Customers2 where login='$user_log')
						order by m.mid";
				$result = mysqli_query($con, $sql); 
				$numRows = mysqli_num_rows($result);
				
				# balance 
				$sqlDeposited= "SELECT sum(amount) as deposited FROM CPS3740_2022F.Money_furgusl m, dreamhome.Sources s, dreamhome.Customers2 c where m.cid=c.id and m.sid=s.id and m.cid=(select id from dreamhome.Customers2 where login='$user_log') and type='D'";
				$sqlWithdraw= "SELECT sum(amount) as withdraw FROM CPS3740_2022F.Money_furgusl m, dreamhome.Sources s, dreamhome.Customers2 c where m.cid=c.id and m.sid=s.id and m.cid=(select id from dreamhome.Customers2 where login='$user_log') and type='W'";
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

				echo "<hr>There are <b>$numRows</b> transcations for customer <b>$customerName</b>:\n";
				 
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
					else echo "<br>No record found\n";
				}
				else echo "Something is wrong with SQL:" . mysqli_error($con);	
?>
						<HTML>
							<table border='0'>
						   		 <tbody>
						   		 	<br>
									<TR>
										<TD>
											<form action="add_transaction.php" method="post">
												<input type="hidden" name="customer_name"  value="$user_name">
												<input type="submit" value="Add transaction">
											</form>
										</TD>
										<TD>
											<a href="display_transaction.php">Display and update transaction</a>
											<a href="display_stores.php">Display stores</a>
										</TD>
									</TR>
									
									<tr>
										<td>
											<form action="search.php" method="get">
											Keyword: 
												<input type="text" name="keywords"  required="required">
												<input type="submit" value="Search transaction">
											</form>
										</td>
									</tr>
								</tbody>
							</table>
						</HTML>
<?php

			} else echo "<br> login $login exits, but password not matches.\n";

		} else echo "<br> Login $login doesn’t exist in the database\n";
			
	} else echo "<br> Something is wrong with SQL:". mysqli_error($con);	
	mysqli_close($con);
?>