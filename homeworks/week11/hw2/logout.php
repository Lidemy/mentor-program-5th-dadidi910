<?php
  session_start();
  session_destroy();
  
  header("Location: index.php");
  exit(); 
  // 不清楚這裡是否還需要加入 exit() ?
  // 還是說後面沒有其他要跑的程式，所以可以不用加？
?>