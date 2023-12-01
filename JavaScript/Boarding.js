function validateForms() {
    //Variables
    var emergencyContactName = document.forms["BoardingForm"]["emergencyContactName"].value;
    var emergencyContactPhone = document.forms["BoardingForm"]["emergencyContactPhone"].value;
    var ResDesc = document.forms["BoardingForm"]["ResDesc"].value;

    //Sanitize input
    emergencyContactName = sanitizeForInjection(emergencyContactName);
    emergencyContactPhone = sanitizePhone(emergencyContactPhone);
    ResDesc = sanitizeForInjection(ResDesc);


    //Makes sure all inputs are an acceptable length
    if (!isValidlength(emergencyContactName, 255)) {
        alert("Emergency contact field must be at most 255 characters long. Please find a way to shorten your response.");
        return false;    }
    if (!isValidPhone(emergencyContactPhone)) {
        alert("Please ensure the phone number is 10 digits");
        return false;    }    
    if (!isValidlength(ResDesc, 500)) {
        alert("Description must be at most 500 characters long. Please find a way to shorten your response.");
        return false;    }

    //If nothing fails
        return true;
}
//SANITIZATION FUNCTION
function sanitizeForInjection(input) {
    var sanitizedInput = input.replace(/[;'"\\<>&\/\(\)\*\|\+]/g, '');
    return sanitizedInput;
}
//VALIDATION FUNCTION
function isValidlength(input, maxLength) {
    return input.length <= maxLength;
}
// Check that is a valid phone number length
function isValidPhone(input) {
    if (input.length !== 10) {
        return false;
    }
    return true;
}
function sanitizePhone(input) {
    var sanitizedInput = input.replace(/[^0-9]/g, '');
    return sanitizedInput;
}