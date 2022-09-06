function buttonPressed(e) {

}


const rButtons = document.getElementsByClassName("r-button");

for (let currentRButton of rButtons) {
    currentRButton.addEventListener('click', buttonPressed)
}