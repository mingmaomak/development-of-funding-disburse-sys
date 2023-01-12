<?php
//! require('./config.php');
//! require ('/oauthconfig.blade.php');

use Brick\Math\Exception\MathException;
use Mockery\Undefined;

include(app_path().'/oauthconfig.php');

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

$userinfo = '';
$data = curl_exec($ch);


try {
  $access_token=json_decode($data)->access_token;
  /** Get User Information */
  $authorization = "Authorization: Bearer ".$access_token;
  curl_setopt($ch, CURLOPT_URL, $userinfo_endpoint_url);
  curl_setopt($ch, CURLOPT_POST, TRUE);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS,$_POST);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  $userinfo= curl_exec($ch);
  curl_close($ch);

  // Changing from keeping the user info inside file to inside cookies
  // $userinfo_text_file = fopen("userinfo.txt", "w") or die("Unable to open file to write!");
  // fwrite($userinfo_text_file, $userinfo);

  // VALUES ('".$user_object->username."', '".$user_object->first_name."','".$user_object->last_name."','".$user_object->staff_id."','".$user_object->email."','".$user_object->campus_id."','".$user_object->fac_id."','".$user_object->dept_id."','".$user_object->pos_id."')";
  $user_object = json_decode($userinfo);

  $cookie_name = "psu_funding_disburse_username";
  $cookie_value = $user_object->username;
  setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

  $cookie_name = "psu_funding_disburse_first_name";
  $cookie_value = $user_object->first_name;
  setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

  $cookie_name = "psu_funding_disburse_last_name";
  $cookie_value = $user_object->last_name;
  setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

  $cookie_name = "psu_funding_disburse_staff_id";
  $cookie_value = $user_object->staff_id;
  setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

  $cookie_name = "psu_funding_disburse_email";
  $cookie_value = $user_object->email;
  setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

  $cookie_name = "psu_funding_disburse_campus_id";
  $cookie_value = $user_object->campus_id;
  setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

  $cookie_name = "psu_funding_disburse_fac_id";
  $cookie_value = $user_object->fac_id;
  setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

  $cookie_name = "psu_funding_disburse_dept_id";
  $cookie_value = $user_object->dept_id;
  setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

  $cookie_name = "psu_funding_disburse_pos_id";
  $cookie_value = $user_object->pos_id;
  setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
  
} catch (Exception $ex) {
  echo "<script>console.log(\"PHP exception: \" + \"".$ex."\" );</script>";
    
    // Changing from reading the user info from file to from cookies
    // $user_object = json_decode($userinfo);
    // $userinfo_text_file = fopen("userinfo.txt", "r") or die("Unable to open file to read!");
    // $userinfo= fread($userinfo_text_file,filesize("userinfo.txt"));
    // fclose($userinfo_text_file);
    
  $cookie_name = "psu_funding_disburse_username";
  if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named '" . $cookie_name . "' is not set!";
  } else {
    echo "Cookie '" . $cookie_name . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$cookie_name] . "<br>";
  }

  $cookie_name = "psu_funding_disburse_first_name";
  if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named '" . $cookie_name . "' is not set!";
  } else {
    echo "Cookie '" . $cookie_name . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$cookie_name] . "<br>";
  }

  $cookie_name = "psu_funding_disburse_last_name";
  if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named '" . $cookie_name . "' is not set!";
  } else {
    echo "Cookie '" . $cookie_name . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$cookie_name] . "<br>";
  }

  $cookie_name = "psu_funding_disburse_staff_id";
  if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named '" . $cookie_name . "' is not set!";
  } else {
    echo "Cookie '" . $cookie_name . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$cookie_name] . "<br>";
  }

  $cookie_name = "psu_funding_disburse_email";
  if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named '" . $cookie_name . "' is not set!";
  } else {
    echo "Cookie '" . $cookie_name . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$cookie_name] . "<br>";
  }

  $cookie_name = "psu_funding_disburse_campus_id";
  if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named '" . $cookie_name . "' is not set!";
  } else {
    echo "Cookie '" . $cookie_name . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$cookie_name] . "<br>";
  }

  $cookie_name = "psu_funding_disburse_fac_id";
  if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named '" . $cookie_name . "' is not set!";
  } else {
    echo "Cookie '" . $cookie_name . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$cookie_name] . "<br>";
  }

  $cookie_name = "psu_funding_disburse_dept_id";
  if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named '" . $cookie_name . "' is not set!";
  } else {
    echo "Cookie '" . $cookie_name . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$cookie_name] . "<br>";
  }

  $cookie_name = "psu_funding_disburse_pos_id";
  if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named '" . $cookie_name . "' is not set!";
  } else {
    echo "Cookie '" . $cookie_name . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$cookie_name] . "<br>";
  }

}

// echo '<div style="background-color:Navy; color:white;" align="center">';
// echo '<pre>'.$userinfo.'</pre>';
// echo '</div>';
// {"username":"6110110391","first_name":"WORRAMAIT","last_name":"KOSITPAIBOON","staff_id":"6110110391","email":"mingmaomak@gmail.com","campus_id":"01","fac_id":"06","dept_id":"034","pos_id":"06"}


// $userinfo_pretty = json_encode($user_object, JSON_PRETTY_PRINT);
// echo '<div style="background-color:Maroon; color:white;" align="center">';
// echo '<pre>'.$userinfo_pretty.'</pre>';
// echo '</div>';
// {
//   "username": "6110110391",
//   "first_name": "WORRAMAIT",
//   "last_name": "KOSITPAIBOON",
//   "staff_id": "6110110391",
//   "email": "mingmaomak@gmail.com",
//   "campus_id": "01",
//   "fac_id": "06",
//   "dept_id": "034",
//   "pos_id": "06"
// }

echo '<h1>ระบบเบิกจ่ายเงินรายวิชาโครงงาน คณะวิศวกรรมศาสตร์ มหาวิทยาลัยสงขลานครินทร์</h1>';

// echo '<h2>current user: '.$user_object->first_name.' '.$user_object->last_name.'</h2>';

// $servername = "localhost";
// $username = "amongus";
// $password = "superpassword";
// $dbname = "myDB";

// Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);
// // Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }
// else {
//     echo('connection successful <br>');
// }

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

// $sql_insert = "INSERT INTO MyGuests (username, first_name, last_name, staff_id, email, campus_id, fac_id, dept_id, pos_id)
// VALUES ('".$user_object->username."', '".$user_object->first_name."','".$user_object->last_name."','".$user_object->staff_id."','".$user_object->email."','".$user_object->campus_id."','".$user_object->fac_id."','".$user_object->dept_id."','".$user_object->pos_id."')";

// if ($conn->query($sql_insert) === TRUE) {
//     echo "New record created in MyGuests table successfully";
// } else {
// echo "Error: " . $sql . "<br>" . $conn->error;
// }

?>
<a href="{{ url('/upload-file') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">upload file</a>