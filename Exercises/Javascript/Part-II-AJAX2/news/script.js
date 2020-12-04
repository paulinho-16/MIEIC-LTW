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
    response = JSON.parse(this.responseText)
    comments = document.querySelector('#comments')

    response.forEach (function(comment) {
        const comment_id = comment['id']
        const published = comment['published']
        const text = comment['text']
        const username = comment['username']

        let newArticle = document.createElement('article')
        newArticle.setAttribute('class', 'comment')
        
        let idSpan = document.createElement('span')
        idSpan.setAttribute('class', 'id')
        idSpan.innerText = comment_id

        let userSpan = document.createElement('span')
        userSpan.setAttribute('class', 'user')
        userSpan.innerText = username

        let dateSpan = document.createElement('span')
        dateSpan.setAttribute('class', 'date')
        dateSpan.innerText = published

        let content = document.createElement('p')
        content.innerText = text

        newArticle.appendChild(idSpan)
        newArticle.appendChild(userSpan)
        newArticle.appendChild(dateSpan)
        newArticle.appendChild(content)

        comments.insertBefore(newArticle, commentForm)
    })
}