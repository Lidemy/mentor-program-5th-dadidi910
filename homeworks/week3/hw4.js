// 判斷迴文
// 字串依序輸出的結果與倒序輸出的結果相等

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
  const s = lines[0]
  if (isTwins(s)) {
    console.log('True')
  } else {
    console.log('False')
  }
}

function isTwins(str) {
  let num = ''
  for (let i = str.length - 1; i >= 0; i--) {
    num += str[i]
  }
  if (num === str) {
    return true
  } else {
    return false
  }
}
