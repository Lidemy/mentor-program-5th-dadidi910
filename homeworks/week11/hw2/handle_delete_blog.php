<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  $username = $_SESSION["username"];
  $id = $_GET["id"];

  if (!$username) {
    header("Location: index.php");
    exit();
  }

  $sql = "UPDATE didi_w11_hw2_articles SET is_deleted=1 WHERE id=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $result = $stmt->execute();

  if (!$result) {
    die ("Error:" . $conn->error);
  }
  
  header("Location: admin.php");
  ?>