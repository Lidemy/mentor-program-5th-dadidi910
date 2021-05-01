// 水仙花數：一個 n 位數的數字，每一個數字的 n 次方加總等於自身
// 先取得幾位數，回傳
// 再取出各個數
// 加總各個數的位數次方
// 判斷加總後是否等於輸入的數，回傳
// 找出符合條件內的水仙花數，印出

const readline = require('readline')

const lines = []
const rl = readline.createInterface({
  input: process.stdin
})

rl.on('line', (line) => {
  lines.push(line)
})

rl.on('close', () => {
  solve(lines)
})

function solve(lines) {
  const temp = lines[0].split(' ')
  const n = Number(temp[0])
  const m = Number(temp[1])
  for (let i = n; i <= m; i++) {
    if (isNarcNum(i)) {
      console.log(i)
    }
  }
}

function isDigits(n) {
  if (n === 0) return 1
  let result = 0
  while (n !== 0) {
    n = Math.floor(n / 10)
    result++
  }
  return result
}

function isNarcNum(n) {
  let m = n
  let sum = 0
  const digits = isDigits(m)
  while (m !== 0) {
    const num = m % 10
    m = Math.floor(m / 10)
    sum += num ** digits
  }
  if (sum === n) {
    return true
  } else {
    return false
  }
}
