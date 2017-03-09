<?php
class Dao {
  private $pdo;
  /*
   * コンストラクタ
   *   PDO設定
   */
  function __construct() {
    $dbconn = 'mysql:host=localhost;dbname=tbkhack_demo;charset=utf8';
    $dbuser = 'tbkhack';
    $dbpass = 'tbkhack2016';
    $this->pdo = new PDO($dbconn, $dbuser, $dbpass);
    $this->pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //$this->pdo -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  }

  /*
   * 書籍一覧取得SQL
   */
  function getListdata($user, $tag_id) {
    if($tag_id == 0) {
      $sql = "select isbn13, isbn10, bookname, author from book where user_id = ".$user;
    } else {
      $sql = "select b.isbn13, b.isbn10, b.bookname, b.author from book b
          inner join booktag bt on b.user_id = bt.user_id and b.isbn13 = bt.isbn13
          where b.user_id = ".$user ." and bt.tag_id = ".$tag_id;
    }
    $listArray = array();
    foreach ($this->pdo->query($sql)->fetchAll() as $list) {
      $tagsql = "select t.tag_id, t.tag_name from tag t
          inner join booktag bt on t.tag_id = bt.tag_id where bt.user_id =".$user .
          " and bt.isbn13 = '" . $list['isbn13'] . "'";
      $tagname = "";
      foreach ($this->pdo->query($tagsql)->fetchAll() as $tags) {
        $tagname .= $tags['tag_name']. ",";
      }
      $array = array(
          "isbn13" => $list['isbn13'],
          "isbn10" => $list['isbn10'],
          "bookname" => $list['bookname'],
          "author" => $list['author'],
          "tag" => $tagname
          );
      array_push($listArray, $array);
    }
    return $listArray;
  }

  /*
   * 書籍登録SQL
   *   重複チェックあり
   */
  function registerData($data) {
    $chksql = "select count(*) as cnt from book where user_id = ".$data['user_id']." and isbn13 = '".$data['isbn13']."'";
    $chk = $this->pdo->query($chksql)->fetchColumn();
    if($chk == 0) {
      $sql = "insert into book (user_id, isbn13, isbn10, bookname, author)
        values (".$data['user_id'].","
            ."'".$data['isbn13']."',"
            ."'".$data['isbn10']."',"
            ."'".$data['bookname']."',"
            ."'".$data['author']."'"
              .")";
      $ins = $this->pdo->exec($sql);
      if($ins == 1) return "登録しました";
    } else {
      return "既に登録されています。";
    }
  }

  /*
   * ログイン認証SQL
   */
  function isAuth($uid, $pass) {
    $sql = "select count(*) from password where user_id = " . $uid ." and password = '" . $pass ."'";
    $passchk = $this->pdo->query($sql)->fetchColumn();
    if($passchk > 0) {
      return true;
    } else {
      return false;
    }
  }

  /*
   * ユーザ情報取得SQL
   */
  function getUserDate($uid) {
    $sql = "
    select
      user_id,
      user_email,
      user_name,
      date_format(user_birthday,'%Y/%m/%d') as user_birthday,
      user_address,
      user_img
    from user
    where user_id = " . $uid;
    return $this->pdo->query($sql)->fetchAll();
  }

  /*
   * ジャンル取得SQL
   */
  function getTagData() {
    $sql = "select tag_id, tag_name from tag";
    return $this->pdo->query($sql)->fetchAll();
  }

  /*
   * コメント対象書籍取得SQL
   */
  function getCommBook($isbn) {
    $sql = "select distinct isbn13, isbn10, bookname, author from book where isbn13='".$isbn."'";
    return $this->pdo->query($sql)->fetchAll();
  }

  /*
   * コメント閲覧書籍一覧取得SQL
   */
  function getCommBookList() {
    $sql = "select distinct isbn13, isbn10, bookname, author from book";
    return $this->pdo->query($sql)->fetchAll();
  }

  /*
   * 書籍コメント取得SQL
   */
  function getComment($isbn13) {
    $sql = "select u.user_name, u.user_img, c.comment from comment c inner join user u on c.comm_user_id = u.user_id
        where c.isbn13 = '".$isbn13."'";
    return $this->pdo->query($sql)->fetchAll();
  }

  /*
   * コメント登録SQL
   */
  function registerComment($data) {
    $sql = "insert into comment (isbn13, comm_user_id, comment)
        values ("."'".$data['isbn13']."',"
            ."'".$data['user_id']."',"
            ."'".$data['comment']."'"
              .")";
      $ins = $this->pdo->exec($sql);
      if($ins == 1) return "登録しました";
  }

  function __destruct() {
    $this->pdo = null;
  }

  /* ユーザ情報更新 */
  function registerUserInfo($data) {
    $sql = "update user set
          user_email = '". $data['mail'] ."',
          user_name = '". $data['name'] ."',
          user_birthday = '". $data['birth'] ."',
          user_address = '". $data['add'] ."',
          user_img = '". $data["image"]."'
          where user_id = ". $data['uid'];
    return $this->pdo->exec($sql);

  }

  function inputUserInfo($data) {
    $chksql = "select count(*) as cnt from user where user_email = '".$data['mail']."'" ;
    $chk = $this->pdo->query($chksql)->fetchColumn();
    if($chk == 0) {
      $num = "select max(user_id)+1 from user";
      $maxNo = $this->pdo->query($num)->fetchColumn();
      $sql = "insert into user (user_id, user_email, user_name, user_birthday, user_address)
        values (".$maxNo.","
            ."'".$data['mail']."',"
            ."'".$data['name']."',"
            ."'".$data['birth']."',"
            ."'".$data['add']."'"
              .")";
      $ins = $this->pdo->exec($sql);
      $inspass = "insert into password (user_id, password) values (". $maxNo .",'".$data['pass1']."')";
      $ins = $this->pdo->exec($inspass);
      if($ins == 1) return "登録しました";
    } else {
      return "既に登録されています。";
    }
  }
}
