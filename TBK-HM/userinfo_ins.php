<?php
require_once 'dao.php';
$dao = new Dao();
$data = array (
  'name' => $_POST['name'],
  'mail' => $_POST['mail'],
  'birth' => $_POST['birth'],
  'add' => $_POST['add'],
  'pass' => $_POST['pass1']
);
echo ("<Script>alert('" . $dao ->inputUserInfo($data)."'); location.href = 'login.html'</script>");
