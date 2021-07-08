<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  if (empty($_GET['id'])) {
    header("Location: index.php?errCode=1)");
    die ();
  }

  $username = $_SESSION['username'];
  $user = getUserFromUsername($username);
  $id = $_GET['id'];

  if (isAdmin($user)) {
    $sql = "UPDATE didi_w11_hw1_comments SET is_deleted=1 WHERE id=?";
  } else {
    $sql = "UPDATE didi_w11_hw1_comments SET is_deleted=1 WHERE id=? AND username=?";
  }

  $stmt = $conn->prepare($sql);

  if (isAdmin($user)) {
    $stmt->bind_param('i', $id);
  } else {
    $stmt->bind_param('is', $id, $username);
  }

  $result = $stmt->execute();
  
  if(!$result) {
    die ($conn->error);
  }

  header("Location: index.php");
?>