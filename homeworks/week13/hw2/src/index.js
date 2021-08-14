import $ from 'jquery'
import { appendCommentToDOM, appendStyle } from './utils'
import { cssElement, getCommentsForm, createClassnames } from './templates'
import { addComments, getComments } from './api'

// 初始化
// eslint-disable-next-line import/prefer-default-export
export function init(options) {
  const { siteKey, apiUrl, containerSelector } = options

  // 不同 plugin 不同 classname
  const {
    addCommentFormClassName,
    commentsClassName,
    moreCommentsBtn
  } = createClassnames(siteKey)

  const addCommentFormSelector = `.${addCommentFormClassName}`
  const commentsSelector = `.${commentsClassName}`
  const moreCommentsBtnSelector = `.${moreCommentsBtn}`

  const commentsForm = getCommentsForm(siteKey)
  $(containerSelector).append(commentsForm)

  appendStyle(cssElement)

  const commentDOM = $(commentsSelector)
  const limit = 5
  let offset = 0
  let allOfComments = 0

  getComments(apiUrl, siteKey, limit, offset, (data) => {
    const { comments, count } = data
    allOfComments = count
    for (const comment of comments) {
      appendCommentToDOM(commentDOM, comment, false)
    }
    if ((offset + limit) >= allOfComments) {
      $(moreCommentsBtnSelector).hide()
    }
  })

  $(addCommentFormSelector).submit((e) => {
    e.preventDefault()
    const nicknameSelector = `${addCommentFormSelector} input[name=nickname]`
    const contentSelector = `${addCommentFormSelector} textarea[name=content]`

    const newCommentData = {
      site_key: siteKey,
      nickname: $(nicknameSelector).val(),
      content: $(contentSelector).val()
    }
    addComments(apiUrl, newCommentData, commentDOM)
    $(nicknameSelector).val('')
    $(contentSelector).val('')

    offset++
    allOfComments++
  })

  $(moreCommentsBtnSelector).click((e) => {
    offset += limit

    if ((offset + limit) >= allOfComments) {
      $(e.target).hide()
    }

    getComments(apiUrl, siteKey, limit, offset, (data) => {
      const { comments } = data
      for (const comment of comments) {
        appendCommentToDOM(commentDOM, comment, false)
      }
    })
  })
}
