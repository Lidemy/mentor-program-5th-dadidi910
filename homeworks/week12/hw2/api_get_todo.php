<?php
  require_once("conn.php");
  header("Content-Type: application/json; charset=utf-8");
  header("Access-Control-Allow-Origin: *");

  // 檢查網址是否有帶 id
  if(empty($_GET["id"])) {
    $json = array(
      "ok" => false,
      "message" => "Please add id in url"
    );

    $response = json_encode($json);
    echo $response;
    die();
  }

  $id = intval($_GET["id"]);

  // 取得 todos
  $sql = 
    "SELECT 
      id, todo
    FROM 
      didi_w12_hw2_todos
    WHERE  
      id = ?";
    
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $result = $stmt->execute();
  
  if(!$result) {
    $json = array(
      "ok" => false,
      "message" => "Failed!"
    );
    $response = json_encode($json);
    echo $response;
    die();
  }

  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $json = array(
    "ok" => true,
    "data" => array(
    "id" => $row["id"],
    "todo" => $row["todo"]
    )
  );

  $response = json_encode($json);
  echo $response;
?>