<?php
  require_once("conn.php");

  // 防止 XSS 攻擊
  function escape($str) {
    return htmlspecialchars($str, ENT_QUOTES);
  }

?>