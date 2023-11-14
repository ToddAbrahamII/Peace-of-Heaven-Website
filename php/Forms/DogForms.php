<?php
    // BEHAVIOR
    session_start(); //Starts the session -- REQUIRED ON EVERY PAGE --

    //Info Has been moved over, but not cleaned up, yet
    require_once '../UserHandling/core/init.php';

    include("connection.php"); //Needed for making login required, calls other php page
    include("functions.php");//Needed for making login required, calls other php page
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
                    try{
                        //Creates array of all input to be inserted into Dog Behavior table
                        $dog = new dog(); //constructor call
                        $customer->findCustInfo($user->data()->id); //Finds matching user id
                        $custid = $customer->data()->CustID; //stores the customer id
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
                            'CustID' => $custid, 
                        ));
    
                        $dog->createVaccineRecord(array(
                            'DHPP_Date' => Input::get('dhpp_date'),
                            'RabiesDate' => Input::get('rabies_date'),
                            'BordellaDate' => Input::get('bordetella_date'),
                            'HasFleaTick' => Input::get('flea_product'),
                            'FleaTickDate' => Input::get('flea_date'),
                            'OtherVacInfo' => Input::get('other_vac_info')
                        ));

                        Redirect::to('../Customer Portal/CustHome.php');
    
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
    
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/AcctInfo.css"> -->
    </head>        
    <body>
        <form method="POST" class="DogBehavior=Form">
        <fieldset>
            <!-- Collects information for DogBehavior Table -->
            <legend>Dog Behavior Information</legend>
            <p>
                <legend>1. What is your dogs previous daycare and/or boarding experience</legend> 
                <input type="radio" id="1a" name="Experience" value="0">
                <label for="1a">a. Never attempted either</label>
            <br>
                <input type="radio" id="1b" name="Experience" value="1">
                <label for="1b">b. Boarding and/or daycare client in past but no more than twice a year</label>
            <br>
                <input type="radio" id="1c" name="Experience" value="2">
                <label for="1c">c. Has been at least once but stresses easily or does not adjust well to unfamiliar environments</label> 
            <br>
                <input type="radio" id="1d" name="Experience" value="3">
                <label for="1d">d. Boarded regularly & adjusts easily</label>
            <br>
                <input type="radio" id="1e" name="Experience" value="4">
                <label for="1e">e. Attends daycare often & socializes well</label>
            </p>
            <p>
                <legend>2. Do you want your dog to engage in social play with dogs of like-size & similar temperament?</legend>
                <input type="radio" id="T2" name="isSocial" value="1">
                <label for="T2">YES</label>
                <input type="radio" id="F2" name="isSocial" value="0">
                <label for="F2">NO</label>
            </p>
            <p>
                <legend>3. Has your dog ever growled, snipped, bit, or shown any other aggressive reaction towards people or pets?</legend>
                <input type="radio" id="T3" name="IsAggressive" value="1">
                <label for="T3">YES</label>
                <input type="radio" id="F3" name="IsAggressive" value="0">
                <label for="F3">NO</label>
            <br> &nbsp;&nbsp; <!-- Temp. tabs until we decide if we want to put text areas in divs and format with CSS-->
                <label for="AggressiveDesc">a. If yes, please provide brief description of encounter(s).</label>
            <br> &nbsp;&nbsp;
                <textarea name="AggressiveDesc" id="AggressiveDesc"></textarea>
            </p>
            <p>
                <legend>4. Is your dog a...</legend>
                    <label>a. Jumper? </label>
                    <input type="radio" id="T4a" name="IsJumper" value="1">
                    <label for="T4a">YES</label>
                    <input type="radio" id="F4a" name="IsJumper" value="0">
                    <label for="F4a">NO</label>
                <br>
                    <label>b. Climber? </label>
                    <input type="radio" id="T4b" name="IsClimber" value="1">
                    <label for="T4b">YES</label>
                    <input type="radio" id="F4b" name="IsClimber" value="0">
                    <label for="F4b">NO</label>
                <br>
                    <label>c. Aggressive chewer? </label>
                    <input type="radio" id="T4c" name="IsChewer" value="1">
                    <label for="T4c">YES</label>
                    <input type="radio" id="F4c" name="IsChewer" value="0">
                    <label for="F4c">NO</label>
                <br>
                    <label>d. Escape artist of any kind? </label>
                    <input type="radio" id="T4d" name="IsEscapeArtist" value="1">
                    <label for="T4d">YES</label>
                    <input type="radio" id="F4d" name="IsEscapeArtist" value="0">
                    <label for="F4d">NO</label>
                <br> &nbsp;&nbsp;
                    <label for="EscapeDesc">i. If yes, please describe his/her escaping abilities.</label>
                <br> &nbsp;&nbsp;
                    <textarea name="EscapeDesc" id="EscapeDesc"></textarea>
            </p>
            <p>
                <legend>5. Do you prefer your dog to participate in water activities (weather permitting)?</legend>
                <input type="radio" id="T5" name="CanWater" value="1">
                <label for="T5">YES</label>
                <input type="radio" id="F5" name="CanWater" value="0">
                <label for="F5">NO</label>
            </p>
            <p>
                <legend>6. Is your dog permitted to have edible treats? </legend>
                <input type="radio" id="T6" name="CanTreat" value="1">
                <label for="T6">YES</label>
                <input type="radio" id="F6" name="CanTreat" value="0">
                <label for="F6">NO</label>
            </p>
            <p>
                <legend>7. Any activity limitations or time restrictions? </legend>
                <input type="radio" id="T7" name="IsRestriction" value="1">
                <label for="T7">YES</label>
                <input type="radio" id="F7" name="IsRestriction" value="0">
                <label for="F7">NO</label>
            <br> &nbsp;&nbsp;
                <label for="RestrictionDesc">a. If yes, please describe.</label>
            <br> &nbsp;&nbsp;
                <textarea name="RestrictionDesc" id="RestrictionDesc"></textarea>
            </p>
            <p>
                <legend>8. Name a few of your dog's favorite toys or games to play.</legend>
                <textarea name="Toys" id="Toys"></textarea>
    
                <legend>9. Please describe any other behaviors, prefrences, or routines we should know about your dog.</legend>
                <textarea name="OtherBehaviorInfo" id="OtherBehaviorInfo"></textarea>
    
                <legend>10. Are there any training commands or activities we can continue to reinforce (if possible) while in our care? If so, please list.</legend>
                <textarea name="Reinforce" id="Reinforce"></textarea>
    
                <legend>11. What commands does your dog know?</legend>
                <textarea name="Commands" id="Commands"></textarea>
            <br>
                <label for="IsLeashTrained">12. Is your dog comfortable walking on a leash?</label>
                <input type="radio" id="T12" name="IsLeashTrained" value="1">
                <label for="T12">YES</label>
                <input type="radio" id="F12" name="IsLeashTrained" value="0">
                <label for="F12">NO</label>
            <br>
                <label for="FoodPref">13. What is your dog's feeding schedule?</label>
                <input type="text" name="FoodPref" id="FoodPref">
            <br>
                <label for="BathroomRoutine">14. What is your dog's normal potty routine?</label>
                <input type="text" name="BathroomRoutine" id="BathroomRoutine">
        </fieldset>
        </form>
        </body>
    </html>
