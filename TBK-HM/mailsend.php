<?php
  if (!isset($_COOKIE[session_name()])) {
    include('header_noses.php');
  } else {
    $_SESSION['menu'] = 4;
    include('header.php');
  }
  $mailadd = $_POST['mailadd'];
  system("sendmail -i < mailtemp.txt $mailadd");
 ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <h2 style="text-align: center; border-bottom: 1px solid #5EBABA">お問い合わせ</h2>
    </div>
    <div class="col-md-offset-3"></div>
  </div>
  <div style="text-align: center">
    <p>お問い合わせを受け付けました。</p>
  </div>
