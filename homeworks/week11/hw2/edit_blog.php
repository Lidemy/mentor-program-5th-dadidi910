<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  $username = $_SESSION["username"];

  if (!$username || empty($_GET["id"])) {
    header("Location: index.php");
    exit();
  }

  $id = $_GET["id"];

  $sql = "SELECT * FROM didi_w11_hw2_articles WHERE id=?";
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
    <div class="container">
      <?php while ($row = $result->fetch_assoc()) {?>
        <div class="edit-post">
          <form action="handle_edit_blog.php?id=<?php echo escape($row["id"])?>" method="POST">
            <div class="edit-post__title">
              發表文章：
            </div>
            <?php
              if (!empty($_GET["errorCode"])) {
                $errorCode = $_GET["errorCode"];
                $msg = "Error";
                if ($errorCode === "3") {
                  $msg = "請確實輸入文章標題與內容。";
                }
                echo ('<p class="error">' . $msg . '</p>');
              }
            ?>
            <div class="edit-post__input-wrapper">
              <input name="title" class="edit-post__input" placeholder="請輸入文章標題" value="<?php echo escape($row["title"]) ?>" />
            </div>
            <div class="edit-post__input-wrapper">
              <textarea name="article" rows="20" class="edit-post__content"><?php echo escape($row["article"]) ?></textarea>
            </div>
            <div class="edit-post__btn-wrapper">
              <input type="hidden" name="id" value="<?php echo escape($row["id"]) ?>" />
              <button type="submit" class="edit-post__btn">送出</button>
            </div>
          </form>
        </div>
      <?php }?> 
    </div>
  </div>
  <footer>Copyright © 2021-<?php echo date("Y");?> Didi's Blog All Rights Reserved.</footer>
</body>
</html>