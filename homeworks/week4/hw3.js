const request = require('request')

const args = process.argv
const countryAPI = 'https://restcountries.eu/rest/v2'
const countryName = args[2]

request(`${countryAPI}/name/${countryName}`, (error, response, body) => {
  if (error) {
    console.log('資料錯誤:', error)
  }
  const data = JSON.parse(body)
  if (data.status === 404) {
    return console.log('找不到國家資訊')
  }
  for (let i = 0; i < data.length; i++) {
    console.log('============')
    console.log(`國家：${data[i].name}`)
    console.log(`首都：${data[i].capital}`)
    console.log(`貨幣：${data[i].currencies[0].code}`)
    console.log(`國碼：${data[i].callingCodes}`)
  }
})
