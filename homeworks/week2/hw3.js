// 反轉字串
// 從字串的最後一個字開始

function reverse(str) {
  var result = ''
  for(let i=str.length-1; i >= 0; i--){
    result += str[i]
  }  
  console.log(result)
}

reverse('hello')
