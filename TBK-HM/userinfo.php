<?php
session_start();
?>
<?php include('header.php'); ?>
<!-- booklist -->
<div class="container-fluid">
	<div class="row">
	<div class="col-md-6 col-md-offset-3">
	<h2 style="text-align: center; border-bottom: 1px solid #5EBABA">ユーザ情報</h2>
	</div>
	<div class="col-md-offset-3"></div>
	</div>
	<form class="form-horizontal" style="margin-top: 30px;" action="userinfo_upd.php" method="post">
		<div class="form-group">
			<label for="inputEmail3" class="col-md-3 col-md-offset-2 control-label">名前</label>
			<div class="col-md-3">
				<input type="text" class="form-control" id="inputEmail3" name="name" value=<?php echo trim($_SESSION['username']);?>>
			</div>
			<div class="col-md-offset-3"></div>
		</div>
		<div class="form-group">
			<label for="inputPassword3" class="col-md-3 col-md-offset-2 control-label">メールアドレス</label>
			<div class="col-md-3">
				<input type="text" class="form-control" id="inputPassword3" name="mail" value=<?php echo trim($_SESSION['mailadd']);?>>
			</div>
		</div>
		<div class="form-group">
			<label for="inputPassword3" class="col-md-3 col-md-offset-2 control-label">生年月日</label>
			<div class="col-md-3">
				<input type="text" class="form-control" id="inputPassword3" name="birth" value=<?php echo trim($_SESSION['birthday']);?>>
			</div>
		</div>
		<div class="form-group">
			<label for="inputPassword3" class="col-md-3 col-md-offset-2 control-label">住所</label>
			<div class="col-md-3">
				<input type="text" class="form-control" id="inputPassword3" name="add" value=<?php echo trim($_SESSION['address']);?>>
			</div>
		</div>



		<div class="form-group">
			<div class="col-sm-2 col-md-offset-7">
				<button type="submit" class="btn btn-success">更新</button>
			</div>
		</div>
	</form>
</div>

</body>