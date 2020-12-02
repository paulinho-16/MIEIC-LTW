let commentForm = document.querySelector("#comments form")
commentForm.addEventListener('submit', submitComment)

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

    console.log("ID: ", id)
    console.log("Comment ID: ", comment_id)
    console.log("Username: ", username)
    console.log("Text: ", text)
}