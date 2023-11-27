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

    // Behavior Checks
    if (IsAggressive === 1 && AggressiveDesc === "") {
        alert("You checked 'Yes' for an aggresive event. Please fill out a description");
        return false;
    }
    if (IsEscapeArtist === 1 && EscapeDesc === "") {
        alert("You checked 'Yes' for being an escape artist. Please fill out a description");
        return false;
    }
    if (IsRestriction === 1 && RestrictionDesc === "") {
        alert("You checked 'Yes' for an aggresive event. Please fill out a description");
        return false;
    }

    if (!isValidInput(AggressiveDesc, 500)) {
        alert("Your description of aggressive reactions must be at most 500 characters long. Please find a way to shorten your response.");
        return false;
    }
    if (!isValidInput(EscapeDesc, 500)) {
        alert("Your description of your dog's escape attempts must be at most 500 characters long. Please find a way to shorten your response.");
        return false;
    }
    if (!isValidInput(RestrictionDesc, 500)) {
        alert("Your description of activity/time restrictions must be at most 500 characters long. Please find a way to shorten your response.");
        return false;
    }

    if (!isValidInput(Toys, 500)) {
        alert("Your description of favorite toys must be at most 500 characters long. Please find a way to shorten your response.");
        return false;
    }
    if (!isValidInput(OtherBehaviorInfo, 500)) {
        alert("Your description of other behaviors must be at most 500 characters long. Please find a way to shorten your response.");
        return false;
    }
    if (!isValidInput(Reinforce, 500)) {
        alert("Your list of things to reinforce must be at most 500 characters long. Please find a way to shorten your response.");
        return false;
    }
    if (!isValidInput(Commands, 500)) {
        alert("Your list of known commands must be at most 500 characters long. Please find a way to shorten your response.");
        return false;
    }
    if (!isValidInput(FoodPref, 500)) {
        alert("Your description of your dog's feeding schedule must be at most 500 characters long. Please find a way to shorten your response.");
        return false;
    }
    if (!isValidInput(BathroomRoutine, 500)) {
        alert("Your description of your dog's potty routine must be at most 500 characters long. Please find a way to shorten your response.");
        return false;
    }


}


// Check if the input exceeds the maximum length

function isValidInput(input, maxLength) {
    return input.length <= maxLength;
}