class ValidationResult {
    _isValid;

    get isValid() {
        return this._isValid;
    }

    set isValid(value) {
        this._isValid = value;
    }

    get issue() {
        return this._issue;
    }

    set issue(value) {
        this._issue = value;
    }
}

function validateMainForm() {
    let xValidationResult = validateXInput();
    let yValidationResult = validateYInput();
    let rValidationResult = validateRInput();
}

function validateXInput() {
    var x = document.forms["main-form"]["x-input"].value;
}

function validateYInput() {

}

function validateRInput() {

}