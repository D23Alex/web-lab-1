function buttonPressed(e) {
    document.forms["main-form"]["r-input"].value = e.target.value;
}


const rButtons = document.getElementsByClassName("r-button");

for (let currentRButton of rButtons) {
    currentRButton.addEventListener('click', buttonPressed)
}