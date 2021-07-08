<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  $username = NULL;

  if (!empty($_SESSION["username"])) {
    $username = $_SESSION["username"];
  }

  if (empty($_GET["id"])) {
    header("Location: index.php");
    exit();
  }

  $id = $_GET["id"];

  $sql = "SELECT * FROM didi_w11_hw2_articles WHERE id=? AND is_deleted IS NULL";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $result = $stmt->execute();

  if (!$result) {
    die ("Error:" . $conn->error);
  }

  $result = $stmt->get_result();

  if (!$result->num_rows) {
    header("Location: index.php");
    exit();
  }
?>

<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Practice - 部落格</title>
  <link rel="stylesheet" href="normalize.css" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <nav class="navbar">
    <div class="wrapper navbar__wrapper">
      <div class="navbar__site-name">
        <a href='index.php'>Didi's Blog</a>
      </div>
      <ul class="navbar__list">
        <div>
          <li><a href="#">文章列表</a></li>
          <li><a href="#">分類專區</a></li>
          <li><a href="#">關於我</a></li>
        </div>
        <div>
          <?php if ($username) { ?>
            <li><a href="admin.php">管理後台</a></li>
            <li><a href="logout.php">登出</a></li>
          <?php } else { ?>
            <li><a href="login.php">登入</a></li>
          <?php }?>
        </div>
      </ul>
    </div>
  </nav>
  <section class="banner">
    <div class="banner__wrapper">
      <h1>存放技術之地</h1>
      <div>Welcome to my blog</div>
    </div>
  </section>
  <div class="container-wrapper">
    <div class="posts">
      <?php while ($row = $result->fetch_assoc()) { ?>
        <article class="post">
          <div class="post__header">
            <div><?php echo escape($row["title"]) ?></div>
            <div class="post__actions">
              <?php if ($username) { ?>
                <a class="post__action" href="edit_blog.php?id=<?php echo escape($row["id"])?>">編輯</a>
              <a class="post__action" href="handle_delete_blog.php?id=<?php echo escape($row["id"])?>">刪除</a>
              <?php }?>
            </div>
          </div>
          <div class="post__info">
            <?php echo escape($row["created_at"])?>
          </div>
          <div class="post__content">
            <?php echo escape($row["article"])?>
          </div>
        </article>
      <?php } ?>
    </div>
  </div>
  <footer>Copyright © 2021-<?php echo date("Y");?> Didi's Blog All Rights Reserved.</footer>
</body>
</html>