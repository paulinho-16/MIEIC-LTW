let form = document.getElementsByTagName('form')[0]
let products = document.getElementById("products")

form.addEventListener('submit', function(event) {
  event.preventDefault()

  let newLine = document.createElement("tr")
  let description = document.querySelector("form label:first-child input")
  let quantity = document.querySelector("form label:nth-child(2) input")
  newLine.innerHTML = `<td>${description.value}</td><td><input value=${quantity.value}></td><td><input type="button" value="Remove"></td>`
  document.getElementById("products").append(newLine)

  let removeButton = newLine.querySelector("input[type=button]")
  let quantityBox = newLine.querySelector("td:nth-child(2) input")

  updateQuantities()

  removeButton.addEventListener('click', function() {
    newLine.remove()
    updateQuantities()
  })

  quantityBox.addEventListener('keyup', updateQuantities)

  alert('Submitted!')
})

function updateQuantities() {
    let quantities = products.querySelectorAll("td:nth-child(2) input")
    let t = 0
    for (let i = 0; i < quantities.length; i++) {
        t += parseInt(quantities[i].value)
    }
    let total = document.getElementById("total")
    total.innerHTML = t;
}