// 判斷質數
// 只能整除自己的數，無法被其他數整除
// 是質數，輸出：Prime
// 不是質數，輸出：Composite
// 1 不是質數也不是合數，但在這一題裡面一樣要輸出Composite

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
  for (let i = 1; i < lines.length; i++) {
    if (isPrime(Number(lines[i]))) {
      console.log('Prime')
    } else {
      console.log('Composite')
    }
  }
}

function isPrime(n) {
  if (n === 1) return false
  for (let i = 2; i < n; i++) {
    if (n % i === 0) {
      return false
    }
  }
  return true
}
