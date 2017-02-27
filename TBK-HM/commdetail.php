<?php
session_start();
$_SESSION['menu'] = 2;
require_once 'dao.php';
$isbn = $_GET['isbn'];
$dao = new Dao();
$p = $dao->getComment($isbn);
$comBook = $dao->getCommBook($isbn);
foreach ($comBook as $book) {
  $isbn13 = $book['isbn13'];
  $bookname = $book['bookname'];
  $thumb = "<img src='http://images-jp.amazon.com/images/P/".$book['isbn10'].".09.MZZZZZZZ'>";
}
$flg = true;
if($p == null) {
  $alert = "コメントはまだありません。";
  $flg = false;
}
?>
<?php include('header.php'); ?>
<div class="container-fluid">
<h3><?php echo $isbn13; ?></h3>
<h3><?php echo $bookname; ?></h3>
<?php echo $thumb;?>

</div>
<div  style="left:20px; position:absolute; width: 70%; ">
<hr style="color: #ddd; height: 1px; background-color:#ddd;" />
</div>
<div id="wrapper">

<?php
if($flg) {
  foreach ($p as $values) {
    echo "<div class=\"question_Box\">";
    echo "<p>". $values['user_name']."</p>";

    echo "<div class=\"question_image\"><img src=\"User.png\" alt=\"質問者の写真\"/></div>";
    echo "<div class=\"arrow_question\">";
    echo $values['comment'];
    echo "</div><!-- /.arrow_question -->";
    echo "</div><!-- /.question_Box -->";
    echo "<div style=\"clear: both;\"></div>";
  }
} else {
  echo "<h3>".$alert."</h3>";
}
?>

</div><!-- /#wrapper -->
