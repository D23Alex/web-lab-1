const rButtons = document.getElementsByClassName("r-button");


function rButtonPressed(e) {
    // read value from the pressed button
    let realRField = document.getElementById('real-r');
    realRField.value = e.target.value;

    // apply button style "selected" to selected button, remove this style from other buttons
    for (let currentRButton of rButtons) {
        currentRButton.classList.remove("r-button-pressed")
    }
    e.target.classList.add("r-button-pressed")
}

for (let currentRButton of rButtons) {
    currentRButton.addEventListener('click', rButtonPressed)
}