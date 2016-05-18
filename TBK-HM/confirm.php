<?php
session_start();
$isbn13 = $_GET['isbn13'];
$isbn10 = $_GET['isbn10'];
$bookname = $_GET['bookname'];
$author = $_GET['author'];
$thumb_lg = "http://images-jp.amazon.com/images/P/" . $isbn10 . ".09.LZZZZZZZ";
?>
<?php include('header.php'); ?>
<!-- booklist -->
<div class="container-fluid">
	<div class="row">
	<div class="col-md-6 col-md-offset-3">
	<h2 style="text-align: center; border-bottom: 1px solid #5EBABA">入力内容確認</h2>
	</div>
	<div class="col-md-offset-3"></div>
	</div>
	<div class="row">
	<div class="col-md-3 col-md-offset-3" style="text-align: right;">
	<h4>ISBN13:</h4>
	</div>
	<div class="col-md-3"><h4><?php echo $isbn13;?></h4></div>
	<div class="col-md-offset-3"></div>
	</div>
	<div class="row">
	<div class="col-md-3 col-md-offset-3" style="text-align: right;">
	<h4>ISBN10:</h4>
	</div>
	<div class="col-md-3"><h4><?php echo $isbn10;?></h4></div>
	</div>
	<div class="row">
	<div class="col-md-3 col-md-offset-3" style="text-align: right;">
	<h4>書籍名:</h4>
	</div>
	<div class="col-md-3"><h4><?php echo $bookname;?></h4></div>
	</div>
	<div class="row">
	<div class="col-md-3 col-md-offset-3" style="text-align: right;">
	<h4>著者名:</h4>
	</div>
	<div class="col-md-3"><h4><?php echo $author;?></h4></div>
	</div>
	<div class="row">
	<div class="col-md-3 col-md-offset-4" style="text-align: right;">
	<strong>サムネイル画像</strong>
	</div>
	</div>
	<div class="row">
	<div class="col-md-3 col-md-offset-5" style="text-align: right;">
		<img src=<?php echo $thumb_lg;?>>
	</div>
	</div>
	<form class="form-horizontal" style="margin-top: 30px;" action="register.php" method="get">
		<div class="form-group">
			<input type="hidden" name="isbn13" value=<?php echo $isbn13;?>>
			<input type="hidden"  name="isbn10" value=<?php echo $isbn10;?>>
			<input type="hidden"  name="bookname" value=<?php echo $bookname;?>>
			<input type="hidden"  name="author" value=<?php echo $author;?>>
			<div class="col-sm-2 col-md-offset-7">
				<button type="submit" class="btn btn-success">登録</button>
				<a href="input.php" class="btn btn-default">キャンセル</a>
			</div>
		</div>
	</form>

</div>

</body>
</html>