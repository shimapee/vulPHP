<?php
session_start();
require_once 'dao.php';
$tmpfile = $_FILES["icon"]["tmp_name"];
$originfile = $_FILES["icon"]["name"];
$dao = new Dao();
$data = array (
  'uid' => $_SESSION['user_id'],
  'name' => $_POST['name'],
  'mail' => $_POST['mail'],
  'birth' => $_POST['birth'],
  'add' => $_POST['add'],
  'image' => $originfile
);
$chk = $dao->registerUserInfo($data);
if($chk == 1) {
  $_SESSION['mailadd'] = $data['mail'];
  $_SESSION['username'] = $data['name'];
  $_SESSION['birthday'] = $data['birth'];
  $_SESSION['address'] = $data['add'];
  move_uploaded_file($tmpfile, 'img/'. $originfile);
  echo ("<Script>alert('更新しました。'); location.href = 'userinfo.php'</script>");
} else {
  echo ("<Script>alert('更新できません。'); location.href = 'userinfo.php'</script>");
}
