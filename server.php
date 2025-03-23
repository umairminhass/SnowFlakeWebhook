<?php
include 'mysql-connect.php';


$dsn = "SnowflakeDSN"; // ODBC Data Source Name from odbc.ini
$user = $_POST["user"];
$password = $_POST["pswd"];
$sql = $_POST["query"];
$qType = $_POST["qType"];
$utoken='';
// Connect to Snowflake
$conn = odbc_connect($dsn, $user, $password);
if (!$conn) {
    echo "Incorrect Snowflake username/password/ Please Verify!!!";
}

// Execute a query
//$sql = "SELECT * FROM CUSTOMER LIMIT 10";
$result = odbc_exec($conn, $sql);

// Fetch data
$rows = [];
while ($row = odbc_fetch_array($result)) {
	$rows[] = $row;
}

if($qType ==  "publish"){
	$api_url = "https://api.hubapi.com/crm/v3/objects/contacts/batch/create";
	if ($conn_mysq){
		$sql = "SELECT utoken FROM hubspot.tbl_users where uname='$user'";
		$result = mysqli_query($conn_mysq, $sql);
		if (mysqli_num_rows($result) > 0) {
		  // output data of each row
		  $row = mysqli_fetch_row($result);
		  $utoken = $row[0];
		  if($utoken != ''){
			  $utoken = decryptString($row[0], $secretHBKey);
			  // HubSpot Private App Access Token
				$access_token = $utoken; // Replace with your actual token

				// Dummy data for multiple contacts
				$contacts = $rows;
				
				$contacts = array_keys_to_lower($contacts);
				
				// Prepare batch data format
				$batch_data = ["inputs" => []];

				foreach ($contacts as $contact) {
					$batch_data["inputs"][] = ["properties" => $contact];
				}

				// Convert data to JSON
				$json_data = json_encode($batch_data);
				
				// Initialize cURL
				$ch = curl_init($api_url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_HTTPHEADER, [
					"Content-Type: application/json",
					"Authorization: Bearer " . $access_token
				]);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

				// Execute request
				$response = curl_exec($ch);
				$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				curl_close($ch);

				// Handle response
				if ($http_code == 200 || $http_code == 201) {
					echo "All contacts inserted successfully!";
				} else {
					echo "Error: " . $response;
				}
		  }else{
			  echo "Update Hubspot Access Token Before Publishing the Data!!";
		  }		 
		}else{
			echo 'Snowflake user doesnot exist. Please Create Connection first';
		}
	}else{
			echo 'No Database Connection!!';
	} 
}
else{
	$json_data = json_encode($rows);

	echo $json_data;
}

// Close connection
odbc_close($conn);

?>