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

<html>
<head>
    
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">
    
<link href="menu.css" rel="stylesheet">
<link href="LoginSignUp.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="menu.js"></script>
     
</head>
<body>


<div class="menu_horizontal">
    <div style="background:#5FD367;height:45;width:185;float:left;">
    <img src="images/Thug-Life-Glasses-PNG.png" width="185" height="45" >
    </div>
    <button class="mh">ContactUs</button>
    <button class="mh">SignUp</button>
    <button class="mh">Login</button>


       
<div class="type">
<ul>
<li><button id="homepage" class="mv">Home</button></li>
    <li><button class="mv">World</button></li>
    <li><button class="mv">India</button></li>
    <li><button class="mv">Business</button></li>
<li><button class="mv">Technology</button></li>
<li><button class="mv">Entertainment</button></li>
<li><button class="mv">Sports</button></li>
<li><button class="mv">Health</button></li>
<li><button class="mv">Science</button></li>
<li><button class="mv">Education</button></li>
<li><button class="mv">Culture</button></li>
    </ul>
</div>
    </div>

   <!-- Right Container -->
    
    <!-- Container ends -->
    
    
    
    <!--Login Starts -->
   <!-- <div class="login">  -->
   
<div id="popup1" class="overlay">
	<div class="popup">
        <h2>Login </h2>
		<div class="form">
        <form action="action_page.php" method="post">
  UserName:<br>
  <input type="text" name="username" value="" required>
  <br><br>
  Password:<br>
  <input type="Password" name="password" value="" required>
  <br><br>

		<div class="login" id="valid" >
        <button type="submit" onclick="LValidate()">Login</button>  
   <!-- <input type="Submit" value="Login" >  -->
    <button id="Lcancel" onclick="Cancel(this.id)" >cancel</button>
            </div>
        </form>
</div>
   
    </div>
    </div>
    <!-- Login Ends -->

    <!-- SignUp Starts -->
    
    <div id="popup2" class="overlay">
	<div class="popup">
        <h2>SignUp </h2>
		<div class="form">
        <form action="action_page.php" method="post">
  Email-Id:<br>
  <input type="email" name="email"   required>
  <br><br>
  UserName:<br>
  <input type="text" name="S-username" text-algn="Center" required>
  <br><br>
  Password:<br>
  <input type="Password" name="S-password"  text-align="Center" required>
  <br><br>
  Re-Enter Password:<br>
  <input type="Password" name="S-password" text-align="Center" required>
  <br><br>
  <input type="checkbox" value="Terms&Condtn"> <span  style="font-size:12px;padding-bottom:10px;">By checking this box, you agree to our Terms and that you have read our Data Policy, including our Cookie Use. </span>
  <br><br>

		<div class="login" id="valid" >
        <button type="submit" onclick="SValidate()">Create Account</button>  
   <!-- <input type="Submit" value="Login" >  -->
    <button onclick="Cancel(this.id)" id="Scancel">cancel</button>
            </div>
        </form>
</div>
   
    </div>
    </div>
    
    <!-- SignUp Ends -->
    <!-- Contact Us -->
    <div id="popup3" class="overlay">
	<div class="popup">
        <div class="boxclose">
        <button type="button" onclick="Cancel(this.id)" id="Ccancel">X</button>
        </div>
        <h2>Contact Us </h2>
		<h4>Corporate Office</h4>
        <h5><pre>Menews Limited
Meenu IT Park 
Plot 420, Chomu Vihar, Phase 96
Gurgaon Haryana-122016</pre></h5>
        
</div>
   
    </div>
    </div>
    </div>
    <!--Contact us ends -->
    

<div id="box" style="margin-left:185px;margin-top:45px;width:70%;" src="https://www.google.co.in/">

</div>
<div id="Home" style="display:none;">
   



    
   <h1>TRENDING NOW</h1>
    @Twitter.Search("webmatrix");
    
    
    <div class="row">
    <?php foreach($art as $w):?>
  <div class="block">
  <?= $w['content'] ?>
  </div>
   <?php endforeach;?>
  </div>  
</div>
   

      
   
    

    
    <div id="India" style="display:none;">
    <h3>India</h3>
    <p>India......will be displaying the trending news...........dskfe;gof;kjjnafng;irahiv;zfaaghzdf;lvjiers</p>
   <div id="select" class="source">
        <img src="images/images.jpg" alt="image1" width="192" height="120"  >
        <img src="images/images%20(1).jpg" alt="image2" width="192" height="120" >
        <img src="images/images%20(2).jpg" alt="image3" width="192" height="120">
    </div>
 </div>

<div class="footer">
    <button class="mf">SignUp</button>
    <button class="mf">AboutUs</button>
    <button class="mf">ContactUs</button>
    <button class="mf">Terms of Use</button>
    <button class="mf">Privacy Policy</button>
    <div style="color:#fff;font-size:10px;">
    <pre style="margin-top:0px;">Menews Ltd-All rights reserved.<br>&copy 2016;
    </pre>
    </div>
    
    
    </div>

</body>
</html>