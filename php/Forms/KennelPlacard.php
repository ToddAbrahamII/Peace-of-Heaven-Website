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
        // $reservation -> get

    } else {
        Redirect::to('../UserHandling/login.php');
    }

    // GET reservation ID from URL
    $reservationId = $_GET['Res_ID'];

    // STORE reservation DATA
    $reservation->getReservationById($reservationId);

    // GET reservation DATA
    $reservationData = $reservation->getReservationData();
    
    // GET customer and dog IDs
    $customerId = $reservationData->CustID;
    $dogId = $reservationData->DogID;
    

    // STORE customer Data
    $customer->findCustInfoWithCustID($customerId);
    //STORE Dog Data
    $dog->findDogInfoWithDogID($dogId);

    // GET Customer and Dog DATA
    $customerData = $customer->getCustomerData();
    $dogData = $dog->data();

    // STORE health DATA for Dog
    $dogHealth = new DogHealth();
    $dogHealth->findHealthInfo($dogId);

    // GET HEALTH DATA for Dog
    $healthData = $dogHealth->getHealthInfo();

    




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
    <strong><?php echo $dogData->DogName; ?></strong>

    <label for="breed">Breed </label>
    <input type="text" name="breed" id="breed" value="<?php echo $dogData->Breed; ?>">

    <label for="age">Age </label>
    <input type="text" name="age" id="age" value="<?php echo $dogData->DogDOB; ?>">

    <label for="sex">Sex </label>
    <input type="text" name="sex" id="sex" value="<?php echo $dogData->Sex; ?>">

    <label>
        <input type="checkbox" name="fixedCheckbox" id="fixedCheckbox" <?php echo $dogData->isFixed ? 'checked' : ''; ?>> Spayed/Neutered
    </label>

    

    <!-- Add other pet-related inputs with values from $petData -->

</section>

<section>
    <h2>Owner:</h2>

    <label for="lastName">Last </label>
    <input type="text" name="lastName" id="lastName" value="<?php echo $customerData->CustLastName; ?>">

    <label for="firstName">First </label>
    <input type="text" name="firstName" id="firstName" value="<?php echo $customerData->CustFirstName; ?>">

    <label for="address">Address </label>
    <input type="text" name="address" id="address" value="<?php echo $customerData->CustAddress; ?>">

    <label for="cellPhone">Cell Phone </label>
    <input type="tel" id="cellPhone" name="cellPhone" placeholder="123-123-1234" required value="<?php echo $customerData->CustPhone; ?>">

    <label for="alternatePhone">Alternate Phone Number </label>
    <input type="tel" id="alternatePhone" name="alternatePhone" placeholder="123-123-1234">


    

</section>

<section>
    <h2>Care:</h2>

    <label for="feedingInstructions">Feeding Instructions </label>
    <input type="text" name="feedingInstructions" id="FeedingInstructions" value="<?php echo 'No Table for Data' ?>">

    <label for="grooming">Grooming </label>
    <input type="text" name="grooming" id="grooming" value="<?php echo 'I am not sure of the point of this. Is it for grooming appts only?'?>">

    <label for="medications">Medications </label>
    <input type="text" name="medications" id="medications" value="<?php echo $healthData->Medication; ?>">

    <label for="specialInstructions">Special Instructions </label>
    <input type="text" name="specialInstructions" id="specialInstructions" >

    <label for="dateIn">Date In </label>
    <input type="text" name="dateIn" id="dateIn" value="<?php echo $reservationData->ResStartTime ;?>">

    <label for="dateOut">Date Out </label>
    <input type="text" name="dateOut" id="dateOut" value="<?php echo $reservationData->ResEndTime ; ?>">

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
    <input type="text" name="owner" id="owner">

    <label for="date">Date </label>
    <input type="text" name="date" id="date" value="<?php echo date('Y-m-d'); ?>">
</section>

</fieldset>

<!-- Add submit button and close the form -->
<button onclick="printForm()">Print Placard</button>

<script>
   

    function printForm() {
        var printWindow = window.open('', '_blank');
        printWindow.document.write('<html><head>');
        printWindow.document.write('</head><body>');
        printWindow.document.write(document.querySelector('fieldset').outerHTML);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }
</script>
</form>
</body>
</html>
