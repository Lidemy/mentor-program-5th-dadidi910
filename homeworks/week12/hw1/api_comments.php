<?php
  require_once("conn.php");
  header("Content-Type: application/json; charset=utf-8");
  header("Access-Control-Allow-Origin: *");

  // 檢查網址是否有帶 site_key
  if(empty($_GET["site_key"])) {
    $json = array(
      "ok" => false,
      "message" => "Please add site_key in url"
    );

    $response = json_encode($json);
    echo $response;
    die();
  }

  $site_key = $_GET["site_key"];
  $limit = $_GET["limit"];
  $offset = $_GET["offset"];

  // 取得 comments 數量
  $sql = 
    "SELECT 
      count(id) AS count 
    FROM 
      didi_w12_hw1_comments
    WHERE 
      site_key = ?";
  
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $site_key);
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
  $count = $row["count"];

  // 取得 comments
  $sql = 
    "SELECT 
      nickname, content, created_at 
    FROM 
      didi_w12_hw1_comments 
    WHERE  
      site_key = ? 
    ORDER BY 
      id 
    DESC
    LIMIT ? 
    OFFSET ?";
    
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sii", $site_key, $limit, $offset);
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
  $comments = array();
  while ($row = $result->fetch_assoc()) {
    array_push($comments, array(
      "nickname" => $row["nickname"],
      "content" => $row["content"],
      "created_at" => $row["created_at"]
    ));
  }

  $json = array(
    "ok" => true,
    "comments" => $comments,
    "count" => $count
  );

  $response = json_encode($json);
  echo $response;
?>