<?php
include 'mysql-connect.php';

$user = $_POST["user"];
$token = $_POST["token"];

$encryptedToken = encryptString($token, $secretHBKey);

if ($conn_mysq){
	$sql = "update hubspot.tbl_users set utoken='$encryptedToken' where uname='$user'";
	$result = mysqli_query($conn_mysq, $sql);

	if ($result){
		$response = ['status'=>200, 'msg'=>'Hubspot Token Updated!!'];
	}else{
		$response = ['status'=>404, 'msg'=>'Snowflake User Not Exist in Database. Please Test Snowflake Connection First!!'];
	}
}
else{
	$response = ['status'=>404, 'msg'=>'No Database Connection!!'];
}
echo json_encode($response);
?>