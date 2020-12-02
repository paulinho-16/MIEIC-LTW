let commentForm = document.querySelector("#comments form")
commentForm.addEventListener('submit', submitComment)

function submitComment(event) {
    event.preventDefault()
    console.log("Function submitComment called!")
}