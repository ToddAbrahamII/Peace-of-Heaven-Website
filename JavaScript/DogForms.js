function validateForms() {
    var Experience = document.forms["DogForms"]["Experience"].value;
    var isExperienceSelected = false;
    var isSocial = document.forms["DogForms"]["isSocial"].value;
    var isSocialSelected = false;
    var IsAggressive = document.forms["DogForms"]["IsAggressive"].value;
    var isAggressiveSelected = false;

    var name = document.forms["DogForms"]["name"].value;
    var name = document.forms["DogForms"]["name"].value;
    var name = document.forms["DogForms"]["name"].value;
    var name = document.forms["DogForms"]["name"].value;
    var name = document.forms["DogForms"]["name"].value;
    var name = document.forms["DogForms"]["name"].value;
    var name = document.forms["DogForms"]["name"].value;
    var name = document.forms["DogForms"]["name"].value;

    if (name === "") {
        alert("Name must be filled out");
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
