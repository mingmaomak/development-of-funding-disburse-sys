<?php
$servername = "localhost";
$username = "root";
$password = "TffXFPDcvRxpFnft";
$dbname = "myDB";

$array_from_my_data = [
  //  "foo" => "bar",
  //  "bar" => "foo",
  "username" => "6110110391",
  "first_name" => "WORRAMAIT",
  "last_name" => "KOSITPAIBOON",
  "staff_id" => "6110110391",
  "email" => "mingmaomak@gmail.com",
  "campus_id" => "01",
  "fac_id" => "06",
  "dept_id"=> "034",
  "pos_id"=> "06",
];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql_create_table = "CREATE TABLE MyGuests (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(100) NOT NULL,
first_name VARCHAR(100) NOT NULL,
last_name VARCHAR(100) NOT NULL,
staff_id VARCHAR(100),
email VARCHAR(100),
campus_id VARCHAR(100),
fac_id VARCHAR(100),
dept_id VARCHAR(100),
pos_id VARCHAR(100),
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql_create_table) === TRUE) {
  echo "Table MyGuests created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}


$sql_insert = "INSERT INTO MyGuests (username, first_name, last_name, email)
VALUES ('15915198', 'John', 'Doe', 'john@example.com')";

if ($conn->query($sql_insert) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
//$conn->close();
?>