<?php
session_start();
require_once 'dao.php';
$dao = new Dao();
$data = array (
    "user_id" => $_SESSION['user_id'],
    "isbn13" => $_GET['isbn13'],
    "isbn10" => $_GET['isbn10'],
    "bookname" => $_GET['bookname'],
    "author" => $_GET['author']
);
echo ("<Script>alert('" . $dao ->registerData($data)."'); location.href = 'list.php'</script>");
