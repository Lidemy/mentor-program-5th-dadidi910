## hw1: Event Loop
JavaScript 是單執行緒（single thread），一次只能執行一個任務，JS 中等待執行的任務會放入一個堆疊稱 call stack。

執行程式碼的時候，會將待執行的每個動作放進 call stack，由下到上堆疊，有上到下執行，當最上面的執行完畢就會釋放掉直至清空 call stack（先進後出）。

`setTimeout()` 在 window 設定計時，當時間到時將其中的 function 放入 callback queue 回呼佇列中（先進先出），當 call stack 清空時，callback queue 的第一個東西會進入到 call stack 執行。

---題目---

```javaScript
console.log(1)
setTimeout(() => {
  console.log(2)
}, 0)
console.log(3)
setTimeout(() => {
  console.log(4)
}, 0)
console.log(5)
```

---程式執行順序---

1. `console.log(1)` 
  -> 進入 call stack 執行 
  -> call stack 執行結束釋放掉（抽離） 
  -> 印出 1
2. `setTimeout(() => { console.log(2) }, 0)` 
  -> 進入 call stack 執行 
  -> Web API 計時 0 ms 
  -> call stack 執行結束釋放掉（抽離）
  -> Ｗeb API 計時結束
  -> 箭頭函式進入 callback queue 等待
3. `console.log(3)` 
  -> 進入 call stack 執行 
  -> call stack 執行結束釋放掉（抽離） 
  -> 印出 3
4. `setTimeout(() => { console.log(4) }, 0)` 
  -> 進入 call stack 執行 
  -> Web API 計時 0 ms 
  -> call stack 執行結束釋放掉（抽離）
  -> Ｗeb API 計時結束
  -> 箭頭函式進入 callback queue 等待
5. `console.log(5)` 
  -> 進入 call stack 執行 
  -> call stack 執行結束釋放掉（抽離） 
  -> 印出 5
6. Event Loop 偵測 call stack 已清空
7. callback queue 的第一個箭頭函式 `() => { console.log(2) }`
  -> 進入 call stack 執行 `console.log(2)`
  -> call stack 執行結束釋放掉（抽離） 
  -> 印出 2
8. callback queue 的第二個箭頭函式 `() => { console.log(4) }`
  -> 進入 call stack 執行 `console.log(4)`
  -> call stack 執行結束釋放掉（抽離）   
  -> 印出 4
9. call stack 清空
  -> callback queue 清空
  -> 程式執行結束

---程式碼輸出結果---

-> 1
-> 3
-> 5
-> 2
-> 4

---筆記---

- call stack：追蹤記錄每個 function 執行時需要的資源及執行順序（先進後出）。
- Web API：在 Web Application 的開發情境下的 API 被稱為 Web API，在 Web API 作用時，客戶端和伺服器端會透過 HTTP 通訊協定來進行請求與回應。
- callback queue：callback function 等待執行的排隊機制。
- Event Loop：監控堆疊（call stack）和工作佇列（task queue），當堆疊當中沒有執行項目的時候，便把佇列中的內容拉到堆疊中去執行。

---參考資料---

- [[筆記] 理解 JavaScript 中的事件循環、堆疊、佇列和併發模式（Learn event loop, stack, queue, and concurrency mode of JavaScript in depth） ~ PJCHENder<br>那些沒告訴你的小細節](https://pjchender.blogspot.com/2017/08/javascript-learn-event-loop-stack-queue.html)
- [[筆記] 談談JavaScript中的asynchronous和event queue ~ PJCHENder<br>那些沒告訴你的小細節](https://pjchender.blogspot.com/2016/01/javascriptasynchronousevent-queue.html)
- [API是什麼？認識 Web API、HTTP 和 JSON 資料交換格式｜ALPHA Camp Blog](https://tw.alphacamp.co/blog/api-introduction-understand-web-api-http-json)