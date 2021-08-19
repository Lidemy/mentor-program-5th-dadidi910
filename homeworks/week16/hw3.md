## hw3：Hoisting
Hoisting：編譯階段時，宣告變數跟函式，因此只提升宣告的部分，不會提升賦值。 

JavaScript 引擎執行時分為兩個階段：

1. 編譯階段：初始化，宣告變數或函式，建立 Execution Context。
2. 執行階段。

編譯階段結束後，才會進入執行階段。

提升的優先順序：

1. function
2. arguments
3. variables

JS 中變數查找方式，例：
`var a = 1`，根據等號拆成兩個部分，var a 和 = 1。

1. LHS：
var a 進行的 LHS 查找，編譯器遇到 var a 時，會詢問作用域是否存在一個名為 a 的變數，如果有則忽略，如果沒有則讓作用域聲明一個名為 a 的變數。

2. RHS：
等式右邊進行的是 RHS 查找，也就是查找數位 1 本身的值，然後再將 1 賦值給 a。

---題目---

在此將 `console.log(a)` 進行編號，以利閱讀作業說明。

```javaScript
var a = 1
function fn(){
  console.log(a)  // 編號 1
  var a = 5
  console.log(a)  // 編號 2
  a++
  var a
  fn2()
  console.log(a)  // 編號 3
  function fn2(){
    console.log(a)  // 編號 4
    a = 20
    b = 100
  }
}
fn()
console.log(a)  // 編號 5
a = 10
console.log(a)  // 編號 6
console.log(b)
```

---程式執行順序---

> 編譯階段：

- 初始化，處理宣告的部分。
  - `var a = 1` -> 宣告一個變數 a
  - `function fn()` -> 宣告一個函式 fn

```
globalEC: {
  VO: {
    a: undefined,
    fn: Function
  },
  scopeChain: [globalEC.VO]
}
```

> 執行階段：

- `var a = 1` 
  -> JS 引擎 global scope 以 LHS 查找
  -> 在 global scope 中找到 a
  -> a 賦值 1

  ```
  globalEC: {
    VO: {
      a: undefined -> 1,
      fn: Function
    },
    scopeChain: [globalEC.VO]
  }
  ```

- `fn()`
  -> JS 引擎 global scope 以 RHS 查找
  -> 在 global scope 中找到 fn
  -> 返回 fn 的值
  -> 呼叫 function

- 進入 fn function

> 編譯階段：

- 初始化 fn Function，處理宣告的部分。
  - `var a = 5` -> 宣告一個變數 a
  - `function fn2()` -> 宣告一個函式 fn2

```
fnEC: {
  AO: {
    a: undefined,
    fn2: Function
  },
  scopeChain: [fnEC.AO, fn.[[Scope]]]
            = [fnEC.AO, globalEC.VO]
}

globalEC: {
  VO: {
    a: 1,
    fn: Function
  },
  scopeChain: [globalEC.VO]
}

fn.[[Scope]] = globalEC.scopeChain
             = [globalEC.VO]
```
> 執行階段

- `console.log(a)` // 編號 1
  -> JS 引擎 fn scope 以 RHS 查找
  -> 在 fn scope 中找到 a
  -> 印出 undefined

- `var a = 5`
  -> JS 引擎 fn scope 以 LHS 查找
  -> 在 fn scope 中找到 a
  -> a 賦值 5

  ```
  fnEC: {
    AO: {
      a: undefined -> 5,
      fn2: Function
    },
    scopeChain: [fnEC.AO, fn.[[Scope]]]
              = [fnEC.AO, globalEC.VO]
  }
  ```

- `console.log(a)` // 編號 2
  -> JS 引擎 fn scope 以 RHS 查找
  -> 在 fn scope 中找到 a
  -> 印出 5

- `a++`
  -> JS 引擎 fn scope 以 LHS 查找
  -> 在 fn scope 中找到 a
  -> a++，a 賦值 6

  ```
  fnEC: {
    AO: {
      a: 5 -> 6,
      fn2: Function
    },
    scopeChain: [fnEC.AO, fn.[[Scope]]]
              = [fnEC.AO, globalEC.VO]
  }
  ```

