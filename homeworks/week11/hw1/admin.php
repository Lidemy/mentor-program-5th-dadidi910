<?php
  session_start();
	require_once('conn.php');
	require_once('utils.php');

	$username = NULL;
	$user = NULL;

	if (!empty($_SESSION['username'])) {
		$username = $_SESSION['username'];
		$user = getUserFromUsername($username);
	}

	if ($user === NULL || $user['role'] !== 'ADMIN') {
		header("Location: index.php");
		exit();
	}

	$sql = "SELECT id, role, nickname, username FROM didi_w11_hw1_users ORDER BY id ASC";
	$stmt = $conn->prepare($sql);
	$result = $stmt->execute();
	if (!$result) {
		die ('Error:' . $conn->error);
	}
	$result = $stmt->get_result();
?>

<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">

  <title>Practice - 留言板</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css" />
  <link rel="stylesheet" href="style.css" />
</head>
<body>
	<header class="warning">
		注意！本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼。
	</header>
	<main class="board">
		<?php if (!$username) { ?>
			<a class="board__btn" href="register.php">註冊</a>
			<a class="board__btn" href="login.php">登入</a>
		<?php } else { ?>
			<a class="board__btn" href="index.php">返回前台</a>
			<a class="board__btn" href="logout.php">登出</a>
			<h3 class="board__username">Hi! 
				<?php echo $user['nickname'] ?> 
			</h3>
		<?php } ?>
		<h1 class="board__title">後台權限管理</h1>
		<section>
			<table>
				<tr>
					<th>ID</th>
					<th>Role</th>
					<th>Nickname</th>
					<th>Username</th>
					<th>Edit permissions</th>
				</tr>
			<?php while ($row = $result->fetch_assoc()) { ?>
				<tr>
					<td><?php echo escape($row['id']); ?></td>
					<td><?php echo escape($row['role']); ?></td>
					<td><?php echo escape($row['nickname']); ?></td>
					<td><?php echo escape($row['username']); ?></td>
					<td>
						<div class="edit_permission">
							<form method="post" action="handle_update_role.php">
								<select name="role">
									<option value="ADMIN" <?php echo escape($row['role']) === "ADMIN" ? "selected" : "" ?>>ADMIN</option>
									<option value="NORMAL" <?php echo escape($row['role']) === "NORMAL" ? "selected" : "" ?>>NORMAL</option>
									<option value="BANNED" <?php echo escape($row['role']) === "BANNED" ? "selected" : "" ?>>BANNED</option>
								</select>
								<input type="hidden" name="id" value="<?php echo escape($row['id']) ?>" />
								<button type="submit" class="update_role" >儲存</button>
							</form>
						</div>
					</td>
				</tr>
			<?php } ?>
			</table>
		</section>
		<div class="board__hr"></div>
	</main>
</body>
</html>