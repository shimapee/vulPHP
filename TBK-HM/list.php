<?php
session_start();
$_SESSION['menu'] = 0;
require_once 'dao.php';
$tg = $_GET['tg'];
$dao = new Dao();
$p = $dao->getListdata($_SESSION['user_id'], $tg);
?>
<?php include('header.php'); ?>
<!-- booklist -->
<div class="container-fluid">
	<table class="table">
		<thead>
			<tr>
				<td>No</td>
				<td>ISBN</td>
				<td colspan=2>書籍名</td>
				<td>著者</td>
				<td> 
				<div class="dropdown">
					<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						<?php 
							$btnname = "ジャンルを選択";
							foreach ($dao->getTagData() as $tags) {
								if($tg == $tags['tag_id']) {
									$btnname = $tags['tag_name'];
								}
							}
							echo $btnname;
						?>
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
						<?php 
							echo "<li><a href='list.php?tg=0'>すべて</a></li>";
							foreach ($dao->getTagData() as $tagitem) {
								echo "<li><a href='list.php?tg=".$tagitem['tag_id']."'>".$tagitem['tag_name']."</a></li>";
							}
						?>
					</ul>
				</div></td>
				<td>コメント</td>
			</tr>
		</thead>
		<tbody>
			<?php 
			$cnt = 1;
			foreach ($p as $books) {
				echo "<tr>";
				echo "<td>". $cnt . "</td>";
				echo "<td>". $books['isbn13'] . "</td>";
				echo "<td>". $books['bookname'] . "</td>";
				echo "<td><img src='http://images-jp.amazon.com/images/P/".$books['isbn10'].".09.THUMBZZZ'></td>";
				echo "<td>". $books['author'] . "</td>";
				echo "<td>". $books['tag'] . "</td>";
				echo "<td><a href='commform.php?isbn=". $books['isbn13'] . "'><button class='btn btn-success'>コメントする</button></a></td>";
				echo "</tr>";
				$cnt += 1;
			}
			?>
			
		</tbody>
	</table>
</div>

</body>
</html>