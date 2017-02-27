<?php
  if (!isset($_COOKIE[session_name()])) {
    include('header_noses.php');
  } else {
    session_start();
    $_SESSION['menu'] = 4;
    include('header.php');
  }
 ?>
 <div class="container-fluid">
   <div class="row">
   <div class="col-md-6 col-md-offset-3">
   <h2 style="text-align: center; border-bottom: 1px solid #5EBABA">お問い合わせ</h2>
   </div>
   <div class="col-md-offset-3"></div>
   </div>
   <div style="text-align:center;">
   <p>ご質問等ありましたら、下記フォームからお問い合わせください。</p>
   <p>追って弊社担当より、お返事させていただきます。</p>
   <form class="form-horizontal" action="mailsend.php" method="post">
     <div class="form-group">
       <label for="inputname" class="col-sm-4 control-label">お名前</label>
       <div class="col-sm-5">
         <input type="text" class="form-control" id="inputname" placeholder="お名前">
       </div>
     </div>
     <div class="form-group">
       <label for="inputEmail" class="col-sm-4 control-label">メールアドレス</label>
       <div class="col-sm-5">
         <input type="text" class="form-control" id="inputEmail" placeholder="メール" name="mailadd">
       </div>
     </div>
     <div class="form-group">
       <label for="inputEmail" class="col-sm-4 control-label">お問い合わせ内容</label>
       <div class="col-sm-5">
         <textarea class="form-control" rows="5"></textarea>
       </div>
     </div>
     <button type="submit" class="btn btn-success">送信</button>
   </form>
 </div>
 </div>

 </body>
 </html>
