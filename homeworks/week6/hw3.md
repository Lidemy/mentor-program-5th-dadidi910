## 請找出三個課程裡面沒提到的 HTML 標籤並一一說明作用。
1. <hr>：水平線，為空元素。
2. <button type="button">Click Me!</button>：標記按鈕。
3. <caption></caption>：表格標題。

## 請問什麼是盒模型（box model）
由內而外分別是 
* Content ( 內容 )
* Padding ( 內邊距 )
* Border ( 邊框 ) 
* Margin ( 外邊距 )

## 請問 display: inline, block 跟 inline-block 的差別是什麼？
* block：區塊元素，佔滿一整行。
* inline：行內元素，無法設定長寬，元素的寬由內容決定。
* inline-block：inline 的呈現方式，同時具有 block 屬性，可設定元素的可設定元素的寬高 / margin / padding，可水平排列。

## 請問 position: static, relative, absolute 跟 fixed 的差別是什麼？
* static：為預設的定位。
* relative：元素的位置同 static，可以定義上下左右的值。 
* absolute：以上層非 static 的父元素為定位基準，如果上層僅有 static，則會以 body 為定位基準。
* fixed：以目前瀏覽器視窗定位。