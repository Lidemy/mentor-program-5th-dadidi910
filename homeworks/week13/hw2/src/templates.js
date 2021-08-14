export const cssElement = '.card { margin-top: 12px; }'

export function createClassnames(prefix) {
  return {
    addCommentFormClassName: `${prefix}-add-comment-form`,
    inputNickname: `${prefix}-form-nickname`,
    inputContent: `${prefix}-content-textarea`,
    commentsClassName: `${prefix}-comments`,
    moreCommentsBtn: `${prefix}-more-comments-btn`
  }
}

export function getCommentsForm(prefix) {
  const {
    addCommentFormClassName,
    inputNickname,
    inputContent,
    commentsClassName,
    moreCommentsBtn
  } = createClassnames(prefix)

  return `
    <div>
      <form class="${addCommentFormClassName}">
        <div class="mb-3">
          <label for="${inputNickname}" class="form-label mt-3">暱稱</label>
          <input name="nickname" type="text" class="form-control" id="${inputNickname}" />
        </div>
        <div class="mb-3">
          <label for="${inputContent}" class="form-label">留言內容</label>
          <textarea name="content" class="form-control" id="${inputContent}" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">送出</button>
      </form>
      <div class="${commentsClassName}">
      </div>
      <div class="mt-3 d-grid gap-2">
        <button type="button" class="btn btn-outline-primary ${moreCommentsBtn}">載入更多</button>
      </div>
    </div>  
  `
}
