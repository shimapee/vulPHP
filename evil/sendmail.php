<?php
$p = $_GET['p'];
// メールアドレスは自分のに
mail("hogehoge@tbkobenkyo.com", "info mail", $p);
header('Location: http://192.168.33.10/TBK-HM/commform.php?isbn=978-4062192026');
