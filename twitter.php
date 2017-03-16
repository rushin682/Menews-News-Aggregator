

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link href="twitt.css" rel="stylesheet">
        <title></title>
    </head>
    <body>
        <form method="post" action="<?= $_SERVER['PHP_SELF']?>">
        <input type="text" name="search" id="in" placeholder="Search Twitter"  style="border-width: 1px;border-color: rgba(0,0,0,.3);border-radius: 10px;height: 22px;box-shadow: 2px 2px rgba(0, 0, 0, .3);" required>
            <button id="bt" type="submit" >Search</button>
        </form>
        <br>
        <br>
        <?php
$link = "https://twitrss.me/twitter_search_to_rss/?term=";
/*$x = "ms dhoni";
$y = str_replace(" ","+",$x);
$link .= $y;
//echo $link;
$content = file_get_contents($link);
//print_r($content);
$content = str_replace("dc:creator","author",$content);
/*$content = str_replace("<![CDATA[","",$content);
$content = str_replace("]]>","",$content);
$content= addslashes($content);*/
/*$xml = simplexml_load_string($content);
//print_r($xml);
foreach($xml->channel->item as $tweet){
        preg_match("/(.*)/",$tweet->author,$v);
        $hand = $v[0];
        $auth = str_replace($hand,"",$tweet->author); 
        echo "<div class='twit'>
        <span class='creator'>".$auth."</span>
        <span class= 'handle'>".$hand."</span>
        <span class='content'>".$tweet->description."</span></div><br>";
}*/
//print_r($xml);
if($_POST['search']){
    $x = trim($_POST['search']);
    $y = str_replace(" ","+",$x);
    $link .= $y;
    //echo $link;
    $content = file_get_contents($link);
    $content = str_replace("dc:creator","author",$content);
    $xml = simplexml_load_string($content);
    foreach($xml->channel->item as $tweet)  {
        preg_match("/(.*)/",$tweet->author,$v);
        $hand = $v[0];
        $des = str_replace("<b>","",$tweet->description);
        $des = str_replace("</b>","",$des);
        $auth = str_replace($hand,"",$tweet->author); 
        echo "<div class='twit'>
        <img id='tweeet' src='twittwer.png'><span class='creator'>".$auth."</span>
        <span class= 'handle'>".$hand."</span>
        <span class='content'>".$des."</span></div>";
    } 
}
else{
    echo "<a class='twitter-timeline' data-width='300' data-height='400' href='https://twitter.com/BBCNews' >Tweets by BBCNews</a> <script async src='//platform.twitter.com/widgets.js' charset='utf-8'></script>";
}
?>
    </body>
</html>
