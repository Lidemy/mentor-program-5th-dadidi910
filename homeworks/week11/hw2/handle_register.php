<?php
  // 啟用 Session 機制及引入外部檔案
  session_start();
  require_once("conn.php");

  // 判斷是否有輸入帳號密碼
  if (empty($_POST["username"])
    || empty($_POST["password"])) {
    header("Location: register.php?errorCode=1");
    die ("請確實輸入註冊帳號及密碼。");
  }

  // 取得輸入的帳號密碼
  $username = $_POST["username"];
  $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

  // 查詢資料庫並取結果
  $sql = "INSERT INTO didi_w11_hw2_users(username, password) VALUE(?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $username, $password);
  $result = $stmt->execute();

  // 判斷是否有拿到結果
  if (!$result) {
    $code = $conn->errno;
    if ($code === 1062) {
      header("Location: register.php?errorCode=2");
    }
    die ("Error:" . $conn->error);
  }

  $_SESSION["username"] = $username;
  header("Location: index.php");
?>