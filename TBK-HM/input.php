<?php
session_start();
$_SESSION['menu'] = 1;
?>
<?php include('header.php'); ?>

<!-- booklist -->
<div class="container-fluid">
  <div class="row">
  <div class="col-md-6 col-md-offset-3">
  <h2 style="text-align: center; border-bottom: 1px solid #5EBABA">書籍情報入力</h2>
  </div>
  <div class="col-md-offset-3"></div>
  </div>
  <form class="form-horizontal" style="margin-top: 30px;" action="confirm.php" method="post">
    <div class="form-group">
      <label for="isbn13" class="col-md-3 col-md-offset-2 control-label">ISBN13</label>
      <div class="col-md-3">
        <input type="text" class="form-control" id="isbn13" placeholder="ISBN13を入力してください。" name="isbn13">
      </div>
      <div class="col-md-offset-3"></div>
    </div>
    <div class="form-group">
      <label for="isbn10" class="col-md-3 col-md-offset-2 control-label">ISBN10</label>
      <div class="col-md-3">
        <input type="text" class="form-control" id="isbn10" placeholder="ISBN10を入力してください。" name="isbn10">
      </div>
    </div>
    <div class="form-group">
      <label for="bookname" class="col-md-3 col-md-offset-2 control-label">書籍名</label>
      <div class="col-md-3">
        <input type="text" class="form-control" id="bookname" placeholder="書籍名を入力してください。" name="bookname">
      </div>
    </div>
        <div class="form-group">
      <label for="author" class="col-md-3 col-md-offset-2 control-label">著者名</label>
      <div class="col-md-3">
        <input type="text" class="form-control" id="author" placeholder="著者名を入力してください。" name="author">
      </div>
    </div>
    <hr>


    <div class="form-group">
      <div class="col-sm-2 col-md-offset-7">
        <button type="submit" class="btn btn-success">登録</button>
      </div>
    </div>
  </form>
</div>
<script>
$("#isbn13").on("focusout", function {
  var tmp = checkCommon.escapeHtml($("#isbn13").val());
  $("#isbn13").val(tmp);
});
$("#isbn10").on("focusout", function {
  var tmp = checkCommon.escapeHtml($("#isbn10").val());
  $("#isbn10").val(tmp);
});
$("#bookname").on("focusout", function {
  var tmp = checkCommon.escapeHtml($("#bookname").val());
  $("#bookname").val(tmp);
});
$("#author").on("focusout", function {
  var tmp = checkCommon.escapeHtml($("#author").val());
  $("#author").val(tmp);
});
</script>
</body>
</html>
