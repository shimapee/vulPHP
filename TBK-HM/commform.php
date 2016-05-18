<?php
session_start();
$_SESSION['menu'] = 2;
require_once 'dao.php';
$isbn = $_GET['isbn'];
$dao = new Dao();
$comBook = $dao->getCommBook($isbn);
foreach ($comBook as $book) {
	$isbn13 = $book['isbn13'];
	$bookname = $book['bookname'];
	$thumb = "<img src='http://images-jp.amazon.com/images/P/".$book['isbn10'].".09.THUMBZZZ'>";
}
?>
<?php include('header.php'); ?>
<!-- booklist -->
<div class="container-fluid">
<form class="form-horizontal" style="margin-top: 30px;" action="commins.php" method="post">
		<div class="form-group">
			<label class="col-md-3 col-md-offset-2 control-label">ISBN13</label>
			<div class="col-md-3">
				<input type="text" class="form-control" id="isbn13" value="<?php echo $isbn13; ?>" disabled >
				<input type="hidden" value="<?php echo $isbn13; ?>" name="isbn13">
			</div>
			<div class="col-md-offset-3"></div>
		</div>
		<div class="form-group">
			<label class="col-md-3 col-md-offset-2 control-label">書籍名</label>
			<div class="col-md-3">
				<input type="text" class="form-control" id="bookname" placeholder="<?php echo $bookname; ?>" name="bookname" disabled>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 col-md-offset-2 control-label">サムネイル</label>
			<div class="col-md-3">
				<?php echo $thumb;?>
			</div>
		</div>
		<div class="form-group">
			<label for="comment" class="col-md-3 col-md-offset-2 control-label">コメント</label>
			<div class="col-md-3">
				<textarea class="form-control" rows="5" name="comment" ></textarea>
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
</html>