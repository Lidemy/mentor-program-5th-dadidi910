<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  if (empty($_POST['content'])) {
    header("Location: update_comment.php?errCode=1&id=".$_POST['id']);
    die ('請確實輸入留言內容。');
  }

  $username = $_SESSION['username'];
  $user = getUserFromUsername($username);
  $id = $_POST['id'];
  $content = $_POST['content'];

  
  if (isAdmin($user)) {
    $sql = "UPDATE didi_w11_hw1_comments SET content=? WHERE id=?";
  } else {
    $sql = "UPDATE didi_w11_hw1_comments SET content=? WHERE id=? AND username=?";
  }

  $stmt = $conn->prepare($sql);

  if (isAdmin($user)) {
    $stmt->bind_param('si', $content, $id);
  } else {
    $stmt->bind_param('sis', $content, $id, $username);
  }

  $result = $stmt->execute();
  
  if(!$result) {
    die ($conn->error);
  }

  header("Location: index.php");
?>