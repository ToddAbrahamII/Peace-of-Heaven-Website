function validateForms() {
    //Vaccine Variables
    var DogName = document.forms["DogAccountInfo"]["DogName"].value;
    var Breed = document.forms["DogAccountInfo"]["Breed"].value;
    var Weight = document.forms["DogAccountInfo"]["Weight"].value;
    var Color = document.forms["DogAccountInfo"]["Color"].value;
    var DogOtherInfo = document.forms["DogAccountInfo"]["DogOtherInfo"].value;

    //Sanitize input
    DogName = sanitizeForInjection(DogName);
    Breed = sanitizeForInjection(Breed);
    Weight = sanitizeForInjection(Weight);
    Color = sanitizeForInjection(Color);
    DogOtherInfo = sanitizeForInjection(DogOtherInfo);

    if(!isNumber(weight)){
        alert("Please enter weight as a 2-3 digit number (lbs is assumed).");
        return false;    }
    //Vaccine Checks
        //Makes sure all inputs are an acceptable length
    if (!isValidlength(DogName, 30)) {
        alert("Dog name must be at most 30 characters long. Please find a way to shorten your response.");
        return false;    }
    if (!isValidlength(Breed, 30)) {
        alert("The information about the breed must be at most 30 characters long. Please find a way to shorten your response.");
        return false;    }
    if (!isValidlength(Weight, 3)) {
        alert("Please enter weight as a 2-3 digit number (lbs is assumed).");
        return false;    }
    if (!isValidlength(Color, 16)) {
        alert("description of color must be at most 16 characters long. Please find a way to shorten your response.");
        return false;    }
    if (!isValidlength(DogOtherInfo, 500)) {
        alert("Other dog information must be at most 500 characters long. Please find a way to shorten your response.");
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
//NUMBER FUNCTION
function isNumber(input)
{
    var weightRegex = /^[0-9]+$/;
    return weightRegex.test(input);
}
