<?php
session_start(); //Starts the session -- REQUIRED ON EVERY PAGE --

    include("connection.php"); //Needed for making login required, calls other php page
    include("functions.php");//Needed for making login required, calls other php page
?>

<!DOCTYPE html>
<html lang="en">
    <head>

    </head>

    <body>
    <form action="" method="post">
            <fieldset>

            <legend>Placard</legend> 

            <div>
                <H2>Pet:</H2>
                <label for="dogName">Name </label>
                <input type="text" name="dogName" id="dogName">

                <label for="breed">Breed </label>
                <input type="text" name="breed" id="breed">

                <label for="age">Age </label>
                <input type="text" name="age" id="age">

                <label for="sex">Sex </label>
                <input type="text" name="sex" id="sex">
                <br>

                <label>
                <input type="checkbox" name="allergiesCheck" id="allergiesCheck"> Allergies
                </label>
                
                <label>
                <input type="checkbox" name="spayedNeuteredCheck" id="allergiesCheck"> Spayed/Neutered
                </label>
                
                <label>
                <input type="checkbox" name="vaccinationsCurrentCheck" id="vaccinationsCurrentCheck"> Vaccinations Current
                </label>

                <br>

                <label for="allergies">Allergies </label>
                <input type="text" name="allergies" id="allergies">

                <br>

                <label for="vetInfo">Vet Info </label>
                <input type="text" name="vetInfo" id="vetInfo">

                <H2>Owner:</H2>

                <label for="lastName">Last </label>
                <input type="text" name="lastName" id="lastName">

                <label for="firstName">First </label>
                <input type="text" name="firstName" id="firstName">

                <br>

                <label for="address">Address </label>
                <input type="text" name="address" id="address">

                <br>

                <label for="homePhone">Home Phone </label>
                <input type="tel" id="homePhone" name="homePhone" placeholder="123-123-1234" pattern="([0-9]{3})[0-9]{3}-[0-9]{4}" required>

                <label for="cellPhone">Cell Phone </label>
                <input type="tel" id="cellPhone" name="cellPhone" placeholder="123-123-1234" pattern="([0-9]{3})[0-9]{3}-[0-9]{4}" required>

                <h2>Care:</h2>

                <label for="feedingInstructions">Feeding Instructions </label>
                <input type="text" name="feedingInstructions" id="FeedingInstructions">

                <br>

                <label for="grooming">Grooming </label>
                <input type="text" name="grooming" id="grooming">

                <br>

                <label for="medications">Medications </label>
                <input type="text" name="medications" id="medications">

                <br>

                <label for="specialInstructions">Special Instructions </label>
                <input type="text" name="specialInstructions" id="specialInstructions">

                <br>

                <label for="dateIn">Date In </label>
                <input type="text" name="dateIn" id="dateIn">

                <label for="dateOut">Date Out </label>
                <input type="text" name="dateOut" id="dateOut">

                <p>
                    I, <?php #$firstName = "John Smith"; print $firstName; ?>
                    , certify that I am the owner of this pet, and I grant 
                    permission to this facility and its staff to obtain on my behalf and in my pets' best interest the veterinary 
                    care necessary to treat illness or injury. I agree to pay all veterinary and other necessary services incurred by 
                    and for my pet during its stay in this facility. This facility agrees to exercise due and reasonable care to 
                    prevent injury or illness to my pet. However, in the event of illness or injury, the facility and its owners and 
                    staff shall not be held liable for such injury or illness. I agree to pay all charges the day I pick up my pet and I 
                    understand that my pet may not leave the premises until all charges are paid in full. I understand that any 
                    animal left for ten days beyond the estimated date of pick up will be considered abandoned.
                </p>

                <label for="owner">Owner </label>
                <input type="text" name="owner" id="owner">

                <label for="date">Date </label>
                <input type="text" name="date" id="date">

                <h2>How did you hear about us?</h2>

                <label>
                    <input type="checkbox" name="location" value="Location"> Location
                </label>
                
                <label>
                    <input type="checkbox" name="google" value="Google"> Google
                </label>
                
                <label>
                    <input type="checkbox" name="facebook" value="Facebook"> Facebook
                </label>
                
                <br>

                <label>
                    <input type="checkbox" name="referral" value="Referral"> Referral
                </label>
                <input type="text" name="referralText" id="referralText" class="hidden" placeholder="Enter referral details">
                
                <label>
                    <input type="checkbox" name="other" value="Other"> Other
                </label>
                <input type="text" name="otherText" id="otherText" class="hidden" placeholder="Enter other details">
                

            </div>

            </fieldset>
    </form>

</body>

