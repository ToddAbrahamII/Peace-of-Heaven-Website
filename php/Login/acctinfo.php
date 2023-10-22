<?php
session_start(); //Starts the session -- REQUIRED ON EVERY PAGE --

    include("connection.php"); //Needed for making login required, calls other php page
    include("functions.php");//Needed for making login required, calls other php page
?>
<!DOCTYPE html>
<html>
<head>

</head>

<body>
    <form>
        <fieldset>

            <legend>Pet Information</legend>
            <p>
                <label for="client_name">Client Name:</label>
                <input type="text" name="client_name" id="client_name" required>

                <label for="breed">Breed:</label>
                <input type="text" name="breed" id="breed" required>

                <label for="dob">DOB:</label>
                <input type="date" name="dob" id="dob" required>

                <label for="sex"><br>Sex (choose one):</label>
                <select name="sex" id="sex" required>
                    <option value="f_unaltered">Female-unaltered</option>
                    <option value="f_spayed">Female-spayed</option>
                    <option value="m_unaltered">Male-unaltered</option>
                    <option value="m_neutered">Male-neutered</option>
                </select>

                <label for="weight">Weight:</label>
                <input type="text" name="weight" id="weight" required>

                <label for="color">Color:</label>
                <input type="text" name="color" id="color" required>

                <label for="allergies"><br>Allergies:</label>
                <textarea name="allergies" id="allergies"></textarea>
            </p>

            <legend>Owner Information</legend>
            <p>
                <label for="owner_name">Owner Name:</label> <!-- In the form there is an option for more than one -->
                <input type="text" name="owner_name" id="owner_name" required>

                <label for="address"><br>Address:</label>
                <input type="text" name="address" id="address" required>

                <label for="city"><br>City:</label>
                <input type="text" name="city" id="city" required>

                <label for="state">State:</label>
                <input type="text" name="state" id="state" required>

                <label for="zip">Zip:</label>
                <input type="text" name="zip" id="zip" required>

                <label for="cell_phone"><br>Cell Phone:</label>
                <input type="tel" id="cell_phone" name="cell_phone" placeholder="123-45-678" pattern="([0-9]{3})[0-9]{3}-[0-9]{4}" required>

                <label for="second_phone">2nd Phone:</label>
                <input type="tel" id="second_phone" name="second_phone" placeholder="123-45-678" pattern="([0-9]{3})[0-9]{3}-[0-9]{4}"> <!-- we'll have to add an optional field to the database-->

                <label for="email"><br>Email:</label>
                <input type="email" id="email" name="email" required> <!-- There is a multiple keyword that will allow multiple addresses-->

                <label for="emergency_contact"><br>Emergency Contact Name:</label>
                <input type="text" name="emergency_contact" id="emergency_contact">

                <label for="emergency_phone">Phone:</label>
                <input type="tel" id="emergency_phone" name="emergency_phone" placeholder="123-45-678" pattern="([0-9]{3})[0-9]{3}-[0-9]{4}">
            </p>

            <legend>HEALTH & WELLNESS INFORMATION</legend>
            <p>
                <label for="clinic_name">Clinic Name:</label>
                <input type="text" name="clinic_name" id="clinic_name">

                <label for="clinic_phone">Phone:</label>
                <input type="tel" id="clinic_phone" name="clinic_phone" placeholder="123-45-678" pattern="([0-9]{3})[0-9]{3}-[0-9]{4}" required>

                <label for="clinic_address"><br>Address:</label>
                <input type="text" name="clinic_address" id="clinic_address" required>

                <label for="city"><br>City:</label>
                <input type="text" name="clinic_city" id="clinic_city" required>

                <label for="state">State:</label>
                <input type="text" name="clinic_state" id="clinic_state" required>

                <label for="zip">Zip:</label>
                <input type="text" name="clinic_zip" id="clinic_zip" required>

                <label for="veterinarian"><br>Preferred Veterinarian Name:</label>
                <input type="text" name="veterinarian" id="veterinarian">
            </p>

            <legend>Vaccinations</legend>  
            <p>
                <p>**All dogs accepted for day care must be vaccinated for DHPP, Rabies, & Bordetella**<br>
                **Proof of current vaccination for all required vaccines must be shown upon arrival**</p>

                <label for="dhpp_date">DHPP Date:</label>
                <input type="date" name="dhpp_date" id="dhpp_date">

                <label for="rabies_date">Rabies Date:</label>
                <input type="date" name="rabies_date" id="rabies_date">

                <label for="bordetella_date">Bordetella Date(6 or 12 mo.):</label>
                <input type="date" name="bordetella_date" id="bordetella_date">
            </p>

            <legend>Preventatives</legend>
            <p>
                <p>*Heartworm & flea/tick preventative treatments are recommended for day care clients*<br>
                *If fleas/ticks are found on client during stay, client will be treated at owner's expense.*</p>

                <label for="flea_product"><br>Flea/Tick product:</label>
                <input type="text" name="flea_product" id="flea_product">

                <label for="flea_date">Last date given:</label>
                <input type="date" name="flea_date" id="flea_date">
            </p>

            <legend>Medical Conditions</legend>
            <p>
                <label for="medical_conditions">Please list below any medical conditions, mobility/vision/hearing impairments, and behavior problems of client:<br></label>
                <textarea name="medical_conditions" id="medical conditions"></textarea>
            </p>

            <legend>MEDICAL & EMERGENCY CARE</legend>
            <p>
                ***PLEASE READ: If medical concerns arise, we will attempt to reach owner first then <br>
                emergency contact, if time allows. If unable to reach anyone, and POH staff determines <br>
                medical care is necessary, client will be taken to either preferred vet listed, nearest vet, or <br>
                Animal Emergency Clinic of McLean County. The decision on where to take client will be <br>
                based on the safety and stability of client. All charges incurred will be at owner&#39s expense.
                
            </p>

            <legend>release of liability</legend>
            <p>

            </p>

            <legend>SOCIALIZATION PREFERENCES</legend>
            <p>
                <p>Please initial next to the statement of your preference below.</p>

                <input type="radio" name="participate" id="participate_yes" value="yes">
                <label for="participate">I wish for my dog to participate in any and all social play and activities with
                     other dogs and understand that my dog will be required to undergo a temperament 
                     assessment by POH staff prior to being accepted into social groups.<br></label>

                <input type="radio" name="participate" id="participate_no" value="no">
                <label for="participate">I do not wish for my dog to participate in social play or activities with other dogs 
                    and understand that this decision does not jeopardize in any way the attention or active 
                    time given to my dog. </label>
            </p>

            <legend>Terms</legend>
            <p>
                <input type="checkbox" id="terms" name="terms" value="agree">
                <label for="terms">I have read and understand the information in its entirety included in this 
                    agreement and declare that all information provided is accurate. I also declare that I 
                    fully intend to return for my pet at the date and time listed above. If circumstances 
                    change due to unforeseen and unavoidable circumstances, I will notify POH immediately. 
                    I also understand that delayed pick-ups may be subject to additional charges at my 
                    expense. Furthermore, I understand that if I do not return for my pet within 30 days of 
                    scheduled pick-up date, POH reserves the rights to my pet, according to the Animal 
                    Welfare Act of Illinois.</label>
            </p>

        </fieldset>
    </form>

</body>
    
</html>