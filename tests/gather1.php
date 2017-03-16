<?php
$servername = "localhost";
$username = "root";
$password = "meshde123";
$conn = mysql_connect($servername, $username, $password) or die(mysql_error());
mysql_select_db("menewsDB");
$x = "India";
$h = "Select * from feeds WHERE type = '".$x."'";
$q = mysql_query($h) or die(mysql_error());
$i = 0;
while($row = mysql_fetch_assoc($q)){
    $feeds[$i] = $row;
    $i++;
}
//$now = time();
//print_r($feeds);
foreach($feeds as $feed){
    $content = file_get_contents($feed['url']);
    $xml = simplexml_load_string($content);
    //print_r($xml);
    $i=0;
    foreach($xml->channel->item as $entry){
        if(preg_match("/<a[\s\S]*<\/a>/i",$entry->description,$v)){
            //echo $v[0];
            $item['img'] = $v[0];
        }
        else{
            $item['img'] = "No image available!";
        }
        $item['title'] = $entry->title;
        $item['content'] = str_replace($v[0], "", $entry->description);
        $item['guid'] = $entry->link;
        $item['pub_date'] = strtotime($entry->pubDate);
        $item['insert'] = time();
        $art[$i] = $item;
        echo "<h1>".$i.")........".$item['title']."</h1><br>".$i.")........".$item['content']."<br>".$i.")........".$item['guid'].$item['img']."<br>";
        $i++;
    }
    /*$que = "INSERT IGNORE INTO articles(title,content,url,pubdate,ins) values('".$item['title']."','".$item['content']."','".$item['guid']."','".$item['pub_date']."','".$item['insert']."')";
    $try = mysql_query($que) or die("For ".$item['content'].mysql_error());
    echo "Bahut Badiya!";*/
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
