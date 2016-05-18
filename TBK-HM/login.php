<?php
require_once 'dao.php';
$id = $_POST['loginid'];
$pass = $_POST['password'];

$dao = new Dao();
if($dao->isAuth($id, $pass)) {
	session_start();
	foreach ($dao->getUserDate($id) as $udata) {
		$_SESSION['user_id'] = $udata['user_id'];
		$_SESSION['mailadd'] = $udata['user_email'];
		$_SESSION['username'] = $udata['user_name'];
		$_SESSION['birthday'] = $udata['user_birthday'];
		$_SESSION['address'] = $udata['user_address'];
	}

	header('Location: list.php');
	exit;
} else {
	echo "<script>alert('入力情報に間違いがあります。');location.href = 'login.html'</script>";
	
}