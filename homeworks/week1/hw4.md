# 跟你朋友介紹 Git
## [ Git 基本概念 ]
可以管理好檔案的所有版本，同時保留每個不同功能的版本，識別最新版本順序，清楚記錄每個檔案的歷程。

## [ Git 基本指令 ]
* **git init**：將資料夾初始化，讓資料夾被 git 控制。
* **git status**：可查看 git 版本控制現在的狀況為何。
* **git add 檔名**：將檔案 add 到暫存區保存，沒有被加入的檔案則會不被 git 追蹤，但仍保有檔案。
* **git commit**：將暫存區中的檔案，建立成一個新的版本。
* **git log**：可以查看本版的歷程紀錄。
* **git checkout** +本版號：切換到某個版本。
* **.gitignore**：touch .gitignore 然後以 vim 開啟它，將不需要改動的檔案，想忽略的檔案，編輯到其中。
* **git diff**：在建立成新的版本前，查看此次本版與舊版的差異。

## [ 認識 branch ]
branch 存在的目的是為了**避免版本間修改後互相衝突**，因此需要 branch。

## [ branch 基本指令 ]
* **git branch 檔名**：建立一個分支 branch。
* **git branch -v**：查看所在的分支 branch。
* **git checkout branch-name1**：切換分支到 branch-name1。
* **git merge branch-name1**：將 branch-name1 這個分支合併進來 master。
* **git branch -d 分支名**：刪除分支名這個 branch。

## [ 如何使用 ]
1. 先在資料夾執行指令 git init，讓資料夾被 git 版本控制。
2. 建立一個檔案 .gitignore 將不需要被版本控制的檔案編輯進去。
3. 創建一個分支 branch，在此編輯想新增或修改的檔案內容。
4. 修改後的檔案用 git add 檔名，將檔案存到暫存區。
5. 完成所有修改並確認無誤後用 git commit -m，提交此檔案成新的版本。
6. 使用 git checkout master，切換到 master 這個 branch，接著用 git merge +新版本所在的branch名稱，將剛才編輯完成的 branch 合併進來，即可完成版本更新。
