<?php
    require_once'../UserHandling/core/init.php';


    if (!Session::exists('home')) {
        echo '<p>'. Session::flash('home') .'</p>';
    } 

    $user = new User();

    if($user->isLoggedIn()) {
        // Constructor Calls
        $customer = new Customer();
        $dog = new Dog();
        $reservation = new Reservation('service', array()); // Fake constructor

        ## Gather all Data
        $reservation -> get

    } else {
        Redirect::to('../UserHandling/login.php');
    }




?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kennel Placard</title>
</head>
<body>
<form action="#" method="post">

    <fieldset>
        <legend>Placard</legend>

<section>
    <h2>Pet:</h2>

    <label for="dogName">Name </label>
    <strong><?php echo $petData['dogName']; ?></strong>

    <label for="breed">Breed </label>
    <input type="text" name="breed" id="breed" value="<?php echo $petData['breed']; ?>">

    <label for="age">Age </label>
    <input type="text" name="age" id="age" value="<?php echo $petData['age']; ?>">

    <label for="sex">Sex </label>
    <input type="text" name="sex" id="sex" value="<?php echo $petData['sex']; ?>">

    <label>
        <input type="checkbox" name="allergiesCheck" id="allergiesCheck" <?php echo $petData['allergiesCheck'] ? 'checked' : ''; ?>> Allergies
    </label>

    <!-- Add other pet-related inputs with values from $petData -->

</section>

<section>
    <h2>Owner:</h2>

    <label for="lastName">Last </label>
    <input type="text" name="lastName" id="lastName" value="<?php echo $ownerData['lastName']; ?>">

    <label for="firstName">First </label>
    <input type="text" name="firstName" id="firstName" value="<?php echo $ownerData['firstName']; ?>">

    <label for="address">Address </label>
    <input type="text" name="address" id="address" value="<?php echo $ownerData['address']; ?>">

    <label for="homePhone">Home Phone </label>
    <input type="tel" id="homePhone" name="homePhone" placeholder="123-123-1234" pattern="([0-9]{3})[0-9]{3}-[0-9]{4}" required value="<?php echo $ownerData['homePhone']; ?>">

    <label for="cellPhone">Cell Phone </label>
    <input type="tel" id="cellPhone" name="cellPhone" placeholder="123-123-1234" pattern="([0-9]{3})[0-9]{3}-[0-9]{4}" required value="<?php echo $ownerData['cellPhone']; ?>">

    <!-- Add other owner-related inputs with values from $ownerData -->

</section>

<section>
    <h2>Care:</h2>

    <label for="feedingInstructions">Feeding Instructions </label>
    <input type="text" name="feedingInstructions" id="FeedingInstructions" value="<?php echo $careData['feedingInstructions']; ?>">

    <label for="grooming">Grooming </label>
    <input type="text" name="grooming" id="grooming" value="<?php echo $careData['grooming']; ?>">

    <label for="medications">Medications </label>
    <input type="text" name="medications" id="medications" value="<?php echo $careData['medications']; ?>">

    <label for="specialInstructions">Special Instructions </label>
    <input type="text" name="specialInstructions" id="specialInstructions" value="<?php echo $careData['specialInstructions']; ?>">

    <label for="dateIn">Date In </label>
    <input type="text" name="dateIn" id="dateIn" value="<?php echo $careData['dateIn']; ?>">

    <label for="dateOut">Date Out </label>
    <input type="text" name="dateOut" id="dateOut" value="<?php echo $careData['dateOut']; ?>">

    <!-- Add other care-related inputs with values from $careData -->

</section>

<section>
    <p>
        I, <?php /* Your PHP code here */ ?>, certify that I am the owner of this pet, and I grant
        permission to this facility and its staff...
    </p>
</section>

<section>
    <label for="owner">Owner </label>
    <input type="text" name="owner" id="owner" value="<?php echo $ownerData['lastName'] . ', ' . $ownerData['firstName']; ?>">

    <label for="date">Date </label>
    <input type="text" name="date" id="date" value="<?php echo date('Y-m-d'); ?>">
</section>

</fieldset>

<!-- Add submit button and close the form -->
<input type="submit" value="Submit">
</form>
</body>
</html>
