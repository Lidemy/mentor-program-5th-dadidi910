import $ from 'jquery'
import { appendCommentToDOM } from './utils'

export function getComments(apiUrl, siteKey, limit, offset, cb) {
  $.ajax({
    url: `${apiUrl}api_comments.php?site_key=${siteKey}&limit=${limit}&offset=${offset}`
  }).done((data) => {
    if (!data.ok) return alert(data.message)
    cb(data)
  })
}

export function addComments(apiUrl, newCommentData, commentDOM) {
  $.ajax({
    type: 'POST',
    url: `${apiUrl}api_add_comments.php`,
    data: newCommentData
  }).done((data) => {
    if (!data.ok) return alert(data.message)
    appendCommentToDOM(commentDOM, newCommentData, true)
  })
}
