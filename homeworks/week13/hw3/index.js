const twitchAPI = 'https://api.twitch.tv/kraken'
const CLIENT_ID = '5h343dnbi5hu13vhhw2nxktjhsb7sa'
const TOP5_GAMES_URL = `${twitchAPI}/games/top?limit=5`
const HEADERS = {
  method: 'GET',
  headers: {
    'Client-ID': CLIENT_ID,
    Accept: 'application/vnd.twitchtv.v5+json'
  }
}

getTop5()

async function getTop5() {
  await fetch(TOP5_GAMES_URL, HEADERS).then((res) => {
    const data = res.json()
    return data
  }).then((json) => {
    const { top } = json
    for (let i = 0; i < top.length; i++) {
      const element = document.createElement('li')
      element.innerText = top[i].game.name
      document.querySelector('.navbar__list').appendChild(element)
    }
    document.querySelector('h1').innerText = top[0].game.name
    getStreams(top[0].game.name)
  }).catch((err) => {
    console.log('err', err)
  })
}

async function getStreams(gameName) {
  const topNames = encodeURIComponent(gameName)
  const STREAMS_URL = `${twitchAPI}/streams?game=${topNames}`
  await fetch(STREAMS_URL, HEADERS).then((res) => {
    const data = res.json()
    return data
  }).then((json) => {
    const { streams } = json
    for (let i = 0; i < streams.length; i++) {
      const element = document.createElement('div')
      document.querySelector('.streams').appendChild(element)
      element.outerHTML = `
        <div class="stream">
          <img src="${streams[i].preview.large}" />
          <div class="stream__data">
            <div class="stream__avatar">
              <img src="${streams[i].channel.logo}" />
            </div>
            <div class="stream__intro">
              <div class="stream__title">${streams[i].channel.status}</div>
              <div class="stream__channel">${streams[i].channel.name}</div>
            </div>
          </div>
        </div>  
      `
    }
  }).catch((err) => {
    console.log('err', err)
  })
}

document.querySelector('.navbar__list').addEventListener('click', (e) => {
  if (e.target.tagName.toLowerCase() === 'li') {
    const gameName = e.target.innerText
    document.querySelector('h1').innerText = gameName
    document.querySelector('.streams').innerText = ''
    getStreams(gameName)
  }
})
