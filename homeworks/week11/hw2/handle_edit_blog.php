<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  $username = $_SESSION["username"];

  if (empty($_POST["title"]) || empty($_POST["article"])) {
    header("Location: edit_blog.php?errorCode=3&id=".$_POST["id"]);
    die ("請確實輸入文章標題與內容。");
  }

  $id = $_POST["id"];
  $title = $_POST["title"];
  $article = $_POST["article"];

  $sql = "UPDATE didi_w11_hw2_articles SET title=?, article=? WHERE id=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssi", $title, $article, $id);
  $result = $stmt->execute();
  
  if (!$result) {
    die ("Error:" . $conn->error);
  }

  header("Location: blog.php?id=".$_POST["id"]);
?>