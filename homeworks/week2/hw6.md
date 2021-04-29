``` js
function isValid(arr) {
  for(var i=0; i<arr.length; i++) {
    if (arr[i] <= 0) return 'invalid'
  }
  for(var i=2; i<arr.length; i++) {
    if (arr[i] !== arr[i-1] + arr[i-2]) return 'invalid'
  }
  return 'valid'
}

isValid([3, 5, 8, 13, 22, 35])
```

## 執行流程
1. 執行第 1 行，建立一個函式 isValid(arr)
2. 執行第 2 行，設定變數 i 是 0，檢查 i 是否 < arr 的長度，是，繼續執行，開始進入第 1 圈迴圈
3. 執行第 3 行，判斷 arr[i] 是否 <= 0，是，回傳字串 invalid，不是，繼續往下，進入第 2 圈迴圈
4. 執行第 5 行，設定變數 i 是 2，檢查 i 是否 < arr 的長度，是，繼續執行
5. 執行第 6 行，判斷 arr[i] 是否不等於 arr[i-1] + arr[i-2]，是，回傳字串 invalid，不是，繼續往下
6. 執行第 7 行，回傳字串 valid
7. 執行第 9 行，呼叫函式 isvalid 帶入參數值 [3 , 5, 8, 13, 22, 35]
