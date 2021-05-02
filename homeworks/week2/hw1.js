// hw1 印出星星

// 觀察：n 是多少，就印出 n 行的 1 顆星星。

function printStars(n) {
  for(let i=1; i<=n; i++){
    let str = ''
    str += '*'
    console.log(str)
  }
}

printStars(5)
