## 請以自己的話解釋 API 是什麼
API 是雙方需要資料交換時，彼此所需要提供的介面。


## 請找出三個課程沒教的 HTTP status code 並簡單介紹
1. 400 此回應意味伺服器因為收到無效語法，而無法理解請求。
2. 409 表示請求與伺服器目前的狀態衝突
3. 505 請求使用的 HTTP 版本不被伺服器支援
## 假設你現在是個餐廳平台，需要提供 API 給別人串接並提供基本的 CRUD 功能，包括：回傳所有餐廳資料、回傳單一餐廳資料、刪除餐廳、新增餐廳、更改餐廳，你的 API 會長什麼樣子？請提供一份 API 文件。

| 說明 | Method | path | 參數 | 範例 |
| -------- | -------- | -------- | -------- | -------- |
| 獲取所有餐廳資訊 | GET | /restaurants | \_limit:限制回傳資料數量 | /restaurants?\_limit=5 |
| 獲取單一餐廳資訊 | GET | /restaurants/:id | 無 | /restaurants/10 |
| 刪除餐廳資訊 | DELETE | /restaurants/:id | 無 | 無 |
| 新增餐廳資訊 | POST | /restaurants | name: 餐廳名 | 無 |
| 更改餐廳資訊 | PATCH | /restaurants/:id | name: 餐廳名 | 無 |