- `var a` -> 已經有 a，所以不做任何事。

- `fn2()`
  -> JS 引擎 fn scope 以 RHS 查找
  -> 在 fn scope 中找到 fn2
  -> 返回 fn2 的值
  -> 呼叫 Function

- 進入 fn2 Function

> 編譯階段：

- 初始化 fn2 Function。

```
fn2EC: {
  AO: {

  },
  scopeChain: [fn2EC.AO, fn2.[[Scope]]]
            = [fn2EC.AO, fnEC.AO, globalEC.VO]
}

fnEC: {
  AO: {
    a: 6,
    fn2: Function
  },
  scopeChain: [fnEC.AO, fn.[[Scope]]]
            = [fnEC.AO, globalEC.VO]
}

globalEC: {
  VO: {
    a: 1,
    fn: Function
  },
  scopeChain: [globalEC.VO]
}

fn2.[[Scope]] = fnEC.scopeChain
              = [fnEC.AO, globalEC.VO]
```

> 執行階段

- `console.log(a)` // 編號 4
  -> JS 引擎 fn2 scope 以 RHS 查找
  -> 在 fn2 scope 沒有找到 a，到上一層 fn scope 查找
  -> 在 fn scope 找到 a
  -> 印出 6

- `a = 20`
  -> JS 引擎 fn2 scope 以 LHS 查找
  -> 在 fn2 scope 沒有找到 a，到上一層 fn scope 查找
  -> 在 fn scope 找到 a
  -> a 賦值 20

  ```
  fnEC: {
  AO: {
    a: 6 -> 20,
    fn2: Function
  },
  scopeChain: [fnEC.AO, fn.[[Scope]]]
            = [fnEC.AO, globalEC.VO]
  }
  ```

- `b = 100`
  -> JS 引擎 fn2 scope 以 LHS 查找
  -> 在 fn2 scope 沒有找到 b，到上一層 fn scope 查找
  -> 在 fn scope 沒有找到 b，到上一層 global scope 查找
  -> 在 global scope 沒有找到 b
  （非嚴格模式）
    -> 在 global scope 內宣告變數 b

    ```
    globalEC: {
      VO: {
        a: 1,
        fn: Function,
        b: undefined
      },
      scopeChain: [globalEC.VO]
    }
    ```

    -> JS 引擎 global scope 以 LHS 查找
    -> 在 global scope 找到 b
    -> b 賦值 100

    ```
    globalEC: {
      VO: {
        a: 1,
        fn: Function,
        b: undefined -> 100
      },
      scopeChain: [globalEC.VO]
    }
    ```

  （嚴格模式）
    -> 返回 `ReferenceError: b is not defined`

- fn2 執行結束，fn2 scope 回收

- `console.log(a)` // 編號 3
  -> JS 引擎 fn scope 以 RHS 查找
  -> 在 fn scope 中找到 a
  -> 印出 20

- fn 執行結束，fn scope 回收

- `console.log(a)` // 編號 5
  -> JS 引擎 global scope 以 RHS 查找
  -> 在 global scope 中找到 a
  -> 印出 1

- `a = 10`
  -> JS 引擎 global scope 以 LHS 查找
  -> 在 global scope 中找到 a
  -> a 賦值 10

  ```
  globalEC: {
    VO: {
      a: 1 -> 10,
      fn: Function,
      b: 100
    },
    scopeChain: [globalEC.VO]
  }
  ```

- `console.log(a)` // 編號 6
  -> JS 引擎 global scope 以 RHS 查找
  -> 在 global scope 中找到 a
  -> 印出 10

- `console.log(b)`
  -> JS 引擎 global scope 以 RHS 查找
  -> 在 global scope 中找到 b
  -> 印出 100

- 程式執行結束，global scope 回收

---程式輸出結果---

-> undefined
-> 5
-> 6
-> 20
-> 1
-> 10
-> 100

---參考資料---
- [JavaScript Hoisting](https://www.w3schools.com/js/js_hoisting.asp)
- [JS中RHS引用和LHS引用的區別_caishi13202的博客-CSDN博客](https://blog.csdn.net/caishi13202/article/details/82693970)