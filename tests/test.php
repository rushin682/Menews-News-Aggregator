<?php
   $servername = "localhost";
$username = "root";
$password = "meshde123";
$conn = mysql_connect($servername, $username, $password)
        or die ('Error connecting to mysql'.mysql_error());
//echo "Successful"; 
mysql_select_db('menewsDB');
$h = "SELECT * from articles";
$c = mysql_query($h);
while($row = mysql_fetch_assoc($c)){
    foreach ($row as $key=>$el) {
    //echo "<br>".$i."<br>";
    echo $key." ".$el."<br>";
    //$i++;
}
}
//$i = 1;

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
        
    </body>
</html>
