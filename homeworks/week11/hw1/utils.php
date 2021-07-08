<?php
	require_once('conn.php');

  function getUserFromUsername($username) {
  global $conn;

  $sql = sprintf("SELECT * FROM didi_w11_hw1_users WHERE username='%s'", $username);
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  return $row;
  }

  function escape($str) {
    return htmlspecialchars($str, ENT_QUOTES);
  }

  function hasPermission($user, $action, $comment) {
    if ($user['role'] === 'ADMIN') {
        return true;
    } else if ($user['role'] === 'NORMAL') {
      if ($action === 'create') {
        return true;
      }
      
      if ($comment['username'] === $user['username']) {
        return true;
      }
      return false;
    } else if (($user['role'] === 'BANNED') && ($comment['username'] === $user['username']) && ($action !== 'create')) {
      return true;
    }
    return false;
  }

  function isAdmin($user) {
    if ($user['role'] === 'ADMIN') {
      return true;
    }
  }
?>