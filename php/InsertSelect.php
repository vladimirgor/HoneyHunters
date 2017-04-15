<?php
session_start();
include_once('config.php');
require_once('functions.php');
$name = htmlspecialchars($_GET['name'],ENT_QUOTES);
$comment = htmlspecialchars($_GET['comment'],ENT_QUOTES);
$email = htmlspecialchars($_GET['email'],ENT_QUOTES);
$session = htmlspecialchars($_GET['session'],ENT_QUOTES);
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
