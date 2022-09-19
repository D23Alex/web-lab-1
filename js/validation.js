class ValidationResult {
    _isValid;
    _validationMessage;

    constructor(isValid, issueMessage) {
        this._isValid = isValid;
        this._validationMessage = issueMessage;
    }

    get isValid() {
        return this._isValid;
    }

    set isValid(value) {
        this._isValid = value;
    }

    get validationMessage() {
        return this._validationMessage;
    }

    set validationMessage(value) {
        this._validationMessage = value;
    }
}

function validateMainForm() {
    let xValidationResult = validateXInput();
    let yValidationResult = validateYInput();
    let rValidationResult = validateRInput();
    constructValidationDivs(xValidationResult, yValidationResult, rValidationResult);
    if (xValidationResult._isValid == false || yValidationResult._isValid == false || rValidationResult._isValid == false) {
        return false
    }
    return true
}

function validateXInput() {
    var x = document.forms["main-form"]["x-input"].value;
    if (x == null || x === "") {
        return new ValidationResult(false, "fill in the value of x")
    }
    return new ValidationResult(true, "OK")
}

function validateYInput() {
    var minYValue = -3;
    var maxYValue = 3;

    var yInput = document.forms["main-form"]["y-input"];
    if (yInput.value == null || yInput.value === "") {
        return new ValidationResult(false, "fill in the value of y")
    }

    if (yInput.value.length > 10) {
        return new ValidationResult(false, "too many characters in this input")
    }

    if (yInput.value.charAt(0) === ".") {
        return new ValidationResult(false, "this field cannot start with a period");
    }

    var acceptableValues = [".", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9"]
    for (var i = 0; i < yInput.value.length; i++) {
        if (!acceptableValues.includes(yInput.value.charAt(i))) {
            return new ValidationResult(false, "this field must be a an integer or a float, '.' separator must be used");
        }
    }

    if (minYValue > parseFloat(yInput.value) || maxYValue < parseFloat(yInput.value)) {
        return new ValidationResult(false, "the value of y is out of range");
    }

    return new ValidationResult(true, "OK");
}

function validateRInput() {
    var r = document.forms["main-form"]["r-input"].value;
    if (r == null | r === "") {
        return new ValidationResult(false, "fill in the value of r")
    }
    return new ValidationResult(true, "OK")
}

function constructValidationDivs(xValidationResult, yValidationResult, rValidationResult) {
    let xValidationDiv = document.getElementById('x-validation-result');
    let yValidationDiv = document.getElementById('y-validation-result');
    let rValidationDiv = document.getElementById('r-validation-result');

    if (xValidationResult._isValid) {
        xValidationDiv.classList.remove("invalid")
        xValidationDiv.classList.add("valid")
    }
    xValidationDiv.title = xValidationResult._validationMessage;

    if (yValidationResult._isValid) {
        yValidationDiv.classList.remove("invalid")
        yValidationDiv.classList.add("valid")
    }
    yValidationDiv.title = yValidationResult._validationMessage;

    if (rValidationResult._isValid) {
        rValidationDiv.classList.remove("invalid")
        rValidationDiv.classList.add("valid")
    }
    rValidationDiv.title = rValidationResult._validationMessage;
}