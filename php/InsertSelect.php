<?php
session_start();
include_once('config.php');
require_once('functions.php');
$name = $_GET['name'];
$comment = $_GET['comment'];
$email = $_GET['email'];
$session = $_GET['session'];
if ( $session != session_id() ) {
    $message[] = ['message' => "Возможно предпринята XSS атака." ];
    echo json_encode($message);
    die;
}
$link=dbLink();
if ( $name == "" || $comment == "" || $email == "" ) {
    $message[] = ['message' => "Все данные должны быть непустыми." ];
    echo json_encode($message);
    die;
} else {
    Insert(TABLE, ['name' => $name, 'comment' => $comment, 'email' => $email], $link);
    $sql = "SELECT * FROM " . TABLE . " ORDER BY id DESC";
    $comment_list = Select($sql, $link);
    echo json_encode($comment_list);
}
