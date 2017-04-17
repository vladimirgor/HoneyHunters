<?php
session_start();
include_once('config.php');
require_once('functions.php');
$p = preg_match('~^[A-ZА-ЯЁ][А-Яа-яЁёA-Za-z\s]+$~', $_GET['name']);
if ($p === 0) {
    $message[] = ['message' => "Введите, пожалуйста, имя правильно ." ];
    echo json_encode($message);
    die;
} else {
    $name = htmlspecialchars($_GET['name'], ENT_QUOTES);
    $p = preg_match('~^[A-ZА-ЯЁ][А-Яа-яЁёA-Za-z!\-,.\s"]+$~', $_GET['comment']);
    if ($p === 0) {
        $message[] = ['message' => "Введите, пожалуйста, комментарий правильно ."];
        echo json_encode($message);
        die;
    } else {
        $comment = htmlspecialchars($_GET['comment'], ENT_QUOTES);
        $p = preg_match('~^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$~', $_GET['email']);
        if ($p === 0) {
            $message[] = ['message' => "Введите, пожалуйста, e-mail правильно ."];
            echo json_encode($message);
            die;
        } else {
            $email = htmlspecialchars($_GET['email'], ENT_QUOTES);

            $session = htmlspecialchars($_GET['session'], ENT_QUOTES);
            if ($session != session_id()) {
                $message[] = ['message' => "Возможно предпринята XSS атака."];
                echo json_encode($message);
                die;
            }
            $link = dbLink();
            Insert(TABLE, ['name' => $name, 'comment' => $comment, 'email' => $email], $link);
            $sql = "SELECT * FROM " . TABLE . " ORDER BY id DESC";
            $comment_list = Select($sql, $link);
            echo json_encode($comment_list);
        }
    }
}