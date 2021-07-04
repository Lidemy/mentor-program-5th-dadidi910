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

	$page = 1;
	if (!empty($_GET['page'])) {
		$page = intval($_GET['page']);
	}
	$items_per_page = 5;
	$offset = ($page - 1) * $items_per_page;

	$sql = 
		"SELECT 
			C.id AS id, 
			C.content AS content, 
			C.created_at AS created_at, 
			U.nickname AS nickname, 
			U.username AS username 
		FROM 
			didi_w11_hw1_comments AS C 
		LEFT JOIN 
			didi_w11_hw1_users AS U 
		ON 
			C.username = U.username 
		WHERE 
			C.is_deleted IS NULL 
		ORDER BY C.id DESC 
		LIMIT 
			? 
		OFFSET 
			?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('ii', $items_per_page, $offset);
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
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css" />
	<title>Practice - 留言板</title>
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
			<?php if ($user && $user['role'] === 'ADMIN') { ?>
				<a class="board__btn" href="admin.php">管理後台</a>
			<?php } ?>
			<a class="board__btn" href="logout.php">登出</a>	
			<h3 class="board__username">Hi! 
				<?php echo escape($user['nickname']) ?> 
					<span class="update-nickname">編輯暱稱</span>
				<?php 
					if (!empty($_GET['errCode1'])) {
						$code = $_GET['errCode1'];
						$msg = 'Error';
						if ($code === '1') {
							$msg = '請確實輸入新暱稱。';
						}
						echo('<h2 class="error">' . $msg . '</h2>');
					}
				?>
			</h3>
			<form class="hide board__nickname-form board__username" method="POST" action="handle_update_user.php">
				新的暱稱：<input type="text" name="nickname" class="board__new-nickname" />
				<input type="submit" class="board__submit-btn" value="修改" />
			</form>
		<?php } ?>
		<h1 class="board__title">Comments</h1>
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
		<?php if ($username && !hasPermission($user, 'create', NULL)) { ?>
			<h3 class="login_hint">您已經被停權了，因此無法新增留言唷ˋˊ！（只能編輯/刪除現有的留言）</h3>
		<?php } else if ($username) { ?>
			<form class="board__new-comment-form" method="POST" action="handle_add_comment.php">
				<div class="board__content">
					<textarea name="content" rows="3" placeholder="留下您想說的話..."></textarea>
					<input class="board__submit-btn" type="submit" value="送出"/>
				</div>
			</form>
		<?php } else { ?>
			<h3 class="login_hint">欲留言需先註冊登入唷！</h3>
		<?php } ?>
		<div class="board__hr"></div>
		<section>
			<?php while ($row = $result->fetch_assoc()) { ?>
				<div class="card">
					<div class="card__avatar"></div>
					<div class="card__body">
						<div class="card__info">
							<span class="card__author">
								<?php echo escape($row['nickname']); ?> (@<?php echo escape($row['username']); ?>)
							</span>
							<span class="card__time">
								<?php echo escape($row['created_at']); ?>
							</span>
							<?php if (hasPermission($user, 'update', $row)) { ?>
								<a class="update-comment" href="update_comment.php?id=<?php echo escape($row['id']) ?>">編輯留言</a>
							<?php } ?>
							<?php if (hasPermission($user, 'delete', $row)) { ?>
								<a class="delete-comment" href="handle_delete_comment.php?id=<?php echo escape($row['id']) ?>">刪除留言</a>
							<?php } ?>
						</div>
						<p class="card__content"><?php echo escape($row['content']); ?></p>
					</div>
				</div>
			<?php	} ?>
		</section>
		<div class="board__hr"></div>
		<?php
			$sql = "SELECT count(id) AS count FROM didi_w11_hw1_comments WHERE is_deleted IS NULL";
			$stmt = $conn->prepare($sql);
			$result = $stmt->execute();
			$result = $stmt->get_result();
			$row = $result->fetch_assoc();
			$count = $row['count'];
			$total_page = ceil($count / $items_per_page);
		?>
		<div class="paginator">
			<?php if ($page != 1) { ?>
				<a href="index.php?page=1"><<</a>
				<a href="index.php?page=<?php echo $page - 1?>"><</a>
			<?php } ?>
			<?php if ($page != $total_page) { ?>		
				<a href="index.php?page=<?php echo $page + 1?>">></a>			
				<a href="index.php?page=<?php echo $total_page ?>">>></a>
			<?php } ?>
		</div>
		<div class="page__info">
			<span>總共有 <?php echo $count ?> 留言，頁數：</span>
			<span><?php echo $page ?> / <?php echo $total_page ?> 頁</span>
		</div>
	</main>
	<script>
		var btn = document.querySelector('.update-nickname')
		btn.addEventListener('click', function(){
			var form = document.querySelector('.board__nickname-form')
			form.classList.toggle('hide')
		})
	</script>
</body>
</html>