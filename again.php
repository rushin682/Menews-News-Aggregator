<?php 
session_start();
$servername = "localhost";
$username = "root";
$password = "meshde123";
$conn = mysql_connect($servername, $username, $password) or die(mysql_error());
mysql_select_db("menewsDB");
$flag = 0;
$pre = array('World','India','Tech','Business','Sport','Education','Health');
/*if($_POST['username']){
    $_SESSION['user'] = $_POST['username'];
}*/
//echo $_GET['log'];
if($_GET['log'] == "out"){
    session_unset();
    session_destroy();
}



if($_POST['luname'] && $_POST['lpass']){
    $flag = 1;
    $qu = "Select pwd from users where usernname= '".$_POST['luname']."'";
    $tr = mysql_query($qu);
    $ro = mysql_fetch_assoc($tr);
    if($_POST['lpass'] == $ro['pwd']){
        $_SESSION['user'] = $_POST['luname'];
    } 
    else{
        echo "<script type='text/javascript'>alert('invalid username or password');</script>";
    }
}

if($_POST['fname']){
    $flag = 1;
    $qry = "select usernname from users where usernname = '".$_POST['suname']."'";
    $e = mysql_query($qry);
    $j = mysql_fetch_assoc($e);
    if($_POST['suname'] == $j['usernname']){
        echo "<script type='text/javascript'>alert('Username already exists');</script>";
    }
    else{
        $qr2 = "insert into users values('".$_POST['suname']."','".$_POST['mail']."','".$_POST['fname']."','".$_POST['lname']."','".$_POST['spass']."')";
        $f=mysql_query($qr2) or die(mysql_error());
        $rep = $_POST['pre'];
        foreach($rep as $rew){
            $qr3 = "insert into prefreneces values('".$_POST['suname']."','".$rew."')";
            $we = mysql_query($qr3) or die(mysql_error()); 
        }
        $_SESSION['user'] = $_POST['suname'];
    }
}
?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">   
<link href="menu.css" rel="stylesheet">
<link href="LoginSignUp.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="menu.js"></script>
        <title></title>
    </head>
    <body>
        <div class="menu_horizontal">
            <div class="Users" style= <?php if(!($_SESSION['user'])){echo "\"display:inline-block;\"";} else{echo "\"display:none;\"";} ?>>
    <button class="mh">ContactUs</button>
    <a class ="mh" target="news" href='profile.php'>SignUp</a>
    <button class="mh">Login</button>
    </div>
            <?php
                if($_SESSION['user']){
                    echo "<div class='Users'>Hello &nbsp; ".$_SESSION['user']."<a class = 'mh' href='".$_SERVER['PHP_SELF']."?log=out'>LOG OUT</a> </div>";
                }
                
            ?>
            
        <div class="type" >
        <?php echo "<a class =\"mv\" target=\"news\" href='why.php?type=Home'>Home</a>" ?>
            <?php echo "<a class =\"mv\" target=\"news\" href='why.php?type=India'>India</a>" ?>
            <?php echo "<a class =\"mv\" target=\"news\" href='why.php?type=World'>World</a>" ?>
            <?php echo "<a class =\"mv\" target=\"news\" href='why.php?type=Business'>Business</a>" ?>
            <?php echo "<a class =\"mv\" target=\"news\" href='why.php?type=Tech'>Technology</a>" ?>
            <?php echo "<a class =\"mv\" target=\"news\" href='why.php?type=Sports'>Sports</a>" ?>
            <?php echo "<a class =\"mv\" target=\"news\" href='why.php?type=Health'>Health</a>" ?>
            <?php echo "<a class =\"mv\" target=\"news\" href='why.php?type=Science'>Science</a>" ?>
            <?php echo "<a class =\"mv\" target=\"news\" href='why.php?type=Education'>Education</a>" ?>
            <?php echo "<a class =\"mv\" target=\"news\" href='profile.php'>Profile</a>" ?>
        </div></div>
        <div id="popup1" class="overlay">
    <div class="popup">
        <h2>Login </h2>
		<div class="form">
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>" >
  UserName:<br>
  <input type="text" name="luname" value="" required>
  <br><br>
  Password:<br>
  <input type="Password" name="lpass" value="" required>
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
        <!-- Contact Us -->
<div id="popup3" class="overlay">
	<div class="popup">
        <div class="boxclose">
        <button type="button" onclick="Cancel(this.id)" id="Ccancel">X</button>
        </div>
        <h3>Contact Us </h3>
		<h5>Corporate Office</h5>
        <p><pre>Menews Limited
Meenu IT Park 
Plot 420, vidya Vihar, Phase 96
Kashmir-122016</pre>
        
    </div>   
</div>
  
  
    


        
        <iframe id="news" name="news" src="<?php if($flag == 0){echo "why.php?type=Home";}else{echo "profile.php";}?>"></iframe>
        <iframe id="twitter" src="twitter.php" align ="right" height= "600px" width ="25%" frameborder ="0"></iframe> 
    </body>
</html>
