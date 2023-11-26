function validateForms() {
    // Behavior variables
    var Experience = document.forms["DogForms"]["Experience"].value;
    var isExperienceSelected = false;
    var isSocial = document.forms["DogForms"]["isSocial"].value;
    var isSocialSelected = false;
    var IsAggressive = document.forms["DogForms"]["IsAggressive"].value;
    var isAggressiveSelected = false;
    var AggressiveDesc = document.forms["DogForms"]["AggressiveDesc"].value;
    var IsJumper = document.forms["DogForms"]["IsJumper"].value;
    var isJumperSelected = false;
    var IsClimber = document.forms["DogForms"]["IsClimber"].value;
    var isClimberSelected = false;
    var IsChewer = document.forms["DogForms"]["IsChewer"].value;
    var isChewerSelected = false;
    var IsEscapeArtist = document.forms["DogForms"]["IsEscapeArtist"].value;
    var isEscapeSelected = false;
    var EscapeDesc = document.forms["DogForms"]["EscapeDesc"].value;
    var CanWater = document.forms["DogForms"]["CanWater"].value;
    var isWaterSelected = false;
    var CanTreat = document.forms["DogForms"]["CanTreat"].value;
    var isTreatSelected = false;
    var IsLeashTrained = document.forms["DogForms"]["IsLeashTrained"].value;
    var isLeashSelected = false;
    var IsRestriction = document.forms["DogForms"]["IsRestriction"].value;
    var isRestrictionSelected = false;
    var RestrictionDesc = document.forms["DogForms"]["RestrictionDesc"].value;
    var Toys = document.forms["DogForms"]["Toys"].value;
    var OtherBehaviorInfo = document.forms["DogForms"]["OtherBehaviorInfo"].value;
    var Reinforce = document.forms["DogForms"]["Reinforce"].value;
    var Commands = document.forms["DogForms"]["Commands"].value;
    var FoodPref = document.forms["DogForms"]["FoodPref"].value;
    var BathroomRoutine = document.forms["DogForms"]["BathroomRoutine"].value;

    // Behavior Checks
    if (Toys === "") {
        alert("Toys must be filled out");
        return false;
    }
    for (var i = 0; i < Experience.length; i++) {
        if (Experience[i].checked) {
            isExperienceSelected = true;
            break;
        }
    }
    if (!isExperienceSelected) {
        alert("Please select level of experience.");
        return false;
    }
    return true;

}
