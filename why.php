<?php
session_start();
$servername="localhost";
$username = "root";
$password = "meshde123";
$conn = mysql_connect($servername, $username, $password) or die(mysql_error());
mysql_select_db("menewsDB");
$colors = array("#13b4ff","#ab3fdd","#ae163e","#33ddad","#F5FF33");
$clrs = array("turq","blue","purple","wine","green","yellow");
//$x = "India";
//echo "here";
/*if($_SESSION['user']){
    echo $_SESSION['user'];
}*/
//echo $_GET['type'];
if($_SESSION['user'] && ($_GET['type'] == "Home" || !($_GET['type']))){
    $p = "SELECT * FROM prefreneces where user = '".$_SESSION['user']."'";
    $t = mysql_query($p) or die(mysql_error());
    //echo "here now";
    $i = 0;
    while($row = mysql_fetch_assoc($t)){
        $x = $row['pref'];
        //echo "<h1>".$x."<h1>";
        $h = "Select * from feeds WHERE type = '".$x."' and title='TOI'";
        $q = mysql_query($h) or die(mysql_error());
        while($row = mysql_fetch_assoc($q)){
            $feeds[$i] = $row;
            $i++;
        }

    }
}
else{
    if(!($_SESSION['user']) && (!($_GET['type']) || $_GET['type']=="Home")){
        $x = "Top";
        //echo "NOW";
}
else{
        $x = $_GET['type'];
        //echo "NOT";
    }
    $h = "Select * from feeds WHERE type = '".$x."' and title='TOI'";
    $q = mysql_query($h) or die(mysql_error());
    $i = 0;
    while($row = mysql_fetch_assoc($q)){
        $feeds[$i] = $row;
        $i++;
    }
}
$i=0;
foreach($feeds as $feed){
    $content = file_get_contents($feed['url']);
    $xml = simplexml_load_string($content);
    //print_r($xml);
    foreach($xml->channel->item as $entry){
        if(preg_match("/<a[\s\S]*<\/a>/i",$entry->description,$v)){
            //echo $v[0];
        $item['img'] = $v[0];
        }
        else{
            $item['img'] ="<a href='".$entry->link."'><img border='0' hspace='10' align='left' style='margin-top:3px;margin-right:5px;' src='menews(mods).png' /></a>";
        }
        $item['title'] = $entry->title;
        $item['content'] = str_replace($v[0], "", $entry->description);
        $item['guid'] = $entry->link;
        $item['pub_date'] = strtotime($entry->pubDate);
        //echo $item['pub_date'];
        $item['insert'] = time();
        $art[$i] = $item;
        //echo "<h1>".$feed['type'].$i.")........".$item['title']."</h1><br>".$i.")........".$item['content']."<br>".$i.")........".$item['guid']."<br>";
        $i++;
    }
    /*$que = "INSERT IGNORE INTO articles(title,content,url,pubdate,ins) values('".$item['title']."','".$item['content']."','".$item['guid']."','".$item['pub_date']."','".$item['insert']."')";
    $try = mysql_query($que) or die("For ".$item['content'].mysql_error());
    echo "Bahut Badiya!";*/
}
for($x=0;$x<$i;$x++){
    $max = $art[$x]['pub_date'];
    $pos = $x;
    for($y=$x+1;$y<$i;$y++){
        if($art[$y]['pub_date'] > $max){
            $max = $art[$y]['pub_date'];
            $pos = $y;
        }
    }
    $temp = $art[$x];
    $art[$x] = $art[$pos];
    $art[$pos] = $temp;
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link href="main.css" rel="stylesheet">
        <title></title>
    </head>
    <body>
        <?php 
        
        echo "<div class = 'di'>";
        if($_SESSION['user'] && $_GET['type'] == "Home") {
            $e = 0;
            // echo "<div>";
            $o = "Select * from posts order by rating desc";
            $w = mysql_query($o);
            for($n = 1;$n<=5;$n++){
                $rip = mysql_fetch_assoc($w);
                echo "<div class = 're'><img border='0' hspace='10' align='left' style='margin-top:3px;margin-right:5px;' src='menews(mods).png' /><span class = 'title'>".$rip['title']."</span><br><span class = 'auth'>".$rip['user']."</span><br><span class='content'>".$rip['post']."</span>";
            }
        }
        foreach($art as $r){
            echo "<div class = 're'>".$r['img']."<span class='title'><a  href='".$r['guid']."' target='_blank'>".$r['title']."</a></span><br><br><span class = 'content'>".$r['content']."</span></div>";
            $e = ($e +1)%6;
        }
        echo "</div>";?>
    </body>
</html>
