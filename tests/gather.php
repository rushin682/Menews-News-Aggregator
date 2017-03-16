<?php
session_start();
$username = "root";
$password = "meshde123";
$conn = mysql_connect($servername, $username, $password) or die(mysql_error());
mysql_select_db("menewsDB");
if($_SESSION['user'] && $_GET['type'] == "Home"){
    $p = "SELECT * FROM prefernces where username = '".$_SESSION['user']."'";
    $t = mysql_query($p) or die(mysql_error());
    while($row = mysql_fetch_assoc($t)){
        $x = $row['pref'];
        $h = "Select * from feeds WHERE type = '".$x."'";
        $q = mysql_query($h) or die(mysql_error());
        $i = 0;
        while($row = mysql_fetch_assoc($q)){
            $feeds[$i] = $row;
            $i++;
        }

    }
}
else{
    if(!($_SESSION['user']) && !($_GET['type'])){
        $x = "Top";
}
else{
        $x = $_GET['type'];
    }
    $h = "Select * from feeds WHERE type = '".$x."'";
    $q = mysql_query($h) or die(mysql_error());
    $i = 0;
    while($row = mysql_fetch_assoc($q)){
        $feeds[$i] = $row;
        $i++;
    }
}
foreach($feeds as $feed){
    $content = file_get_contents($feed['url']);
    $xml = simplexml_load_string($content);
    //print_r($xml);
    $i=0;
    foreach($xml->channel->item as $entry){
        $item['title'] = $entry->title;
        $item['content'] = str_replace("'", "\'", $entry->description);
        $item['guid'] = $entry->link;
        $item['pub_date'] = strtotime($entry->pubDate);
        $item['insert'] = time();
        $art[$i] = $item;
        //echo "<h1>".$i.")........".$item['title']."</h1><br>".$i.")........".$item['content']."<br>".$i.")........".$item['guid']."<br>";
        $i++;
    }
    /*$que = "INSERT IGNORE INTO articles(title,content,url,pubdate,ins) values('".$item['title']."','".$item['content']."','".$item['guid']."','".$item['pub_date']."','".$item['insert']."')";
    $try = mysql_query($que) or die("For ".$item['content'].mysql_error());
    echo "Bahut Badiya!";*/
}

?>


