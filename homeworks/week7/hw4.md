## 什麼是 DOM？
簡單來說就是把 Document 轉換成 Object ，把一份 HTML 文件內的各個標籤，包括文字、圖片等，都定義成物件。

## 事件傳遞機制的順序是什麼；什麼是冒泡，什麼又是捕獲？
先捕獲，再冒泡！
冒泡：事件往上從子節點一路逆向傳回去根節點，稱之為冒泡階段。
捕獲：從根節點開始往下傳遞到加上事件的 target，稱之為捕獲階段。

## 什麼是 event delegation，為什麼我們需要它？
如果有成千上萬的元素要事件監聽相同的條件，一個個加入 addEventListener 會非常沒有效率，因此我們需要 event delegation 來做監聽事件的代理，只要設置一個事件監聽，其以下元素都會被監聽到，來增加效率。

## event.preventDefault() 跟 event.stopPropagation() 差在哪裡，可以舉個範例嗎？
* event.preventDefault() 為阻止預設的行為，例如：
```
<script>
		const element = document.querySelector('.login-form') 
		element.addEventListener('submit', function(e) {
			e.preventDefault()
		})
	</script>
```
阻止 submit(提交) 預設的行為。

* event.stopPropagation() 為取消事件傳遞，意思是不會再把事件傳遞給「 下一個節點 」，但若是你在同一個節點上有不只一個 listener，還是會被執行到。

如果想要讓其他同一層級的 listener 也不要被執行，這時可以使用 **stopImmediatePropagation( ) 。**