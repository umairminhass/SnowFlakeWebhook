<?php
include 'mysql-connect.php';

$dsn = "SnowflakeDSN"; // ODBC Data Source Name from odbc.ini
$user = $_POST["user"];
$password = $_POST["pswd"];
$uid='';
// Connect to Snowflake
$conn = odbc_connect($dsn, $user, $password);
if (!$conn) {
	echo "Incorrrect snowflake username/password";
}
else
{
	if ($conn_mysq){
		$upass = md5($password);
		$sql = "SELECT uid FROM hubspot.tbl_users where uname='$user' AND upass='$upass'";
		$result = mysqli_query($conn_mysq, $sql);

		if (mysqli_num_rows($result) > 0) {
		  // output data of each row
		  $row = mysqli_fetch_row($result);
		  $uid = $row[0];
		}else{
			$sql = "INSERT INTO  hubspot.tbl_users(uname, upass) VALUES('$user', '$upass' )";
			mysqli_query($conn_mysq, $sql);
		}
	} 
	$response = ['status'=>200, 'msg'=>'Connection Successful!!'];
	$_SESSION['uid']= $uid;
	$_SESSION['user']= $user;
	$_SESSION['pswd']=$password;
	//$_SESSION['token']=$token;
	echo json_encode($response);
}

?>