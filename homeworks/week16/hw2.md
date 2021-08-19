## hw2: Event Loop + scope

---題目---

```javaScript
for(var i=0; i<5; i++) {
  console.log('i: ' + i)
  setTimeout(() => {
    console.log(i)
  }, i * 1000)
}
```

---程式執行順序---

1. 進入迴圈
2. 宣告全域變數，賦值 i = 0，條件 i < 5，每一圈 i+1
3. `console.log('i: ' + i)`
  -> 進入 call stack 執行
  -> call stack 執行結束釋放掉（抽離）
  -> 印出 i: 0
4. `setTimeout(() => { console.log(i) }, i * 1000)`
  -> 進入 call stack 執行
  -> Web API 計時 1000 ms
  -> call stack 執行結束釋放掉（抽離）
  -> Web API 計時結束
  -> 箭頭函式進入 callback queue 等待
5. `i++`，此時 i = 1。
6. `console.log('i: ' + i)`
  -> 進入 call stack 執行
  -> call stack 執行結束釋放掉（抽離）
  -> 印出 i: 1
7. `setTimeout(() => { console.log(i) }, i * 1000)`
  -> 進入 call stack 執行
  -> Web API 計時 1000 ms
  -> call stack 執行結束釋放掉（抽離）
  -> Web API 計時結束
  -> 箭頭函式進入 callback queue 等待
8. `i++`，此時 i = 2。
9. `console.log('i: ' + i)`
  -> 進入 call stack 執行
  -> call stack 執行結束釋放掉（抽離）
  -> 印出 i: 2
10. `setTimeout(() => { console.log(i) }, i * 1000)`
  -> 進入 call stack 執行
  -> Web API 計時 1000 ms
  -> call stack 執行結束釋放掉（抽離）
  -> Web API 計時結束
  -> 箭頭函式進入 callback queue 等待
11. `i++`，此時 i = 3。
12. `console.log('i: ' + i)`
  -> 進入 call stack 執行
  -> call stack 執行結束釋放掉（抽離）
  -> 印出 i: 3
13. `setTimeout(() => { console.log(i) }, i * 1000)`
  -> 進入 call stack 執行
  -> Web API 計時 1000 ms
  -> call stack 執行結束釋放掉（抽離）
  -> Web API 計時結束
  -> 箭頭函式進入 callback queue 等待
14. `i++`，此時 i = 4。
15. `console.log('i: ' + i)`
  -> 進入 call stack 執行
  -> call stack 執行結束釋放掉（抽離）
  -> 印出 i: 4
16. `setTimeout(() => { console.log(i) }, i * 1000)`
  -> 進入 call stack 執行
  -> Web API 計時 1000 ms
  -> call stack 執行結束釋放掉（抽離）
  -> Web API 計時結束
  -> 箭頭函式進入 callback queue 等待
17. `i++`，此時 i = 5，迴圈結束。
18. Event Loop 偵測 call stack 已清空。
19. Event Loop 將 callback queue 以「先進先出」的順序，將箭頭函式放到 call stack 執行。
20. callback queue 的第一個箭頭函式 `() => { console.log(i) }`
  -> 進入 call stack 執行 `console.log(i)`
  -> call stack 執行結束
  -> 此時 i = 5，印出 5
21. callback queue 的第二個箭頭函式 `() => { console.log(i) }`
  -> 進入 call stack 執行 `console.log(i)`
  -> call stack 執行結束
  -> 此時 i = 5，印出 5
22. callback queue 的第三個箭頭函式 `() => { console.log(i) }`
  -> 進入 call stack 執行 `console.log(i)`
  -> call stack 執行結束
  -> 此時 i = 5，印出 5
23. callback queue 的第四個箭頭函式 `() => { console.log(i) }`
  -> 進入 call stack 執行 `console.log(i)`
  -> call stack 執行結束
  -> 此時 i = 5，印出 5
24. callback queue 的第五個箭頭函式 `() => { console.log(i) }`
  -> 進入 call stack 執行 `console.log(i)`
  -> call stack 執行結束
  -> 此時 i = 5，印出 5
25. call stack 清空
  -> callback queue 清空
  -> 程式執行結束

---程式碼輸出結果---

-> i: 0
-> i: 1
-> i: 2
-> i: 3
-> i: 4
-> 5
-> 5
-> 5
-> 5
-> 5