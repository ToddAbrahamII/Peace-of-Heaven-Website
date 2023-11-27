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
// Health Variables

//Vaccine Variables

// Behavior Checks
    //Checks for AlphaNumeric only (injection prevention?)
    if (!isValidChars(AggressiveDesc)) {
        alert("Please only use alphabetic and numeric characters in your response");
        return false;    }
    if (!isValidChars(EscapeDesc)) {
        alert("Please only use alphabetic and numeric characters in your response");
        return false;    }   
    if (!isValidChars(RestrictionDesc)) {
        alert("Please only use alphabetic and numeric characters in your response");
        return false;    }    
    if (!isValidChars(Toys)) {
        alert("Please only use alphabetic and numeric characters in your response");
        return false;    }    
    if (!isValidChars(OtherBehaviorInfo)) {
        alert("Please only use alphabetic and numeric characters in your response");
        return false;    }    
    if (!isValidChars(Reinforce)) {
        alert("Please only use alphabetic and numeric characters in your response");
        return false;    }    
    if (!isValidChars(Commands)) {
        alert("Please only use alphabetic and numeric characters in your response");
        return false;    }
    if (!isValidChars(FoodPref)) {
        alert("Please only use alphabetic and numeric characters in your response");
        return false;    }    
    if (!isValidChars(BathroomRoutine)) {
        alert("Please only use alphabetic and numeric characters in your response");
        return false;    }

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

//Vaccine Checks


}

// Check that the input contains only alphanumeric characters
function isValidChars(input) {
    var alphanumericRegex = /^[a-zA-Z0-9]+$/;
    return alphanumericRegex.test(input);
}

// Check if the input exceeds the maximum length
function isValidlength(input, maxLength) {
    return input.length <= maxLength;
}