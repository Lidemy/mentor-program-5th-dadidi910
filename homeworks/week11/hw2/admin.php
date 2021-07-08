<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  $username = NULL;

  if (!empty($_SESSION["username"])) {
    $username = $_SESSION["username"];
  }

  $sql = 
    "SELECT 
      A.id AS id,
      A.username AS username, 
      A.title AS title, 
      A.article AS article, 
      A.created_at AS created_at 
    FROM 
      didi_w11_hw2_articles AS A 
    LEFT JOIN 
      didi_w11_hw2_users AS U 
    ON 
      A.username = U.username 
    WHERE 
      A.is_deleted IS NULL 
    ORDER BY A.id DESC";
  $stmt = $conn->prepare($sql);
  $result = $stmt->execute();

  if (!$result) {
    die ("Error:" . $conn->error);
  }

  $result = $stmt->get_result();

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
          <li><a href="create.php">新增文章</a></li>
          <li><a href="logout.php">登出</a></li>
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
      <?php while ($row = $result->fetch_assoc()) { ?>
        <div class="admin-posts">
          <div class="admin-post">
            <div class="admin-post__title">
              <?php echo escape($row["title"]) ?>
            </div>
            <div class="admin-post__info">
              <div class="admin-post__created-at">
                <?php echo escape($row["created_at"])?>
              </div>
              <a class="admin-post__btn" href="edit_blog.php?id=<?php echo escape($row["id"])?>">
                編輯
              </a>
              <a class="admin-post__btn" href="handle_delete_blog.php?id=<?php echo escape($row["id"])?>">
                刪除
              </a>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
  <footer>Copyright © 2021-<?php echo date("Y");?> Didi's Blog All Rights Reserved.</footer>
</body>
</html>