<!DOCTYPE html>
<html>
<body>

<?php
$transcendental_number = array("π", "e", "Cahen's constant");
echo "I like " . $transcendental_number[0] . ", " . $transcendental_number[1] . " and " . $transcendental_number[2] . ".";
echo('<br> ');
echo('random number between 1 and 5: '.rand(1, 5));
echo('<br>Path is /var/www/html<br>');
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
var_dump($array_from_my_data);
echo('<br>안녕 สวัสดี 你好');
echo('<br>$array_from_my_data: '.$array_from_my_data);
echo('<br>current time is   ');

?>
<div id="clock">8:10:45</div>
 
 <script>
     setInterval(showTime, 1000);
     function showTime() {
         let time = new Date();
         let hour = time.getHours();
         let min = time.getMinutes();
         let sec = time.getSeconds();
         am_pm = "AM";
 
         if (hour > 12) {
             hour -= 12;
             am_pm = "PM";
         }
         if (hour == 0) {
             hr = 12;
             am_pm = "AM";
         }
 
         hour = hour < 10 ? "0" + hour : hour;
         min = min < 10 ? "0" + min : min;
         sec = sec < 10 ? "0" + sec : sec;
 
         let currentTime = hour + ":" + min + ":" + sec + am_pm;
 
         document.getElementById("clock").innerHTML = currentTime;
     }
 
     showTime();
 </script>
</body>
</html>
