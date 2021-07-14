<?php
  require_once("conn.php");
  header("Content-Type: application/json; charset=utf-8");
  header("Access-Control-Allow-Origin: *");

  // 檢查是否有輸入
  if(
    empty($_POST["todo"])
  ) {
    $json = array(
      "ok" => false,
      "message" => "Please input missing fields"
    );

    $response = json_encode($json);
    echo $response;
    die();
  }

  $todo = $_POST["todo"];

  // 新增 comments
  $sql = 
  "INSERT INTO 
    didi_w12_hw2_todos(todo) 
  VALUE
    (?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $todo);
  $result = $stmt->execute();
  if(!$result) {
    $json = array(
      "ok" => false,
      "message" => $conn->error
    );

    $response = json_encode($json);
    echo $response;
    die();
  }

  $json = array(
    "ok" => true,
    "message" => "Success",
    "id" => $conn->insert_id
  );
  $response = json_encode($json);
  echo $response;
?>