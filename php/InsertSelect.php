<?php
include_once('config.php');
require_once('functions.php');
$name = $_GET['name'];
$comment = $_GET['comment'];
$email = $_GET['email'];

$link=dbLink();
if ( $name != "" )
Insert(TABLE,['name' => $name,'comment' => $comment,'email' => $email],$link);
$sql="SELECT * FROM ". TABLE ." ORDER BY id DESC";
$comment_list=Select($sql,$link);
echo json_encode($comment_list);

