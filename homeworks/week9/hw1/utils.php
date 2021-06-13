<?php
	require_once('conn.php');

  function generateToken() {
    $s = '';
    for($i = 1; $i <= 16; $i++) {
      $s .= chr(rand(65, 90));
    }
    return $s;
  }

  // function getUserFromToken($token) {
    function getUserFromUsername($username) {
    global $conn;
    /*
      $sql = sprintf("select username from tokens where token = '%s'", $token);
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      $username = $row['username'];
    */

    $sql = sprintf("select * from didi_w9_users where username = '%s'", $username);
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row;
  }
?>