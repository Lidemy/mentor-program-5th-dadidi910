# 請解釋後端與前端的差異。

使用者向「瀏覽器」提出需求後，前端處理跟瀏覽器有關的部分，例如：使用者能看到的畫面、可以互動的網頁元件等。

後端的工作為網站伺服器本身，儲存資料的資料庫有關，回應使用者的需求，除了將接收的需求存入資料庫以外，也有查詢/修改或是提供其他服務。

# 假設我今天去 Google 首頁搜尋框打上：JavaScript 並且按下 Enter，請說出從這一刻開始到我看到搜尋結果為止發生在背後的事情。

按下 Enter 後，瀏覽器會將搜尋 JaveScript 這個請求透過作業系統傳到硬體網路卡，由硬體網路卡向 Google 伺服器提出請求，伺服器接收到請求之後，資料庫提供與 JavaScript 相關的資料，再透過伺服器回應給硬體網路卡，由硬體網路卡解析資料給作業系統，再由作業系統解析到瀏覽器，顯示給使用者查看 JavaScript 的相關資料。

# 請列舉出 3 個「課程沒有提到」的 command line 指令並且說明功用
1. du：列出佔用了多少的磁碟空間。
2. ps：列出本機正在跑的程序。
3. sudo：以 root 身份認證最高權限用戶獲取安全權限，因此使用時會需要密碼。
