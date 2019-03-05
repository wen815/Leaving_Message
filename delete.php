<?php
require 'include/connect.php';
$id=$_REQUEST['id'];
$q = "DELETE FROM gbook WHERE ID=$id LIMIT 1";
$r = mysqli_query ($dbc, $q);

