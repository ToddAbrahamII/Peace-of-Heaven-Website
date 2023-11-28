<?php

require_once'../UserHandling/core/init.php';


if (!Session::exists('home')) {
    echo '<p>'. Session::flash('home') .'</p>';
}

$user = new User();

    //Adds Employee NavBar if emp Acct logged in
    if($user->data()->group == 2) {
        include("../Employee Portal/EmpNavBar.php");

    }

    //Adds Admin NavBar if Admin Acct logged in
    if($user->data()->group == 3) {
        include("../AdminPortal/AdminNavBar.php");

    }


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

// print_r($dogData);
// print_r($reservationData);
// print_r($customerData);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POH Boarding Agreement</title>
    <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/BoardingAgreement.css">
</head>

<body>
<div class = 'content'>
    <h4>Peace of Heaven Pet Care, LLC | 30614 E 200 North Rd, Le Roy, IL | 309.712.3385</h4>

    <h1>POH Boarding Agreement</h1>

    <h2>Client Information</h2>
    <form id="Agreement">
        <label for="clientName">Client Name:</label>
        <input type="text" id="clientName" name="clientName" placeholder="Full Name"
        required value="<?php echo $dogData->DogName; ?>">



        <label for="dobAge">DOB/Age:</label>
        <input type="text" id="dobAge" name="dobAge" placeholder="Date of Birth / Age" required value="<?php echo $dogData->DogDOB; ?>">

        <label for="sex">Sex:</label>
        <input type="text" name="sex" id="sex" value="<?php echo $dogData->Sex; ?>">

        <label for="breed">Breed </label>
        <input type="text" name="breed" id="breed" value="<?php echo $dogData->Breed; ?>">

        <label for="color">Color:</label>
        <input type="text" id="color" name="color" value="<?php echo $dogData->Color; ?>">

        <label for="weight">Weight:</label>
        <input type="text" id="weight" name="weight" value="<?php echo $dogData->Weight; ?>">

        <label for="ownerNames">Owner Name(s):</label>
        <input type="text" id="ownerNames" name="ownerNames" placeholder="Full Names" required
               value="<?php echo $customerData->CustFirstName . ' ' . $customerData->CustLastName; ?>">

        <label for="address">Address </label>
        <input type="text" name="address" id="address" value="<?php echo $customerData->CustAddress; ?>">

        <label for="city">City:</label>
        <input type="text" id="city" name="city" required value="<?php echo $customerData->CustCity; ?>">

        <label for="state">State:</label>
        <input type="text" id="state" name="state" required value="<?php echo $customerData->CustState; ?>">

        <label for="zip">Zip:</label>
        <input type="text" id="zip" name="zip" required value="<?php echo $customerData->CustZip; ?>">

        <label for="cellPhone">Cell Phone:</label>
        <input type="tel" id="cellPhone" name="cellPhone" required value="<?php echo $customerData->CustPhone; ?>">

        <label for="secondPhone">2nd Phone:</label>
        <input type="tel" id="secondPhone" name="secondPhone">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $customerData->AcctEmail; ?>">

        <label for="emergencyContactName">Emergency Contact Name:</label>
        <input type="text" id="emergencyContactName" name="emergencyContactName" required value="<?php echo $reservationData->EmerContact; ?>">

        <label for="emergencyContactPhone">Phone:</label>
        <input type="tel" id="emergencyContactPhone" name="emergencyContactPhone" required value="<?php echo $reservationData->EmerPhone; ?>" >

        <h2>Expected duration of stay</h2>
        <label for="dropOffDate">From (date & time):</label>
        <input type="datetime-local" id="dropOffDate" name="dropOffDate" required value="<?php echo $reservationData->ResStartTime; ?>">

        <label for="pickUpDate">To (date & time):</label>
        <input type="datetime-local" id="pickUpDate" name="pickUpDate" required value="<?php echo $reservationData->ResEndTime; ?>">

        <h2>Health & Wellness Information</h2>
        <label for="clinicName">Clinic Name:</label>
        <input type="text" id="clinicName" name="clinicName" required value="<?php echo $healthData->ClinicName; ?>">

        <label for="clinicPhone">Phone:</label>
        <input type="tel" id="clinicPhone" name="clinicPhone" required value="<?php echo $healthData->VetPhone; ?>">

        <label for="clinicAddress">Address:</label>
        <input type="text" id="clinicAddress" name="clinicAddress" required value="<?php echo $healthData->VetAddress; ?>">

        <label for="clinicCity">City:</label>
        <input type="text" id="clinicCity" name="clinicCity" required value="<?php echo $healthData->VetCity; ?>">

        <label for="clinicState">State:</label>
        <input type="text" id="clinicState" name="clinicState" required value="<?php echo $healthData->VetState; ?>">

        <label for="clinicZip">Zip:</label>
        <input type="text" id="clinicZip" name="clinicZip" required value="<?php echo $healthData->VetZip; ?>">

        <label for="vetName">Preferred Veterinarian Name:</label>
        <input type="text" id="vetName" name="vetName" value="<?php echo $healthData->VetName; ?>">

        <h3>Vaccinations</h3>
        <p><strong>All dogs accepted for boarding must be vaccinated for DHPP, Rabies, & Bordetella</strong></p>
        <p><strong>Proof of current vaccination for all required vaccines must be shown upon arrival</strong></p>

        <label for="dhppDate">DHPP Date:</label>
        <input type="date" id="dhppDate" name="dhppDate" required>

        <label for="rabiesDate">Rabies Date:</label>
        <input type="date" id="rabiesDate" name="rabiesDate" required>

        <label for="bordetellaDate">Bordetella Date (6 or 12 mo.):</label>
        <input type="date" id="bordetellaDate" name="bordetellaDate" required>

        <h3>Preventatives</h3>
        <p><strong>Heartworm & flea/tick preventative treatments are recommended prior to boarding.</strong></p>
        <p><strong>If fleas/ticks are found on the client during the stay, the client will be treated at the owner’s expense.</strong></p>

        <label for="fleaTickProduct">Flea/Tick product:</label>
        <input type="text" id="fleaTickProduct" name="fleaTickProduct">

        <label for="lastDateGiven">Last date given:</label>
        <input type="date" id="lastDateGiven" name="lastDateGiven">

        <h3>Medical Information</h3>
        <label for="medicalConditions">Please list any medical conditions, mobility/vision/hearing impairments, and behavior problems of the client:</label>
        <textarea id="medicalConditions" name="medicalConditions" rows="4"></textarea>

        <h3>Entry Exam Observations (Section to be completed by POH staff upon client’s arrival):</h3>
        <textarea id="entryExamObservations" name="entryExamObservations" rows="4"></textarea>

        <h3>Owner’s signed initials indicate Entry Exam was witnessed by the owner & owner is aware of any & all findings as listed above.</h3>
        <label for="ownerInitials">Owner’s initials:</label>
        <input type="text" id="ownerInitials" name="ownerInitials" required>

        <label for="entryExamDate">Date:</label>
        <input type="date" id="entryExamDate" name="entryExamDate" required>

        <label for="ownerName">I, </label>
        <input type="text" id="ownerName" name="ownerName" placeholder="Your Name" required>

        <label for="petName">as owner of </label>
        <input type="text" id="petName" name="petName" placeholder="Pet Name" required>

        <p>
            understand that by not authorizing Peace of Heaven Pet Care, LLC owners and employees to make medical care
            decisions for my pet in the event of an emergency, worsening of condition or injury, and even
            death may occur to the pet as a result. I release Peace of Heaven Pet Care, LLC, its
            owner(s), and all employees of any liability, claims, expenses, and responsibilities.
        </p>

        <label for="signature">Signature </label>
        <input type="text" id="signature" name="signature" required>

        <label for="date">Date: </label>
        <input type="date" id="date" name="date" required>

        <h2>SOCIALIZATION PREFERENCES</h2>

        <p>Please initial next to the statement of your preference below:</p>

        <p>
            <input type="text" id="socialPlay" name="socialPlay" >
            <label for="socialPlay">I wish for my dog to participate in any and all social play and activities with other
                dogs and understand that my dog will be required to undergo a temperament assessment by
                POH staff prior to being accepted into social groups.</label>
        </p>

        <p>
            <input type="text" id="noSocialPlay" name="noSocialPlay" >
            <label for="noSocialPlay">I do not wish for my dog to participate in social play or activities with other dogs and
                understand that this decision does not jeopardize in any way the attention or active time
                given to my dog.</label>
        </p>

        <p>
            <strong>I have read and understand the information in its entirety included in this agreement
                and declare that all information provided is accurate. I also declare that I fully intend to
                return for my pet at the date and time listed above. If circumstances change due to
                unforeseen and unavoidable circumstances, I will notify POH immediately. I also understand
                that delayed pick-ups may be subject to additional charges at my expense. Furthermore, I
                understand that if I do not return for my pet within 30 days of the scheduled pick-up date, POH
                reserves the rights to my pet, according to the Animal Welfare Act of Illinois.</strong>
        </p>

        <p>Signature ________________________________________ Date: ____________________</p>

    </form>

    <div class="formButton">
    <button onclick="printForm()">Print Agreement</button>
    </div>
    <script>


        function printForm() {
            var printWindow = window.open('', '_blank');
            printWindow.document.write('<html><head>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(document.querySelector('form').outerHTML);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>
    </div>
</body>

</html>
