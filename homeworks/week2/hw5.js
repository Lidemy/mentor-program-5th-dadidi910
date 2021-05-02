// join
// 想法：
// result 每組合一個 array 內的元素，後面就再組合一個 concatStr。
// 除非是組合 array 的最後一個元素，後面才不用再組合一個 concatStr。
// 換句話說，不是最後一個元素，才組合 concatStr
// 判斷是否為最後一個元素

function join(arr, concatStr) {
  let arrLen = arr.length
  let result = ''
  for(let i=0; i<arrLen; i++){
    result += arr[i]
    if(i !== arrLen-1){
      result += concatStr
    }
  }
  return result
}

console.log(join(['a'], '!'))

// repeat
// 想法：重複回傳 n 次的字串

function repeat(str, times) {
  let result = ''
  for(let i=0; i<times; i++){
    result += str
  }
  return result  
}

console.log(repeat('a', 5))
