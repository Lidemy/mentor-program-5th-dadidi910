<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  if (empty($_POST['username']) 
    || empty($_POST['password'])) {
    header("Location: login.php?errCode=1");
    die ();
  }

  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = sprintf(
    "select * from didi_w9_users where username='%s' and password='%s'",
    $username,
    $password
  );
  $result = $conn->query($sql);
  if(!$result) {
    die ($conn->error);
  }
  if ($result->num_rows) {
    /*
      建立 token 並儲存
      $token = generateToken();
      $sql = sprintf("insert into tokens(token, username) values('%s', '%s')",$token , $username);
      $result = $conn->query($sql);
      if(!$result) {
        die ($conn->error);
      }
    */

    /*
      登入成功
      $expire = time() + 3600 * 24 * 30;
      setcookie("token", $token, $expire);
    */

    /*
      1. 產生 session id (token)
      2. 把 username 寫入檔案
      3. set-cookie: session-id
    */

    $_SESSION['username'] = $username;
    header("Location: index.php");
  } else {
    header("Location: login.php?errCode=2");
  }
?>