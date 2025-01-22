<HTML>
	<BODY>
		<a href="logout.php">User logout</a><br>

<?php
	if(isset($_COOKIE['username'])) {

		echo '<font size="4">
				<br><b>Add Transaction</b>
			  </font>';

		session_start();
		$Balance=0;
		$user=$_SESSION['userN'];
		include "dbconfig.php";
		$con = mysqli_connect($host, $username, $password, $dbname) or die("<br>Cannot connect to DB:$dbname on $host, error: " . mysqli_connect_error());
		$user_name = $_COOKIE['username'];

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
		
	    if ($Balance>0) echo "<br> <b>$user_name</b> current balance is <font color='blue'><b>$$Balance</b></font>.\n";
	    else echo "<br> <b>$user_name</b> current balance is <font color='red'><b>$$Balance</b></font>.";

		mysqli_free_result($resultDeposited);
		mysqli_free_result($resultWithdraw);
	?>

	<HTML>
		<form name="input" action="insert_transaction.php" method="post" required="required">
			<input type="hidden" name="customer_name" value="$user_name">
			Transaction code: <input type="text" name="code" required="required">
			<br>
			<input type="radio" name="type" value="D">Deposit
			<input type="radio" name="type" value="W">Withdraw
			<br> Amount: <input type="text" name="amount" required="required">
			<br> Select a Source: 
			<select name="source_id">
				<option value=""></option>
	<?php
		$con2 = mysqli_connect($host, $username, $password, $dbname) or die("<br>Cannot connect to DB:$dbname on $host, error: " . mysqli_connect_error());
		$sqlSources = "SELECT * FROM dreamhome.Sources";
		$resultSources = mysqli_query($con2, $sqlSources);
		$numRows = mysqli_num_rows($resultSources);
		$SourceName = array('0');

		while ($row = mysqli_fetch_array($resultSources)) { 
			$SourceName[] = $row['name'];
		}
		for($id=1; $id<=$numRows; $id++) {
			echo "<option value='$id'>$SourceName[$id]</option>";
		}
		mysqli_free_result($resultSources);
		mysqli_close($con2);
	?>
	<HTML>
			</select>
			<br>Note: <input type="text" name="note">
			<br>
			<input type="submit" value="Submit">
		</form>
	</HTML>
<?php
} else die("<br>Please login first");
?>