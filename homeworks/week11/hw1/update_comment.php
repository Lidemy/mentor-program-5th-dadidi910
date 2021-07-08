<?php
  session_start();
	require_once('conn.php');
	require_once('utils.php');

	$id = $_GET['id'];
	$username = NULL;
	$user = NULL;

	if (!empty($_SESSION['username'])) {
		$username = $_SESSION['username'];
		$user = getUserFromUsername($username);
	}

	$sql = "SELECT * FROM didi_w11_hw1_comments WHERE id = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('i', $id);
	$result = $stmt->execute();
	if (!$result) {
		die ('Error:' . $conn->error);
	}
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
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
			<a class="board__btn" href="login.php">登入</a>
		<?php } else { ?>
			<a class="board__btn" href="index.php">返回</a>
		<?php } ?>
		<h1 class="board__title">編輯留言</h1>
		<?php 
			if (!empty($_GET['errCode'])) {
				$code = $_GET['errCode'];
				$msg = 'Error';
				if ($code === '1') {
					$msg = '請確實輸入留言內容。';
				}
				echo('<h2 class="error">' . $msg . '</h2>');
			}
		?>
		<?php if ($username) { ?>
			<form class="board__new-comment-form" method="POST" action="handle_update_comment.php">
				<div class="board__content">
					<textarea name="content" rows="3" ><?php echo $row['content']; ?></textarea>
					<input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
					<!-- 透過隱藏的 input 將 id POST 到 handle_update_comment.php -->
					<input class="board__submit-btn" type="submit" value="送出" />
				</div>
			</form>
		<?php } ?>
	</main>
</body>
</html>