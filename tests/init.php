

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
        <?php
$servername = "localhost";
$username = "root";
$password = "meshde123";
$conn = mysql_connect($servername,$username,$password)
        or die ('Error connecting to mysql'.mysql_error());
echo "Successful";
mysql_select_db('menewsDB');
if(!($_POST['in'])){
    echo "why are you here";
}
else{
    echo "<script type =\"text/javascript\">
       var e =  document.getElementById(\"abc\");
       e.style.display = \"none\";
    </script>";
    echo $_POST['in'];
}
    
//$h = "update feeds set last = '".time()."'";
//mysql_query($h);
?>
    </head>
    <body>
        <form method="post" action="<?= $_SERVER['PHP_SELF']?>">
        <input type="text" name="in" id="abc" style= <?php if(!($_POST['in'])){echo "\"display:initial\"";} else{echo "\"display:none\"";} ?> />
        </form>

    </body>
</html>
