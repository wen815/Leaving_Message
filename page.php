<?php
session_start();
require 'include/connect.php';
$q="select * from gbook";
$r= mysqli_query($dbc, $q);
$count= mysqli_num_rows($r);//数据库总行数
if(empty($_GET['page'])){
    $page=1;
}
else{
   $page=$_GET['page']; 
}
$page_len=5;//页码长度
$pagesize=1; //每页包含的数据库行数
  $st=null;//用于存储页码的数组
      $startindex=($page-1)*$pagesize;
$sql="select * from gbook ORDER BY id LIMIT $startindex,$pagesize";
$result= mysqli_query($dbc, $sql);

while ($row = mysqli_fetch_array($result)) {
         $id=$row['ID'];
    echo"<p class='p'>";  
    echo "<b>".$row['subject']."</b>";
  echo $row['name']."于".$row['date'];  
  echo "<br>".$row['content']."<br>";
        if(  $_SESSION['username']=='admin'){
       
            echo "<a href='reply.php?id=$id'>"."回复"."</a>";
                echo "<a href='delete.php?id=$id'>"."删除"."</a>";
        echo "<br>"."管理员回复：".$row['reply'];
}
    echo"</p>";  
}
$pagenum=ceil($count/$pagesize);//总页数
//上一页
if($page==1){
    $last=1;
}
else if($page>1){
    $last=$page-1;
    $slast="<a href='?page=$last'>上一页</a>";
 $st.=$slast."&nbsp&nbsp";
}

//带省略号的页码
for($i=1;$i<=$pagenum;$i++){
      	if ($pagenum> $page_len) { 
			$half = floor(($page_len - 4) / 2);
			$half_start = $page - $half+ 1;
			if ($page_len % 2 !== 0) --$half_start;
			$half_end = $page + $half;
                      
		}
                	if (($pagenum- $page) < ($page_len - 3)) {
			$half_start = $pagenum- $page_len + 3;
			unset($half_end);
		}
                	if ($page <= ($page_len - 3)) {
			$half_end = $page_len-2;
			unset($half_start);
		}
                     if($page==$i){ 
     
    $st.="<a class='i'>$i</a>";
}
else{
    if (isset($half_start) && $i < $half_start && $i > 1) {
                              if ($i == 2)    {$st.="..."; }                             
			    continue;	
			}
			if (isset($half_end) && $i > $half_end && $i < $pagenum) {
       		if ($i == ($half_end+1)){$st.="..."; }
				continue;
			}
       
                        else{
       $st.="<a href='?page=$i')>&nbsp&nbsp$i&nbsp&nbsp</a>";
                        }
}
}
    //下一页
if($page<$pagenum){
    $next=$page+1;
            $snext="<a href='?page=$next'>下一页</a>";
 $st.=$snext."&nbsp&nbsp";
}

?>
<section id="s1"><?php echo $st;?></section>
<?php include'submit.php';?>
<script src="js/form.js"></script>
<style>
    .i{color:red;}
  #s1 a{text-decoration: none;}  
  .p{border:1px solid blue;}
</style>
