<?php
    require_once '../UserHandling/core/init.php';
    
    //Make sure session is logged in
    if (!Session::exists('home')) {
        echo '<p>'. Session::flash('home') .'</p>';
    }

    //Class Constructor Calls
    $user = new User();
    $customer = new Customer();
    $dog = new Dog();

    //Checks if user is logged in
    if($user->isLoggedIn()) {

    //Adds Customer NavBar if Customer Acct logged in
    if($user->data()->group == 1){
        include("../Customer Portal/CustNavBar.php");
    }

    //Adds Employee NavBar if Employee Acct logged in
    if($user->data()->group == 2){
        include("../Employee Portal/EmpNavBar.php");
    }

    //Adds Admin NavBar if Admin Acct logged in
    if($user->data()->group == 3 ){
        include("../AdminPortal/AdminNavBar.php");
    }

        //Grabs all sessions variables from the previous page
    if (isset($_GET['dogid']) && isset($_GET['service'])) {
            $_SESSION['dogid'] = $_GET['dogid'];
            $_SESSION['service'] = $_GET['service'];
        
        }

    $user = new User(); //constructor call
    $customer = new Customer(); //constructor call 
    
    //checks if user is logged in
    if ($user->isLoggedIn()) {
    
        if(Input::exists()) {
    
            if(Token::check(Input::get('token'))) {
    
                $validate = new Validate();
                $validation = $validate->check($_POST, array(
                    ### Insert rules that acctInfo fields must meet in addition to js validation ###
                    /**'dhpp_date' => array( 
                        'name' => 'DHPP Date',
                        'required' => true,
                    ),
                    'rabies_date' => array(
                        'name' => 'Rabies Date',
                        'required' => true,
                    ),
                    'bordetella_date' => array(
                        'name' => 'Bordetella Date',
                        'required' => true,
                        'matches' => 'password'
                    ),
                    'flea_product' => array( 
                        'name' => 'Flea Product',
                        'required' => true,
                        'min' => 2,
                        'max' => 80,
                        'unique' => 'users'
                    ),
                    'flea_date' => array(
                        'name' => 'Flea Date',
                        'required' => true,
                        'min' => 6
                    ),
                    'other_vac_info' => array(
                        'name' => 'Other Vac Info',
                        'required' => true,
                        'matches' => 'password'
                    )*/
                ));
    
                // If all rules are satisfied, create new customer
                if($validation->passed()) {

                    if(Input::exists()){

                    try{
                        //Creates array of all input to be inserted into Dog Behavior table
                        $dog = new Dog(); //constructor call
                        $customer->findCustInfo($user->data()->id); //Finds matching user id
                        $custid = $customer->data()->CustID; //stores the customer id
                        $dogid = $_SESSION['dogid'];

                        $dog->createBehaviorRecord(array(

                            'Experience' => Input::get('Experience'),
                            'IsSocial' => Input::get('IsSocial'),
                            'IsAggressive' => Input::get('IsAggressive'),
                            'AggressiveDesc' => Input::get('AggressiveDesc'),
                            'IsJumper' => Input::get('IsJumper'),
                            'IsClimber' => Input::get('IsClimber'),
                            'IsChewer' => Input::get('IsChewer'),
                            'IsEscapeArtist' => Input::get('IsEscapeArtist'),
                            'EscapeDesc' => Input::get('EscapeDesc'),
                            'CanWater' => Input::get('CanWater'),
                            'CanTreat' => Input::get('CanTreat'),
                            'IsRestriction' => Input::get('IsRestriction'),
                            'RestrictionDesc' => Input::get('RestrictionDesc'),
                            'Toys' => Input::get('Toys'),
                            'OtherBehaviorInfo' => Input::get('OtherBehaviorInfo'),
                            'Reinforce' => Input::get('Reinforce'),
                            'Commands' => Input::get('Commands'),
                            'IsLeashTrained' => Input:: get('IsLeashTrained'),
                            'FoodPref' => Input::get('FoodPref'),
                            'BathroomRoutine' => Input::get('BathroomRoutine'),
                            'DogID' =>  $_SESSION['dogid'],
                        ));
                        
                        $dog->createHealthRecord(array(
                            'ClinicName' => Input::get('ClinicName'),
                            'VetAddress' => Input::get('VetAddress'),
                            'VetCity' => Input::get('VetCity'),
                            'VetState' => Input::get('VetState'),
                            'VetZip' => Input::get('VetZip'),
                            'VetPhone' => Input::get('VetPhone'),
                            'VetName' => Input::get('VetName'),
                            'MedicalCond' => Input::get('MedicalCond'),
                            'Medication' => Input::get('Medication'),
                            'DogID' =>  $_SESSION['dogid'],
                        ));

                        $dog->createVaccineRecord(array(
                            'DHPP_Date' => Input::get('DHPP_Date'),
                            'RabiesDate' => Input::get('RabiesDate'),
                            'BordellaDate' => Input::get('BordellaDate'),
                            'FleaTickProduct' => Input::get('FleaTickProduct'),
                            'FleaTickDate' => Input::get('FleaTickDate'),
                            'OtherVacInfo' => Input::get('OtherVacInfo'),
                            'DogID' => $_SESSION['dogid'],
                        ));
                        
                        //Update Forms Value to 1
                            //DB Instance for Update
                            $db = DB::getInstance();

                        
                            //sets table and fields
                            $table = 'dog';
                            $id = $dogid;
                            $idcolumn = 'DogID';
                            $fields = array(
                            //Updates the dog to HasForms
                                'HasForms' => 1,
                                            );
                        
                            //updates
                            $db->updateWithID($table, $id, $idcolumn, $fields);

                        //Add if statements to know which form to redirect to
                        if($_SESSION['service'] == 'Boarding'){
                            Redirect::to('../Forms/BoardingForm.php?dogid='.$dogid . '&custid=' . $custid);
                        }

                        if($_SESSION['service'] == 'Daycare'){
                            Redirect::to('../Forms/DayCareForm.php?dogid='.$dogid . '&custid=' . $custid);
                        }
    
                    }
                    catch(Exception $e) {
                        die($e->getMessage());
                        
                    }
                    }else {
                        // output errors
                        foreach ($validation->errors() as $error) {
                            echo $error, '<br>';
                    }   
                }
            }
            }
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/DogForms.css">
    <script src="DogForms.js" defer></script>
</head>

<body>
    <div class='content'>
        <form class="DogInfo-Form" name="DogForms" method="POST" onsubmit="return validateForms()">
            <fieldset>
                <!-- Collects information for DogBehavior Table -->
                <legend>Dog Behavior Information</legend>
            <p>
                    <legend>1. What is your dog's previous daycare and/or boarding experience</legend>
                        <input type="radio" id="rad" name="Experience" value="0" REQUIRED>
                        <label for="rad">a. Never attempted either</label>
                        <br>
                        <input type="radio" id="rad" name="Experience" value="1">
                        <label for="rad">b. Boarding and/or daycare client in past but no more than twice a
                            year</label>
                            <br>
                        <input type="radio" id="rad" name="Experience" value="2">
                        <label for="rad">c. Has been at least once but stresses easily or does not adjust
                            well to unfamiliar environments</label>
                            <br>
                        <input type="radio" id="rad" name="Experience" value="3">
                        <label for="rad">d. Boarded regularly & adjusts easily</label>
                        <br>
                        <input type="radio" id="rad" name="Experience" value="4">
                        <label for="rad">e. Attends daycare often & socializes well</label>
                    <br><br>
                    <legend>2. Do you want your dog to engage in social play with dogs of like-size & similar
                        temperament?</legend>
                        <input type="radio" id="T" name="isSocial" value="1" REQUIRED>
                        <label for="T">YES</label>
                        <input type="radio" id="F" name="isSocial" value="0">
                        <label for="F">NO</label>
                    <br><br>
                    <legend>3. Has your dog ever growled, snipped, bit, or shown any other aggressive reaction
                        towards people or pets?</legend>
                        <input type="radio" id="T" name="IsAggressive" value="1" REQUIRED>
                        <label for="T">YES</label>
                        <input type="radio" id="F" name="IsAggressive" value="0">
                        <label for="F">NO</label>
                    <br> &nbsp;&nbsp;
                    <!-- Temp. tabs until we decide if we want to put text areas in divs and format with CSS-->
                    <label for="AggressiveDesc">If yes, please provide a brief description of
                        encounter(s).</label>
                    <br> &nbsp;&nbsp;
                    <textarea name="AggressiveDesc" id="AggressiveDesc"></textarea>
                    <br><br>
                    <legend>4. Is your dog a...</legend>
                    <label>a. Jumper? </label>
                        <input type="radio" id="T" name="IsJumper" value="1" REQUIRED>
                        <label for="T">YES</label>
                        <input type="radio" id="F" name="IsJumper" value="0">
                        <label for="F">NO</label>
                    <br>
                    <label>b. Climber? </label>

                        <input type="radio" id="T" name="IsClimber" value="1" REQUIRED>
                        <label for="T">YES</label>

                        <input type="radio" id="F" name="IsClimber" value="0">
                        <label for="F">NO</label>
                    <br>
                    <label>c. Aggressive chewer? </label>

                        <input type="radio" id="T" name="IsChewer" value="1" REQUIRED>
                        <label for="T">YES</label>
                        <input type="radio" id="F" name="IsChewer" value="0">
                        <label for="F">NO</label>
                    <br>
                    <label>d. Escape artist of any kind? </label>

                        <input type="radio" id="T" name="IsEscapeArtist" value="1" REQUIRED>
                        <label for="T">YES</label>

                        <input type="radio" id="F" name="IsEscapeArtist" value="0">
                        <label for="F">NO</label>
                    <br> &nbsp;&nbsp;
                    <label for="EscapeDesc">If yes to escape artist, please describe his/her escaping
                        abilities.</label>
                    <br> &nbsp;&nbsp;
                    <textarea name="EscapeDesc" id="EscapeDesc"></textarea>
                    <br><br>
                    <legend>5. Do you prefer your dog to participate in water activities (weather
                        permitting)?</legend>
                        <input type="radio" id="T" name="CanWater" value="1" REQUIRED>
                        <label for="T">YES</label>
                        <input type="radio" id="F" name="CanWater" value="0">
                        <label for="F">NO</label>
                    <br><br>
                    <legend>6. Is your dog permitted to have edible treats? </legend>

                        <input type="radio" id="T" name="CanTreat" value="1" REQUIRED>
                        <label for="T">YES</label>
                        <input type="radio" id="F" name="CanTreat" value="0">
                        <label for="F">NO</label>
                    <br><br>
                    <legend>7. Is your dog comfortable walking on a leash?</legend>

                        <input type="radio" id="T" name="IsLeashTrained" value="1" REQUIRED>
                        <label for="T">YES</label>

                        <input type="radio" id="F" name="IsLeashTrained" value="0">
                        <label for="F">NO</label>
                    <br><br>
                    <legend>8. Any activity limitations or time restrictions? </legend>
                        <input type="radio" id="T" name="IsRestriction" value="1" REQUIRED>
                        <label for="T">YES</label>
                        <input type="radio" id="F" name="IsRestriction" value="0">
                        <label for="F">NO</label>
                    <label for="RestrictionDesc">If yes, please describe.</label>
                    <br> &nbsp;&nbsp;
                    <textarea name="RestrictionDesc" id="RestrictionDesc"></textarea>
                <br>
                    <legend>9. Name a few of your dog's favorite toys or games to play.</legend>
                    <textarea name="Toys" id="Toys" REQUIRED></textarea>

                    <legend>10. Please describe any other behaviors, preferences, or routines we should
                        know about your dog.</legend>
                    <textarea name="OtherBehaviorInfo" id="OtherBehaviorInfo" REQUIRED></textarea>

                    <legend>11. Are there any training commands or activities we can continue to reinforce
                        (if possible) while in our care? If so, please list.</legend>
                    <textarea name="Reinforce" id="Reinforce" REQUIRED></textarea>

                    <legend>12. What commands does your dog know?</legend>
                    <textarea name="Commands" id="Commands" REQUIRED></textarea>
                    <br>
                    <legend>13. What is your dog's feeding schedule?</legend>
                    <textarea name="FoodPref" id="FoodPref" REQUIRED></textarea>
                    <br>
                    <legend>14. What is your dog's normal potty routine?</legend>
                    <textarea name="BathroomRoutine" id="BathroomRoutine" REQUIRED></textarea>

                </p>
            </fieldset>
            <fieldset>
                <!-- Collects information for DogHealth Table -->
                <legend>Dog Health Information</legend>
                <p>
                    <label for="ClinicName">Clinic Name</label>
                    <input type="text" id="ClinicName" name="ClinicName" REQUIRED>
                    <br>
                    <label for="VetPhone">Phone</label>
                    <input type="text" id="VetPhone" name="VetPhone" REQUIRED>
                    <br>
                    <label for="VetAddress">Address</label>
                    <input type="text" id="VetAddress" name="VetAddress" REQUIRED>
                    <br>
                    <label for="VetCity">City</label>
                    <input type="text" id="VetCity" name="VetCity" REQUIRED>
                    <br>
                    <label for="VetState">State</label>
                    <input type="text" id="VetState" name="VetState" REQUIRED>
                    <br>
                    <label for="VetZip">Zip</label>
                    <input type="text" id="VetZip" name="VetZip" REQUIRED>
                    <br>
                    <label for="VetName">Preferred Vet Name</label>
                    <input type="text" id="VetName" name="VetName" REQUIRED>
                    <!-- STILL NEED TO INCLUDE RELEASE OF LIABILITY NOTICE-->
                    <br><br>
                    <legend>List all known allergies, medical conditions, and mobility/vision/hearing
                        impairments.</legend>
                    <textarea name="MedicalCond" id="MedicalCond" REQUIRED></textarea>
                    <br>
                    <legend>List all medication & dose frequency.</legend>
                    <textarea name="Medication" id="Medication" REQUIRED></textarea>
                </p>
            </fieldset>
            <fieldset>
                <!-- Collects information for DogVaccine Table -->
                <legend>Vaccinations</legend>
                    <p>**All dogs accepted for daycare must be vaccinated for DHPP, Rabies, & Bordetella**<br>
                        **Proof of current vaccination for all required vaccines must be shown upon
                        arrival**</p>

                    <label for="DHPP_Date">DHPP Date:</label>
                    <input type="date" name="DHPP_Date" id="DHPP_Date" REQUIRED>
                    <label for="RabiesDate">Rabies Date:</label>
                    <input type="date" name="RabiesDate" id="RabiesDate" REQUIRED>
                    <label for="BordellaDate">Bordetella Date(6 or 12 mo.):</label>
                    <input type="date" name="BordellaDate" id="BordellaDate" REQUIRED>

                    <br><br>
                    <legend><u>Preventatives</u></legend>
                    <p>*Heartworm & flea/tick preventative treatments are recommended for daycare clients*<br>
                        *If fleas/ticks are found on the client during the stay, the client will be treated
                        at the owner's expense.*</p>
                    <label for="FleaTickProduct"><br>Flea/Tick product:</label>
                    <input type="text" name="FleaTickProduct" id="FleaTickProduct" REQUIRED>

                    <label for="FleaTickDate">Last date given:</label>
                    <input type="date" name="FleaTickDate" id="FleaTickDate" REQUIRED>

                    <br><br>
                    <legend><u>Notes</u></legend>
                        <label for="OtherVacInfo">Please list below any other vaccination information we
                            may need to know:<br></label>
                        <textarea name="OtherVacInfo" id="OtherVacInfo"></textarea>


                <!-- Generates Token and submits input -->
                <br><br>
                <input type="hidden" name="token" value="<?php echo token::generate(); ?>">
                <input type="submit" value="Complete Forms"><br><br>

                <!-- Do we want to include an E-Signature? -->
            </fieldset>
        </form>
    </div>
</body>

</html>

</html>
<?php }else{Redirect::to('../UserHandling/login.php');}?>