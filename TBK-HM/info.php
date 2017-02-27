<?php
  if (!isset($_COOKIE[session_name()])) {
    include('header_noses.php');
  } else {
    session_start();
    $_SESSION['menu'] = 3;
    include('header.php');
  }
  define('F_PATH', '/var/www/html/TBK-HM/');
  $info_file = $_GET["fn"];
 ?>
<div class="container-fluid">
  <div class="row">
  <div class="col-md-6 col-md-offset-3">
  <h2 style="text-align: center; border-bottom: 1px solid #5EBABA">お知らせ</h2>
  </div>
  <div class="col-md-offset-3"></div>
  </div>
  <div style="text-align: center">
  <?php
  if($info_file == null) {
    echo "<a href='info.php?fn=syazai.html'>不正アクセスによるお客様情報流出に関するお知らせについて</a>";
  } else {
    readfile(F_PATH . $info_file);
  }
  ?>
  </div>
</div>

</body>
</html>
