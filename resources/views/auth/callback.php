<?php
require('config.php');
$code = $_REQUEST['code'];
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $oauth_token_url);

curl_setopt($ch, CURLOPT_POST, TRUE);



/** Authorize Code */

curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

curl_setopt($ch, CURLOPT_POSTFIELDS, array(
'code' => $code,
'client_id' => $client_id,
'client_secret' => $client_secret,
'redirect_uri' => $redirect_uri,
'grant_type' => 'authorization_code'
));

$data = curl_exec($ch);
$access_token=json_decode($data)->access_token;
/** Get User Information */
$authorization = "Authorization: Bearer ".$access_token;
curl_setopt($ch, CURLOPT_URL, $userinfo_endpoint_url);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$userinfo= curl_exec($ch);
curl_close($ch);
print '<div align="center"><h2>User Information</h2>';
echo "<pre>".$userinfo."<pre/>";
$userinfo_json = json_decode($userinfo);
$userinfo_json_pretty = json_encode($userinfo_json, JSON_PRETTY_PRINT);
print '</div>';
echo "<pre>".$userinfo_json_pretty."<pre/>";

$servername = "localhost";
$username = "root";
$password = "TffXFPDcvRxpFnft";
$dbname = "myDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
else {
    echo('connection successful <br>');
}

// id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// username VARCHAR(100) NOT NULL,
// first_name VARCHAR(100) NOT NULL,
// last_name VARCHAR(100) NOT NULL,
// staff_id VARCHAR(100),
// email VARCHAR(100),
// campus_id VARCHAR(100),
// fac_id VARCHAR(100),
// dept_id VARCHAR(100),
// pos_id VARCHAR(100),
// reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

$sql_insert = "INSERT INTO MyGuests (username, first_name, last_name, staff_id, email, campus_id, fac_id, dept_id, pos_id)
VALUES ('".$userinfo_json->username."', '".$userinfo_json->first_name."','".$userinfo_json->last_name."','".$userinfo_json->staff_id."','".$userinfo_json->email."','".$userinfo_json->campus_id."','".$userinfo_json->fac_id."','".$userinfo_json->dept_id."','".$userinfo_json->pos_id."')";

if ($conn->query($sql_insert) === TRUE) {
    echo "New record created in MyGuests table successfully";
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}