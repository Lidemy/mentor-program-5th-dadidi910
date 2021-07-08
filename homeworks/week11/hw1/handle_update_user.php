<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  if (empty($_POST['nickname'])) {
    header("Location: index.php?errCode1=1");
    die ('請確實輸入新暱稱。');
  }

  $username = $_SESSION['username'];
  $nickname = $_POST['nickname'];
  $sql = "UPDATE didi_w11_hw1_users SET nickname=? WHERE username=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ss', $nickname, $username);
  $result = $stmt->execute();
  if(!$result) {
    die ($conn->error);
  }

  header("Location: index.php");
?>