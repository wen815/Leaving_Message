<style>
    #reply{width:300px;height: 300px;}
</style>
<form>
    <input type="text" name="id" value="<?php echo $_REQUEST['id']; ?>">
    <input type="textarea" id="reply" name="reply" >
    <input type="submit">
</form>
<?php
session_start();
include'include/connect.php';


echo $_SESSION['username'];
if($_SESSION['username']=='admin'){
$reply=$_REQUEST['reply'];
$id=$_REQUEST['id'];

$qr="UPDATE gbook SET reply='$reply' WHERE ID='$id'";
$rr= mysqli_query($dbc, $qr);
if(mysqli_num_rows($rr)!=1){
    echo "R";
}
}
else{
    echo "w";
}

