<!DOCTYPE html>
<html>
<body>

<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$port = 3666;
$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $port);

if($mysqli→connect_errno ) {
    printf("Connect failed: %s<br />", $mysqli→connect_error);
    exit();
}
printf('Connected successfully.<br />');
$mysqli→close();

// echo('random number between 1 and 100:'.rand(10, 100));
// echo('<br>Path is /var/www/html');
?>

</body>
</html>