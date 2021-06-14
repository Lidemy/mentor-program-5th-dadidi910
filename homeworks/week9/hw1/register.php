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
		<a class="board__btn" href="index.php">回留言板</a>
		<a class="board__btn" href="login.php">登入</a>
		<h1 class="board__title">註冊</h1>
		<?php 
			if (!empty($_GET['errCode'])) {
				$code = $_GET['errCode'];
				$msg = 'Error';
				if ($code === '1') {
					$msg = '請確實輸入註冊內容。';
				} else if ($code === '2') {
					$msg = '帳號已被註冊。';
				}
				echo('<h2 class="error">' . $msg . '</h2>');
			}
		?>
		<form class="board__new-comment-form" method="POST" action="handle_register.php">
			<div class="board__nickname">
				<span>暱稱：</span>
				<input type="text" name="nickname" />
			</div>
			<div class="board__nickname">
				<span>帳號：</span>
				<input type="text" name="username" />
			</div>
			<div class="board__nickname">
				<span>密碼：</span>
				<input type="password" name="password" />
			</div>
			<input class="board__register-submit-btn" type="submit" value="註冊"/>
		</form>
	</main>
</body>
</html>