<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  $username = $_SESSION["username"];
  $title = $_POST["title"];
  $article = $_POST["article"];

  if (!$username) {
    header("Location: index.php");
    exit();
  }

  if (empty($title) || empty($article)) {
    header("Location: edit.php?errorCode=3");
    die ("請確實輸入文章標題與內容。");
  }
  
  $sql = "INSERT INTO didi_w11_hw2_articles(username, title, article) VALUE(?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sss", $username, $title, $article);
  $result = $stmt->execute();
  
  if (!$result) {
    die ("Error:" . $conn->error);
  }

  header("Location: blog.php");
?>