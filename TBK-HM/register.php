<?php
session_start();
require_once 'dao.php';
$dao = new Dao();
$data = array (
    "user_id" => $_SESSION['user_id'],
    "isbn13" => $_POST['isbn13'],
    "isbn10" => $_POST['isbn10'],
    "bookname" => $_POST['bookname'],
    "author" => $_POST['author']
);
echo ("<Script>alert('" . $dao ->registerData($data)."'); location.href = 'list.php'</script>");
