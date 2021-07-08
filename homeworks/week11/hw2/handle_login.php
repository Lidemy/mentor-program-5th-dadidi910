<?php
  // 啟用 Session 機制及引入外部檔案
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  // 判斷是否有輸入帳號密碼
  if (empty($_POST["username"])
    || empty($_POST["password"])) {
    header("Location: login.php?errorCode=1");
    die ("請確實輸入登入帳號及密碼。");
  }

  // 取得輸入的帳號密碼
  $username = $_POST["username"];
  $password = $_POST["password"];

  // 查詢資料庫並取結果
  $sql = "SELECT * FROM didi_w11_hw2_users where username=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $username);
  $result = $stmt->execute();

  // 判斷是否有拿到結果
  if (!$result) {
    die ("Error:" . $conn->error);
  }

  // 取回結果
  $result = $stmt->get_result();
  
  // 判斷取到的結果是否有符合結果中的行數內容
  if ($result->num_rows === 0) {
    header("Location: login.php?errorCode=2");
    die ("帳號或密碼輸入有誤，請重新輸入。");
  }

  // 有拿到符合結果中的行數內容
  $row = $result->fetch_assoc();

  // 使用內建 hash 判斷取到的密碼是否一致
  if (password_verify($password, $row["password"])) {
    $_SESSION["username"] = $username;
    header("Location: index.php");
  } else {
    header("Location: login.php?errorCode=2");
  }
?>