// 印出星星
// 第 i 行有 i 個星星

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
  const n = lines[0]
  printStar(n)
}

function printStar(n) {
  let str = ''
  for (let i = 1; i <= n; i++) {
    str += '*'
    console.log(str)
  }
}
