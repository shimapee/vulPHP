<?php
session_start();
require_once 'dao.php';
$dao = new Dao();
$data = array (
		"user_id" => $_SESSION['user_id'],
		"isbn13" => $_POST['isbn13'],
		"comment" => $_POST['comment']
);
echo ("<Script>alert('" . $dao ->registerComment($data)."'); location.href = 'list.php'</script>");
