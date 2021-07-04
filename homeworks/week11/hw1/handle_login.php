<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  if (empty($_POST['username']) 
    || empty($_POST['password'])) {
    header("Location: login.php?errCode=1");
    die ('請確實輸入帳號及密碼');
  }

  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM didi_w11_hw1_users WHERE username=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $username);
  $result = $stmt->execute();
  if(!$result) {
    die ($conn->error);
  }

  // 把結果拿回來
  $result = $stmt->get_result();

  // 使用者為空的話
  if ($result->num_rows === 0) {
    header("Location: login.php?errCode=2");
    exit(); // 讓底下程式碼都不會被執行
  }

  // 有查到使用者
  $row = $result->fetch_assoc();
  if (password_verify($password, $row['password'])) {
    $_SESSION['username'] = $username;
    header("Location: index.php");
  } else {
    header("Location: login.php?errCode=2");
  }
?>