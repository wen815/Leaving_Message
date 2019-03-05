<form>
    <input type="text" id="username" name="username">
     <input type="password" id="password" name="password">
     <input type="submit" value="登录">
</form>
<?php
session_start();
include'include/connect.php';
$username=$_REQUEST['username'];
$password=md5($_REQUEST['password']);
$q="select id from admin where username='$username'AND password='$password'";
$r= mysqli_query($dbc, $q);
if(mysqli_num_rows($r)==1){
       $_SESSION['username']=$username;

   header("Location:page.php");
}

