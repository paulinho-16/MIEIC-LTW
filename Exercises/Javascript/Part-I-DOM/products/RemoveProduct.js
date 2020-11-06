let form = document.getElementsByTagName('form')[0]
form.addEventListener('submit', function(event) {
  event.preventDefault()

  let newLine = document.createElement("tr")
  let description = document.querySelector("form label:first-child input")
  let quantity = document.querySelector("form label:nth-child(2) input")
  newLine.innerHTML = `<td>${description.value}</td><td><input value=${quantity.value}></td><td><input type="button" value="Remove"></td>`
  document.getElementById("products").append(newLine)

  newLine.querySelector("input[type=button]").addEventListener('click', function() {
    newLine.remove()
  })

  alert('Submitted!')
})