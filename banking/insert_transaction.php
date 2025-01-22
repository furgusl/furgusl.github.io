<HTML>
	<BODY>
	<a href="logout.php">User logout</a><br>
	</BODY>
</HTML>

<?php
  if(isset($_COOKIE['username'])) {
  	include "dbconfig.php";
    session_start();
    $user=$_SESSION['userN'];
    $cid = $_COOKIE['userid'];
    $con = mysqli_connect($host, $username, $password, $dbname) or die("<br>Cannot connect to DB:$dbname on $host, error: " . mysqli_connect_error());
    
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

  	# code
      if(isset($_POST['code'])) 
     		$code= $_POST['code'];
      else die("<br>Please enter a code"); 

      # check if code exits 
      $sql= "SELECT *  FROM CPS3740_2022F.Money_furgusl where code='$code'";
     	$sqlCodeCheck = mysqli_query($con, $sql); 

     	if ($sqlCodeCheck) {
    		if (mysqli_num_rows($sqlCodeCheck)>0)
    			die("<br>This code already exists, please use a new code.");
  	}
  	else 
    		echo "Something is wrong with SQL:" . mysqli_error($con);	
  	mysqli_free_result($sqlCodeCheck);

     # type (W/D)
     if(isset($_POST['type'])) 
     		$type= $_POST['type'];
     else die("<br>Please select a type");
  	
  	# amount
     if(isset($_POST['amount'])) {
     		if ($_POST['amount']<=0) 
     			die("<br>Please enter a postive amount"); 
     		else
     			$amount= $_POST['amount'];
     }
     else die("<br>Please enter an amount");

     # source
     if(isset($_POST['source_id']))
      	if($_POST['source_id']=="")
      		die("<br>Pealse enter a source");
     	 	else 
     	 		$sid = $_POST['source_id'];
     	else die("<br>Pealse enter a source");

     if ($_POST['type']=='W' && $_POST['amount']>$Balance) 
  		die("<br>Not amount money in balance to withdraw");

  	# note
     	if(isset($_POST['note'])) 
          $note= $_POST['note'];

    $sql="INSERT INTO CPS3740_2022F.Money_furgusl(code, cid, sid, type, amount, mydatetime, note) VALUES('$code', $cid, $sid , '$type', $amount, NOW() , '$note')";
  	$result = mysqli_query($con, $sql);

    # update balance
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
      } else {
        echo "<br> Something is wrong with SQL:". mysqli_error($con);  
        mysqli_close($con);
      } 
    
    $Balance = $deposited-$withdraw;
    mysqli_free_result($resultDeposited);
    mysqli_free_result($resultWithdraw);

   	echo "<br>Transcation Successfully\n";
    if ($Balance<0) echo "<br>New balance: <font color='red'>$$Balance</font></br>\n";
    else  echo "<br>New balance: <font color='blue'>$$Balance</font></br>\n";

  	mysqli_close($con);
  } else die("<br>Please login first"); 
?>