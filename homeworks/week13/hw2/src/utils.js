export function escapeHTML(specialChars) {
  return specialChars
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#x27')
    .replace(/\//g, '&#x2F')
}

export function appendCommentToDOM(container, comment, isPrepend) {
  const html = `
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">${escapeHTML(comment.nickname)}</h5>
        <p class="card-text">${escapeHTML(comment.content)}
        </p>
      </div>
    </div>
  `
  isPrepend ? container.prepend(html) : container.append(html)
}

export function appendStyle(cssElement) {
  const styleElement = document.createElement('style')
  styleElement.type = 'text/css'
  styleElement.appendChild(document.createTextNode(cssElement))
  document.head.appendChild(styleElement)
}
