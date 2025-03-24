<?php
$secretHBKey = "Hubspot_Token";

$servername = "localhost";
$username = "root";
$password = "rootpassword";

// Create connection
$conn_mysq = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn_mysq) {
  die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";

function encryptString($string, $key) {
    $iv = substr(hash('sha256', 'some_iv_key', true), 0, 16);
    return base64_encode(openssl_encrypt($string, 'AES-256-CBC', hash('sha256', $key, true), 0, $iv));
}

function decryptString($encryptedString, $key) {
    $iv = substr(hash('sha256', 'some_iv_key', true), 0, 16);
    return openssl_decrypt(base64_decode($encryptedString), 'AES-256-CBC', hash('sha256', $key, true), 0, $iv);
}

function array_keys_to_lower($array) {
    return array_map(function ($item) {
        return is_array($item) ? array_keys_to_lower($item) : $item;
    }, array_change_key_case($array, CASE_LOWER));
}

?>

