<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  if (empty($_POST['content'])) {
    header("Location: index.php?errCode=1");
    die ('請確實輸入留言內容。');
  }

  $username = $_SESSION['username'];
  $user = getUserFromUsername($username);

  if (!hasPermission($user, 'create', NULL)) {
    header("Location: index.php");
    exit();
  }

  $content = $_POST['content'];
  $sql = "INSERT INTO didi_w11_hw1_comments(username, content) VALUES(?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ss', $username, $content);
  $result = $stmt->execute();
  if(!$result) {
    die ($conn->error);
  }

  header("Location: index.php");
?>