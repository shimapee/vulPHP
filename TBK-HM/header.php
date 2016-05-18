<?php
session_start();
	
	//echo $id;
	function menuActive() {
		$id = $_SESSION['menu'];
		if($id == 0) {
			echo "<li class='active'><a href='list.php?tg=0'>リスト</a></li>";
			echo "<li><a href='input.php'>登録</a></li>";
			echo "<li><a href='commlist.php'>コメント</a></li>";
		} elseif ($id == 1) {
			echo "<li><a href='list.php?tg=0'>リスト</a></li>";
			echo "<li class='active'><a href='input.php'>登録</a></li>";
			echo "<li><a href='commlist.php'>コメント</a></li>";
		} elseif ($id == 2) {
			echo "<li><a href='list.php?tg=0'>リスト</a></li>";
			echo "<li><a href='input.php'>登録</a></li>";
			echo "<li class='active'><a href='commlist.php'>コメント</a></li>";
				
		}
	}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>TBKHACK-DEMO</title>
<!-- CSS -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/line-comment.css">
<!-- JavaScript -->
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</head>
<body>
<!-- navigation -->
<nav class="navbar navbar-inverse">
		<div class="container-fluid">
		<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		</button>
		<h4 class="navbar-text" style="color: #fff;">TBK-HACK-DEMO</h4>
		</div><!-- /navbar-header -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<?php menuActive();?>
			</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true" style="color:#fff;">
					<?php echo trim($_SESSION['username']);?>
					<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li id="changepw"><a href="userinfo.php">ユーザ情報</a></li>
						<li id="changepw"><a href="#">パスワード変更</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="logout.php">サインアウト</a></li>
					</ul>
				</li>
			</ul>
		</div><!-- /collapse navbar-collapse -->
	</div><!-- /container-fluid -->
</nav><!-- /nav -->