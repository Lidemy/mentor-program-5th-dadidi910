const request = require('request')

const clientID = '5h343dnbi5hu13vhhw2nxktjhsb7sa'
const topGameAPI = 'https://api.twitch.tv/kraken'

request({
  url: `${topGameAPI}/games/top`,
  headers: {
    'Client-ID': clientID,
    Accept: 'application/vnd.twitchtv.v5+json'
  }
}, (error, response, body) => {
  if (error) {
    return console.log('錯誤:', error)
  }
  const data = JSON.parse(body)
  const games = data.top
  for (const topGame of games) {
    console.log(`${topGame.viewers} ${topGame.game.name}`)
  }
})
