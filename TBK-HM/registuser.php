<?php include('header.php'); ?>
<!-- booklist -->
<div class="container-fluid">
	<div class="row">
	<div class="col-md-6 col-md-offset-3">
	<h2 style="text-align: center; border-bottom: 1px solid #5EBABA">ユーザ情報</h2>
	</div>
	<div class="col-md-offset-3"></div>
	</div>
	<form class="form-horizontal" style="margin-top: 30px;" action="userinfo_ins.php" method="post">
		<div class="form-group">
			<label for="inp-name" class="col-md-3 col-md-offset-2 control-label">名前</label>
			<div class="col-md-3">
				<input type="text" class="form-control" id="inp-name" name="name" value="<?php echo @$_POST['name'];?>">
			</div>
			<div class="col-md-offset-3"></div>
		</div>
		<div class="form-group">
			<label for="inp-mail" class="col-md-3 col-md-offset-2 control-label">メールアドレス</label>
			<div class="col-md-3">
				<input type="text" class="form-control" id="inp-mail" name="mail" value="<?php echo @$_POST['mail'];?>">
			</div>
		</div>
		<div class="form-group">
			<label for="inp-pass1" class="col-md-3 col-md-offset-2 control-label">パスワード</label>
			<div class="col-md-3">
				<input type="password" class="form-control" id="inp-pass1" name="pass1" value="<?php echo @$_POST['mail'];?>">
			</div>
		</div>
		<div class="form-group">
			<label for="inp-pass2" class="col-md-3 col-md-offset-2 control-label">パスワード確認</label>
			<div class="col-md-3">
				<input type="password" class="form-control" id="inp-pass2" name="pass2" value="<?php echo @$_POST['mail'];?>">
			</div>
		</div>
		<div class="form-group">
			<label for="inp-birth" class="col-md-3 col-md-offset-2 control-label">生年月日</label>
			<div class="col-md-3">
				<input type="text" class="form-control" id="inp-birth" name="birth" value=<?php echo @$_POST['birth'];?>>
			</div>
		</div>
		<div class="form-group">
			<label for="inp-address" class="col-md-3 col-md-offset-2 control-label">住所</label>
			<div class="col-md-3">
				<input type="text" class="form-control" id="inp-address" name="add" value=<?php echo @$_POST['add'];?>>
			</div>
		</div>



		<div class="form-group">
			<div class="col-sm-2 col-md-offset-7">
				<button type="submit" class="btn btn-success">登録</button>
			</div>
		</div>
	</form>
</div>

</body>