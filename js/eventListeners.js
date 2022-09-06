function buttonPressed(e) {
    let realRField = document.getElementById('real-r');
    realRField.value = e.target.value;
}


const rButtons = document.getElementsByClassName("r-button");

for (let currentRButton of rButtons) {
    currentRButton.addEventListener('click', buttonPressed)
}