<?php
  session_start();
	require_once('conn.php');
	require_once('utils.php');

	/*
		$username = NULL;
		if (!empty($_COOKIE['token'])) {
			$user = getUserFromToken($_COOKIE['token']);
			$username = $user['username'];
		}
	*/

	/*
		1. 從 cookie 裡面讀取 PHPSESSID (token)
		2. 從檔案裡面讀取 session id 的內容
		3. 放到 $_SESSION
	*/
	$username = NULL;
	if (!empty($_SESSION['username'])) {
		$username = $_SESSION['username'];
	}

	$result = $conn->query('select * from didi_w9_comments order by id desc');
	if (!$result) {
		die ('Error:' . $conn->error);
	}
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
		<a class="board__btn" href="logout.php">登出</a>
		<h3 class="board__username">Hi! <?php echo $username?></h3>
		<?php } ?>
		<h1 class="board__title">Comments</h1>
		<?php 
			if (!empty($_GET['errCode'])) {
				$code = $_GET['errCode'];
				$msg = 'Error';
				if ($code === '1') {
					$msg = '請確實輸入暱稱及留言內容。';
				}
				echo('<h2 class="error">' . $msg . '</h2>');
			}
		?>
		<?php if ($username) { ?>
		<form class="board__new-comment-form" method="POST" action="handle_add_comment.php">
			<div class="board__content">
				<textarea name="content" rows="3" placeholder="留下您想說的話..."></textarea>
				<input class="board__submit-btn" type="submit" value="送出"/>
			</div>
		</form>
		<?php } else { ?>
			<h3>欲留言需先註冊登入唷！</h3>
		<?php } ?>
		<div class="board__hr"></div>
		<section>
			<?php
				while ($row = $result->fetch_assoc()) {
			?>
			<div class="card">
				<div class="card__avatar"></div>
				<div class="card__body">
					<div class="card__info">
						<span class="card__author">
							<?php echo $row['nickname']; ?>
						</span>
						<span class="card__time">
							<?php echo $row['created_at']; ?>
						</span>
					</div>
					<p class="card__content"><?php echo $row['content']; ?></p>
				</div>
			</div>
			<?php
				}
			?>
		</section>
	</main>
</body>
</html>