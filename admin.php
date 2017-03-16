<?php
    session_start();
    $servername = "localhost";
$username = "root";
$password = "meshde123";
$conn = mysql_connect($servername, $username, $password) or die(mysql_error());
mysql_select_db("menewsDB");
  echo "<span class='pls'>Admin Page</span>";
  if($_GET['log'] == "out"){
      session_unset();
      session_destroy();
  }
if($_POST['adname']){

    $q = "select adpass from admin where adu = '".$_POST['adname']."'";
    $try = mysql_query($q);
    $th = mysql_fetch_assoc($try);
   // print_r($th);
    if($th['adpass'] == $_POST['adpass']){
        $_SESSION['admin'] = $_POST['adname'];
    }
    else{
        echo "<span class = 'f' style='text-align:center;border:0px;'>Please Try again!</span>";
    }
    
    
}
if($_POST['rating']){
        $rus = $_GET['post'];
        //echo $rus."<br>".$_POST['rating'];
        $que="Update posts set rating = '".$_POST['rating']."' where title='".$rus."'";
        $try2=mysql_query($que) or die("You have failed");
    }

    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link href="login.css" rel="stylesheet">
        <title></title>
         <link href="login.css" rel="stylesheet">
         <link href="menu.css" rel="stylesheet">
    </head>
    <body>
        <?php
            if(!$_SESSION['admin']){
               
            
echo "<div class='f'><form method= 'post' id='su' action='admin.php' target='_parent'>
            <br><input class = 'txt' type = 'text' placeholder='Username' name = 'adname' id = 'luname' value='' required><br>
            <input class = 'txt' type = 'password' placeholder='Password' name='adpass' id='lpass' value='' required><br>
            <span id='e1' class='e' style='display:none;'>Please fill in all details</span>
            <button class = 'button' type='submit' name = 'login' id='l'>Login</button>
            </form></div>";
            }
            else{
                
                echo "<div class='Users' style='margin-top:0px'>Hello &nbsp; ".$_SESSION['admin']."<a class = 'mh' style='margin-top:0px;' href='".$_SERVER['PHP_SELF']."?log=out'>LOG OUT</a> </div><br><br>";
                
                $x = -1;
                $qu = "select * from posts where rating = '".$x."' order by inser desc";
                //echo $qu."<br>";
                $t= mysql_query($qu) or die("bye bye");
                
                //print_r($t);
                $i=0;
                while($row = mysql_fetch_assoc($t)){
                    $i++;
                echo "<div class='f2' style='font-family:Century Gothic;'><form method= 'post' action='admin.php?post=".$row['title']."' target='_parent'>";
                    echo "User: '".$row['user']."'<br>Title: '".$row['title']."'<br> Post: '".$row['post']."'<br>"; 
                 echo " Rating:
  <input type='range' name='rating' min='0' max='5'>
  <input type='submit' value='update'>"; 
                echo "</div></form><br>";
                }

                if($i == 0){
                    echo "All posts rated!";
                }
            }
?>

    </body>
</html>
