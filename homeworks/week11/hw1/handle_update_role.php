<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  $username = $_SESSION['username'];
  $user = getUserFromUsername($username);

	if ($user === NULL || $user['role'] !== 'ADMIN') {
		header("Location: index.php");
		exit();
	}

  $role = $_POST['role'];
  $id = $_POST['id'];

  $sql = "UPDATE didi_w11_hw1_users SET role=? WHERE id=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('si', $role, $id);
  $result = $stmt->execute();
  if(!$result) {
    die ("Error:" . $conn->error);
  }

  header("Location: admin.php");
?>