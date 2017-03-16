<?php
$server = "localhost";
$user = "root";
$pass= "meshde123";
$conn = mysql_connect($server,$user,$pass)
or die ('Error Connecting '.mysql_error());
//echo "S";
mysql_select_db("menewsDB") or die('error 2'.mysql_error());
//echo "S2";
$h = "SELECT * from feeds";
$q = mysql_query($h) or die('erroe 3'.mysql_error());
//echo "Here now";
$row = mysql_fetch_assoc($q);
//echo $row['url'];
$n = file_get_contents($row['url']) or die(mysql_error());
//echo $n;
$xml = simplexml_load_string($n) or die(mysql_error());
//print_r($xml);
$i = 1;
foreach($xml->channel->item as $entry){
    echo "<b>ITEM ".$i."</b><br>";
    echo "<b>Title: </b>".$entry->title."<br>";
    echo "<b>Description: </b>".$entry->description."<br>";
    echo "<b>GUID: </b>".$entry->link."<br>";
    echo "<b>PubDate: </b>".strtotime($entry->pubDate)."<br>";
    $i++;
}
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
