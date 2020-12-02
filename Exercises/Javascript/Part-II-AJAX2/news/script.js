let commentForm = document.querySelector("#comments form")
commentForm.addEventListener('submit', submitComment)

function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
      return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}

function submitComment(event) {
    event.preventDefault()

    let id = commentForm.querySelector("input[name=id]").value
    let comment_id;
    try {
        comment_id = document.querySelector("#comments article:last-of-type .id").textContent
    }
    catch {
        comment_id = 0
    }
    let username = commentForm.querySelector("input[name=username]").value
    let text = commentForm.querySelector("textarea[name=text]").value

    let request = new XMLHttpRequest()
    request.addEventListener('load', receiveComments)

    request.open("post", "api_add_comment.php", true)
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    request.send(encodeForAjax({id: id, comment_id: comment_id, username: username, text: text}))
}

function receiveComments() {

}