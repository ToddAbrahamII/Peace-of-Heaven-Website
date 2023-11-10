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
                <label for="DogName">Name </label>
                <input type="text" name="DogName" id="DogName">

                <label for="Breed">Breed </label>
                <input type="text" name="Breed" id="Breed">

                <label for="Age">Age </label>
                <input type="text" name="Age" id="Age">

                <label for="Sex">Sex </label>
                <input type="text" name="Sex" id="Sex">

                <label>
                <input type="checkbox" name="allergies" id="allergies"> Allergies
                </label>
                <br>
                <label>
                <input type="checkbox" name="spayedNeutered" id="allergies"> Spayed/Neutered
                </label>
                <br>
                <label>
                <input type="checkbox" name="vaccinationsCurrent" id="vaccinationsCurrent"> Vaccinations Current
                </label>

                <label for="Allergies">Allergies </label>
                <input type="text" name="Allergies" id="Allergies">

            </div>

            </fieldset>
    </form>

</body>

