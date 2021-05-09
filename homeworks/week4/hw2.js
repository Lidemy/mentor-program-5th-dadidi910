const request = require('request')

const bookAPI = 'https://lidemy-book-store.herokuapp.com'
const args = process.argv
const action = args[2]
const param = args[3]

if (action === 'list') {
  listBooks()
} else if (action === 'read') {
  readBook(param)
} else if (action === 'create') {
  createBook(param)
} else if (action === 'delete') {
  deleteBook(param)
} else if (action === 'update') {
  updateBook(param, args[4])
}

function listBooks() {
  request(`${bookAPI}/books?_limit=20`, (error, response, body) => {
    if (error) {
      return console.log('錯誤:', error)
    }
    let data
    try {
      data = JSON.parse(body)
    } catch (error) {
      console.log(error)
      return
    }
    for (let i = 0; i < data.length; i++) {
      console.log(`${data[i].id} ${data[i].name}`)
    }
  })
}

function readBook(id) {
  request(`${bookAPI}/books/${id}`, (error, response, body) => {
    if (error) {
      return console.log('錯誤:', error)
    }
    let data
    try {
      data = JSON.parse(body)
    } catch (error) {
      console.log(error)
      return
    }
    console.log(`${data.id} ${data.name}`)
  })
}

function createBook(bookName) {
  request.post({
    url: `${bookAPI}/books`,
    form: {
      name: bookName
    }
  }, (error, response, body) => {
    if (error) {
      return console.log('錯誤:', error)
    }
    console.log(`已新增書名: ${bookName}`)
  })
}

function deleteBook(id) {
  request.delete(`${bookAPI}/books/${id}`, (error, response, body) => {
    if (error) {
      return console.log('錯誤:', error)
    }
    console.log('成功刪除')
  })
}

function updateBook(id, newName) {
  request.patch({
    url: `${bookAPI}/books/${id}`,
    form: {
      name: newName
    }
  }, (error, response, body) => {
    if (error) {
      return console.log('錯誤:', error)
    }
    console.log(`已更新書名: ${newName}`)
  })
}
