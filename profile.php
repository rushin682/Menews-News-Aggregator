<?php
    session_start();
    //$_SESSION['user'] = 'meshde';
    //$_SESSION['prof'] = 'meshde';
$servername = "localhost";
$username = "root";
$password = "meshde123";
$conn = mysql_connect($servername, $username, $password) or die(mysql_error());
mysql_select_db("menewsDB");
//echo "Here";
//echo $_POST['head'];
//echo $_POST['body'];
if($_POST['head'] && $_POST['body']){
    //echo "Here Now";
    $query = "insert into posts values('".$_SESSION['user']."','".addslashes($_POST['body'])."','".time()."','".addslashes($_POST['head'])."')";
    $insert = mysql_query($query) or die(mysql_error());
}



?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link href="login.css" rel="stylesheet">
        <script type="text/javascript">
            function bring(hel)
            {
                if (hel == 'log')
                {
                    var e = document.getElementsByClassName('f1');
                    e[0].style.display = "none";
                    var x = document.getElementsByClassName('f');
                    x[0].style.display = "block";
                    //e[0].opacity = '0';
                }
                else
                {
                    var e = document.getElementsByClassName('f1');
                    e[0].style.display = "block";
                    var x = document.getElementsByClassName('f');
                    x[0].style.display = "none";
                }
            }
            function check(hel)
            {
                if (hel == 'l')
                {
                    if (document.getElementById('luname').value == '' || document.getElementById('lpass').value == '')
                    {
                        document.getElementById('e1').style.display = 'block';
                    }
                    else
                    {
                        document.getElementById('su').submit();
                    }
                }
                else if (hel == 's')
                {
                    if (document.getElementById('suname').value == '' || document.getElementById('spass').value == '' || document.getElementById('rpass').value == '' || document.getElementById('fname').value == '' || document.getElementById('lname').value == '' || document.getElementById('mail').value == '')
                    {
                        document.getElementById('e2').style.display = 'block';
                    }
                    else if (document.getElementById('spass').value != document.getElementById('rpass').value)
                    {
                        document.getElementById('e2').innerHTML = 'Passwords Do not match';
                        document.getElementById('e2').style.display = 'block';
                    }
                    else
                    {
                        var log = document.getElementById("pref");
                        log.style.display = "inline-block";
                        var but = document.getElementById("s");
                        but.style.display = "none";

                    }
                }
            }

        </script>
        <title></title>
    </head>
    <body>
        <?php
        if(!$_SESSION['user'] ){
            echo "<p class='pls'>Please Login to Continue!</p><ul style='width:100%;margin-left:17%;'>
            <li class='r'><button class = 'typ' type='button' id='log' onclick='bring(this.id)'>Log-in</button></li>
            <li class='r'><button class = 'typ' type='button' id='sign' onclick='bring(this.id)'>Signup</button></li>
            </ul>
            
            <div class='f'><form method= 'post' id='su' action='again.php' target='_parent'>
            <br><input class = 'txt' type = 'text' placeholder='Username' name = 'luname' id = 'luname' value='' required><br>
            <input class = 'txt' type = 'password' placeholder='Password' name='lpass' id='lpass' value='' required><br>
            <span id='e1' class='e' style='display:none;'>Please fill in all details</span>
            <button class = 'button' name = 'login' id='l' onclick='check(this.id)'>Login</button>
            </form></div>
            <div class='f1'><form method='post' id = 'su1' action='again.php' target='_parent'>
            <br><input class = 'txt' type = 'text' placeholder='First Name' name='fname' id='fname' value='' required><br>
            <input class = 'txt' type = 'text' placeholder='Last Name' name='lname' id='lname' value='' required><br>
            <input class = 'txt' type = 'email' placeholder='E-mail id' name='mail' id='mail' value=''  required><br>
            <input class = 'txt' type = 'text' placeholder='Username' name='suname' id='suname' value='' required><br>
            <input class = 'txt' type = 'password' placeholder='Password' name='spass' id='spass' value='' required><br>
            <input class = 'txt' type = 'password' placeholder='Re-enter Password' name='rpass' id='rpass' value='' required><br>
            
            <span id='e2' class='e' style='display:none;'>Please fill in all details</span>
             <button type = 'button' class = 'button' id='s' name='signup' onclick='check(this.id)' style='display:inline-block;'>Check</button>
            <div class='pref' id='pref' style='display: none;'>
            <b>Preferences:</b><br>
            <input type='checkbox' name='pre[]'  value='India'>India<br>
            <input type='checkbox' name='pre[]' value='World'>World<br>
            <input type='checkbox' name='pre[]' value='Sport'>Sport<br>
            <input type='checkbox' name='pre[]' value='Business'>Business<br>
            <input type='checkbox' name='pre[]' value='Education'>Education<br>
            <input type='checkbox' name='pre[]' value='Health'>Health<br>
            <input type='checkbox' name='pre[]' value='Science'>Science<br>
            <input type='checkbox' name='pre[]' value='Tech'>Tech<br></div>
            <button type = 'submit' class = 'button' id='sub' name='signup'>Signup</button>
            </form></div>";
            
        }
        elseif(!($_GET['pro'])){
            $u = $_SESSION['user'];
            $r = "Select * from users where usernname = '".$u."'";
            $q = mysql_query($r) or die(mysql_error());
            $arr = mysql_fetch_assoc($q);
            echo "<div id='u'><p><b>".$arr['FName']." ".$arr['LName']."<br>".$u."</b></p></div>
                    <div class = 'posts'>";
            $que = "select * from posts where user = '".$u."' order by inser desc";
            $gt = mysql_query($que) or die(mysql_error());
            $i=0;
            while($post = mysql_fetch_assoc($gt)){
                $i++;
                echo "<div class='f2'><span class='title'><b>".stripslashes($post['title'])."</b><br></span><span class='byline'>".$post['user']." &nbsp;&nbsp;&nbsp;".$post['insert']."<br></span><span class='content'>".stripslashes($post['post'])."</span></div><br>"; 
            }
            if($i == 0){
                echo "No posts yet!";
            }
            echo "<div class='f3'><form  method='post' action='".$_SERVER['PHP_SELF']."'>
            <input type = 'text' name = 'head' placeholder='Please give an appropriate title'/>
            <br><textarea name = 'body' placeholder='Write your post here'></textarea>
            <br><button type='submit'>Post</button></form></div>";
            echo "</div>";



        }
        ?>
    </body>
</html>
