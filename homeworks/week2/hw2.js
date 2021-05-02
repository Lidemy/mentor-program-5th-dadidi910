// hw2 首字母大寫
// 把第一個字轉成大寫之後「回傳」
// 若第一個字不是英文字母則忽略

// 觀察：判斷第一個字是否為大寫英文字母
// 是，不變
// 否，小寫轉大寫
// 否，符號即忽略
// 簡單來說，只有小寫需要轉換成大寫

// a:97 ~ z:122 ; A:65 ~ Z:90
// 判斷第一個字的 char code
// 確認字首為大寫
// 印出字串

function capitalize(str) {
  let code = str.charCodeAt(0)
  if(code >= 97 && code <= 122) {
    let result = String.fromCharCode(code-32)
    for(let i=1; i<str.length; i++){
      result += str[i]
    }
    return result
  } else {
    return str
  }
}


console.log(capitalize('nick'))
console.log(capitalize('Nick'))
console.log(capitalize(',hello'))
console.log(capitalize('hello'))
