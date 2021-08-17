## hw4：What is this?

this 綁定的基本原則大致上可以分成下列四種：

1. 預設綁定 (Default Binding)
  -> function 裡的 `this` 就一定是全域物件: `window` 或是 `global`，在嚴格模式下則是 `undefined。`

2. 隱含式綁定 (Implicit Binding)
  -> function 被呼叫時，存在於某個物件的話，那 `this` 就是那個物件。

3. 顯式綁定 (Explicit Binding)
  -> function 是以 `.call()` 或 `.apply()` 的方式呼叫，或是透過 `.bind()` 指定，那 `this` 就是被指定的物件。

4. 「new」關鍵字綁定
  -> function 的呼叫，是透過 `new` 進行的話，那 `this` 就是被建構出來的物件。

---課程筆記---

1.  脫離物件的 this 基本上沒有任何意義
2.  沒有意義的 this 會根據嚴格模式以及環境給一個預設值
3.  嚴格模式底下預設就是 undefined，非嚴格模式在瀏覽器底下預設值是 window
4.  可以用 call、apply 與 bind 改變 this 的值
5.  要看 this，就看這個函式「怎麽」被呼叫
6.  可以把 `a.b.c.hello()` 看成 `a.b.c.hello.call(a.b.c)`，以此類推，就能輕鬆找出 this 的值

---題目---
```javaScript
const obj = {
  value: 1,
  hello: function() {
    console.log(this.value)
  },
  inner: {
    value: 2,
    hello: function() {
      console.log(this.value)
    }
  }
}
  
const obj2 = obj.inner
const hello = obj.inner.hello
obj.inner.hello() // ??
obj2.hello() // ??
hello() // ??
```

---綁定---

- `obj.inner.hello()`

  判斷為「隱式綁定」：function 被呼叫時，存在於某個物件的話，那 `this` 就是那個物件。

  `hello()` 由 `obj.inner` 呼叫，所以 `this` 為 `obj.inner`，`this.value` 就會是 `obj.inner.value`，所以印出 2。

- `obj2.hello()`

  `obj2` 為 `obj.inner`，指向同一個物件，同上題，印出 2。

- `hello()`

  `hello` 為全域物件的屬性，判斷為「預設綁定」。
  `this` 的值為全域物件 `window`，`this.value` 為 `window.value`，由於沒有宣告 `value` 這個全域變數，所以印出 `undefined`。

---想成用 `call()` 來呼叫 function ---

- `obj.inner.hello()`
  -> `obj.inner.hello().call(obj.inner)`
  -> `this` 為 `obj.inner`
  -> `obj.inner.value` 為 2
  -> 印出 2

- `obj2.hello()`
  -> `obj2.hello().call(obj2)` (obj2 = obj.inner)
  -> `obj.inner.hello().call(obj.inner)`
  -> `this` 為 `obj.inner`
  -> `obj.inner.value` 為 2
  -> 印出 2

- `hello()`
  -> `window.hello().call(window)`
  -> 沒有宣告 `value` 的全域變數
  -> 印出 `undefined`

---程式碼輸出結果---

-> 2
-> 2
-> undefined

---參考資料---

- [What's THIS in JavaScript ? [上] | Kuro's Blog](https://kuro.tw/posts/2017/10/12/What-is-THIS-in-JavaScript-%E4%B8%8A/)
- [What's THIS in JavaScript ? [中] | Kuro's Blog](https://kuro.tw/posts/2017/10/17/What-s-THIS-in-JavaScript-%E4%B8%AD/)
- [What's THIS in JavaScript ? [下] | Kuro's Blog](https://kuro.tw/posts/2017/10/20/What-is-THIS-in-JavaScript-%E4%B8%8B/)