let form = document.getElementsByTagName("form")
console.log("Form: ", form[0].outerHTML)

let second_input = document.querySelector("form label:nth-child(2) input")
console.log("Second Input: ", second_input.outerHTML)

let all_inputs = document.querySelectorAll("form input")
for (let i = 0; i < all_inputs.length; i++) {
    console.log("Input: ", i, all_inputs[i].outerHTML)
}