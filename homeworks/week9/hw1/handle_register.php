<?php
  require_once('conn.php');
  if (empty($_POST['nickname']) 
    || empty($_POST['username']) 
    || empty($_POST['password'])) {
    header("Location: register.php?errCode=1");
    die ();
  }

  $nickname = $_POST['nickname'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = sprintf(
    "insert into didi_w9_users(nickname, username, password) values('%s', '%s', '%s')",
    $nickname,
    $username,
    $password
  );
  $result = $conn->query($sql);
  if(!$result) {
    $code = $conn->errno;
    if ($code === 1062) {
      header("Location: register.php?errCode=2");
    }
    die ($conn->error);
  }
  header("Location: index.php")
?>