<?php } ?>






<!-- HEALTH FORM -->
<fieldset>
                        <!-- Collects information for DogHealth Table -->
    <legend>Dog Health Information</legend>

        <p>
            <!-- Vet Name -->

            <!-- Vet Phone -->

            <!-- Vet Address -->

            <!-- Vet City -->

            <!-- Vet State -->

            <!-- Vet Zip -->

            <!-- Allergies -->

            <!-- Medical Conditions -->

            <!-- Impairments -->

            <!-- Other Health Information -->

        </p>

        <!-- Collects information for DogVaccine Table -->
                      
                     
        rea name="seven_desc" id="seven_desc"></textarea>
        </p>
            <legend>15. List all known allergies.</legend>
            <textarea name="allergies" id="allergies"></textarea>
    
            <legend>16. List all medication & dose frequency.</legend>
            <textarea name="medication" id="medication"></textarea>
        </p>
    
</fieldset>





<!-- VACCINE -->
<!DOCTYPE html>
<html lang="en">
    <body>
        <form>
            <fieldset>

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
                    *If fleas/ticks are found on client during stay, client will be treated at owner&quots expense.*</p>

                    <label for="flea_product"><br>Flea/Tick product:</label>
                    <input type="text" name="flea_product" id="flea_product">

                    <label for="flea_date">Last date given:</label>
                    <input type="date" name="flea_date" id="flea_date">
                </p>

                <legend>Notes</legend>
                <p>
                    <label for="other_vac_info">Please list below any other vaccination information we may need to know:<br></label>
                    <textarea name="other_vac_info" id="other_vac_info"></textarea>
                </p>

            </fieldset>
        </form>
    </body>
</html>
