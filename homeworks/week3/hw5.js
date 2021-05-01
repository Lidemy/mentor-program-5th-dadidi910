// 順序比大小
// 先假設都比大
// 若比小，AB答案互換回傳
// 比較字串長度，判斷大小
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
    const n = lines[i].split(' ')
    const A = n[0]
    const B = n[1]
    const K = Number(n[2])
    console.log(compareAB(A, B, K))
  }
}

function compareAB(a, b, k) {
  if (a === b) return 'DRAW'
  if (k === -1) {
    const temp = a
    a = b
    b = temp
  }
  const lengthA = a.length
  const lengthB = b.length
  if (lengthA !== lengthB) {
    return lengthA > lengthB ? 'A' : 'B'
  }
  return a > b ? 'A' : 'B'
}
