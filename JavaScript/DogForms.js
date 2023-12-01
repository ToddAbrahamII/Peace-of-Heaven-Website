var formValidate = false;

function validateForms() {
// Behavior variables
    var IsAggressive = document.forms["DogForms"]["IsAggressive"].value;
    var AggressiveDesc = document.forms["DogForms"]["AggressiveDesc"].value;
    var IsEscapeArtist = document.forms["DogForms"]["IsEscapeArtist"].value;
    var EscapeDesc = document.forms["DogForms"]["EscapeDesc"].value;
    var IsRestriction = document.forms["DogForms"]["IsRestriction"].value;
    var RestrictionDesc = document.forms["DogForms"]["RestrictionDesc"].value;
    var Toys = document.forms["DogForms"]["Toys"].value;
    var OtherBehaviorInfo = document.forms["DogForms"]["OtherBehaviorInfo"].value;
    var Reinforce = document.forms["DogForms"]["Reinforce"].value;
    var Commands = document.forms["DogForms"]["Commands"].value;
    var FoodPref = document.forms["DogForms"]["FoodPref"].value;
    var BathroomRoutine = document.forms["DogForms"]["BathroomRoutine"].value;
//Sanitize input
    AggressiveDesc = sanitizeForInjection(AggressiveDesc);
    EscapeDesc = sanitizeForInjection(EscapeDesc);
    RestrictionDesc = sanitizeForInjection(RestrictionDesc);
    Toys = sanitizeForInjection(Toys);
    OtherBehaviorInfo = sanitizeForInjection(OtherBehaviorInfo);
    Reinforce = sanitizeForInjection(Reinforce);
    Commands = sanitizeForInjection(Commands);
    FoodPref = sanitizeForInjection(FoodPref);
    BathroomRoutine = sanitizeForInjection(BathroomRoutine);
// Health Variables
    var ClinicName = document.forms["DogForms"]["ClinicName"].value;
    var VetPhone = document.forms["DogForms"]["VetPhone"].value;
    var VetAddress = document.forms["DogForms"]["VetAddress"].value;
    var VetCity = document.forms["DogForms"]["VetCity"].value;
    var VetState = document.forms["DogForms"]["VetState"].value;
    var VetZip = document.forms["DogForms"]["VetZip"].value;
    var VetName = document.forms["DogForms"]["VetName"].value;
    var MedicalCond = document.forms["DogForms"]["MedicalCond"].value;
    var Medication = document.forms["DogForms"]["Medication"].value;
//Sanitize input
    ClinicName = sanitizeForInjection(ClinicName);
    VetPhone = sanitizePhone(VetPhone);
    VetAddress = sanitizeForInjection(VetAddress);
    VetCity = sanitizeForInjection(VetCity);
    VetState = sanitizeForInjection(VetState);
    VetZip = sanitizeForInjection(VetZip);
    VetName = sanitizeForInjection(VetName);
    MedicalCond = sanitizeForInjection(MedicalCond);
    Medication = sanitizeForInjection(Medication);
//Vaccine Variables
    var FleaTickProduct = document.forms["DogForms"]["FleaTickProduct"].value;
    var OtherVacInfo = document.forms["DogForms"]["OtherVacInfo"].value;
//Sanitize input
    FleaTickProduct = sanitizeForInjection(FleaTickProduct);
    OtherVacInfo = sanitizeForInjection(OtherVacInfo);

// Behavior Checks
    //If the user responded 'Yes' to a radio button with a description, it makes the description required.
    if (IsAggressive === 1 && AggressiveDesc === "") {
        alert("You checked 'Yes' for an aggresive event. Please fill out a description");
        return false;    }
    if (IsEscapeArtist === 1 && EscapeDesc === "") {
        alert("You checked 'Yes' for being an escape artist. Please fill out a description");
        return false;    }
    if (IsRestriction === 1 && RestrictionDesc === "") {
        alert("You checked 'Yes' for an aggresive event. Please fill out a description");
        return false;    }

    //Makes sure all inputs are an acceptable length
    if (!isValidlength(AggressiveDesc, 500)) {
        alert("Your description of aggressive reactions must be at most 500 characters long. Please find a way to shorten your response.");
        return false;    }
    if (!isValidlength(EscapeDesc, 500)) {
        alert("Your description of your dog's escape attempts must be at most 500 characters long. Please find a way to shorten your response.");
        return false;    }
    if (!isValidlength(RestrictionDesc, 500)) {
        alert("Your description of activity/time restrictions must be at most 500 characters long. Please find a way to shorten your response.");
        return false;    }
    if (!isValidlength(Toys, 500)) {
        alert("Your description of favorite toys must be at most 500 characters long. Please find a way to shorten your response.");
        return false;    }
    if (!isValidlength(OtherBehaviorInfo, 500)) {
        alert("Your description of other behaviors must be at most 500 characters long. Please find a way to shorten your response.");
        return false;    }
    if (!isValidlength(Reinforce, 500)) {
        alert("Your list of things to reinforce must be at most 500 characters long. Please find a way to shorten your response.");
        return false;    }
    if (!isValidlength(Commands, 500)) {
        alert("Your list of known commands must be at most 500 characters long. Please find a way to shorten your response.");
        return false;    }
    if (!isValidlength(FoodPref, 500)) {
        alert("Your description of your dog's feeding schedule must be at most 500 characters long. Please find a way to shorten your response.");
        return false;    }
    if (!isValidlength(BathroomRoutine, 500)) {
        alert("Your description of your dog's potty routine must be at most 500 characters long. Please find a way to shorten your response.");
        return false;    }

//Health Checks
    //Checks for Correct format for uniques
    if (!isValidPhone(VetPhone)) {
        alert("Please ensure the phone number is 10 digits");
        return false;    }    
    if (!isValidState(VetState)) {
        alert("Please ensure your state is in state code format (Example: 'IL').");
        return false;    }    
    if (!isValidZip(VetZip)) {
        alert("Please make sure your zip code response is 5 digits long");
        return false;    }    
    //Makes sure all inputs are an acceptable length
    if (!isValidlength(ClinicName, 255)) {
        alert("The Clinic name must be at most 255 characters long. Please find a way to shorten your response.");
        return false;    }
    if (!isValidlength(VetAddress, 40)) {
        alert("The address must be at most 40 characters long. Please find a way to shorten your response.");
        return false;    }
    if (!isValidlength(VetCity, 30)) {
        alert("The city must be at most 30 characters long. Please find a way to shorten your response.");
        return false;    }
    if (!isValidlength(VetName, 30)) {
        alert("The Vet's name must not exceed 30 characters. Please find a way to shorten your response.");
        return false;    }
    if (!isValidlength(MedicalCond, 255)) {
        alert("Your list of conditions/impairments must be at most 255 characters long. Please find a way to shorten your response.");
        return false;    }
    if (!isValidlength(Medication, 255)) {
        alert("Your list of medications must be at most 255 characters long. Please find a way to shorten your response.");
        return false;    }
//Vaccine Checks
    //Makes sure all inputs are an acceptable length
    if (!isValidlength(FleaTickProduct, 50)) {
        alert("The name of the Flea/Tick product must be at most 50 characters long. Please find a way to shorten your response.");
        return false;    }
    if (!isValidlength(OtherVacInfo, 500)) {
        alert("Your other vaccination information must be at most 500 characters long. Please find a way to shorten your response.");
        return false;    }
//If nothing fails
    formValidate = true;
    return true;
}
//SANITIZATION FUNCTIONS
function sanitizeForInjection(input) {
    var sanitizedInput = input.replace(/[;'"\\<>&\/\(\)\*\|\+]/g, '');
    return sanitizedInput;
}
function sanitizePhone(input) {
    var sanitizedInput = input.replace(/[^0-9]/g, '');
    return sanitizedInput;
}
//VALIDATION FUNCTIONS
// Check if the input exceeds the maximum length
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
// Check that the state is in an "IL" format
function isValidState(input) {
    var stateRegex = /^[A-Za-z]{2}$/;
    return stateRegex.test(input);
}
// Check that the zip is in a "99999" format
function isValidZip(input) {
    var zipRegex = /^\d{5}$/;
    return zipRegex.test(input);
}

