<?php
session_start(); //Starts the session -- REQUIRED ON EVERY PAGE --

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
                ));
    
                // If all rules are satisfied, create new customer
                if($validation->passed()) {
                    try{
                        //Creates array of all input to be inserted into Dog Behavior table
                        $dogBehavior = new DogBehavior(); //constructor call
                        $customer->findCustInfo($user->data()->id); //Finds matching user id
                        $custid = $customer->data()->CustID; //stores the customer id
                        $dogBehavior->create(array(

                            'IsSocial' => Input::get('IsSocial'),

                            'IsJumper' => Input::get('IsJumper'),
                            'IsClimber' => Input::get('IsClimber'),
                            'IsChewer' => Input::get('IsChewer'),
                            'IsEscapeArtist' => Input::get('IsEscapeArtist'),
                            'EscapeDesc' => Input::get('Escape_Desc'),
                            'CanWater' => Input::get('CanWater'),
                            'CanTreat' => Input::get('CanTreat'),
                            'IsRestriction' => Input::get('IsRestriction'),
                            'RestrictionDesc' => Input::get('Restriction_Desc'),
                            'Toys' => Input::get('Toys'),
                            'OtherBehaviorInfo' => Input::get('OtherBehaviorInfo'),
                            'Reinforce' => Input::get('Reinforce')
                            'Commands' => Input::get('Commands')
                            'IsLeashTrained' => Input:: get('IsLeashTrained')
                            'FoodPref' => Input::get('FoodPref'),
                            'BathroomRoutine' => Input::get('BathroomRoutine'),
                            'CustID' => $custid, 
                            `DogID` int(11) NOT NULL
                        ));
    
                        Redirect::to('../Customer Portal/CustHome.php');
    
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
    
    ?>
    <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <!-- <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/AcctInfo.css"> -->
    </head>
            </head>
        
            <body>
                <form method="POST" class="DogInfo=Form">


<fieldset>
                        <!-- Collects information for DogBehavior Table -->
                        <legend>Dog Behavior Information</legend>
                    <p>
                            <legend>1. What is your dogs previous daycare and/or boarding experience</legend> 
                            <input type="radio" id="1a" name="experience" value="1a">
                            <label for="1a">a. Never attempted either</label>
                            <br>
                            <input type="radio" id="1b" name="experience" value="1b">
                            <label for="1b">b. Boarding and/or daycare client in past but no more than twice a year</label>
                            <br>
                            <input type="radio" id="1c" name="experience" value="1c">
                            <label for="1c">c. Has been at least once but stresses easily or does not adjust well to unfamiliar environments</label> 
                            <br>
                            <input type="radio" id="1d" name="experience" value="1d">
                            <label for="1d">d. Boarded regularly & adjusts easily</label>
                            <br>
                            <input type="radio" id="1e" name="experience" value="1e">
                            <label for="1e">e. Attends daycare often & socializes well</label>
                    </p>
    
    
                    <p>
                        <legend>2. Do you want your dog to engage in social play with dogs of like-size & similar temperament?</legend>
                        <input type="radio" id="2yes" name="isSocial" value="yes">
                        <label for="2yes">YES</label>
                        <input type="radio" id="2no" name="isSocial" value="no">
                        <label for="2no">NO</label>
                    </p>
    
    
                    <p>
                        <legend>3. Has your dog ever growled, snipped, bit, or shown any other aggressive reaction towards people or pets?</legend>
                        <input type="radio" id="3yes" name="aggressive_reaction" value="yes">
                        <label for="3yes">YES</label>
                        <input type="radio" id="3no" name="aggressive_reaction" value="no">
                        <label for="3no">NO</label>
                        <br>
    
                        &nbsp;&nbsp; <!-- Temp. tabs until we decide if we want to put text areas in divs and format with CSS-->
                        <label for="aggressive_encounter">a. If yes, please provide brief description of encounter(s).</label>
                        <br>
                        &nbsp;&nbsp;
                        <textarea name="aggressive_encounter" id="aggressive_encounter"></textarea>
    
                    </p>
    
    
                    <p>
                        <legend>4. Is your dog a...</legend>
    
                        <label>a. Jumper? </label>
                        <input type="radio" id="4a_yes" name="IsJumper" value="yes">
                        <label for="4a_yes">YES</label>
                        <input type="radio" id="4a_no" name="IsJumper" value="no">
                        <label for="4a_no">NO</label>
                        <br>
    
                        <label>b. Climber? </label>
                        <input type="radio" id="4b_yes" name="IsClimber" value="yes">
                        <label for="4b_yes">YES</label>
                        <input type="radio" id="4b_no" name="IsClimber" value="no">
                        <label for="4b_no">NO</label>
                        <br>
    
                        <label>c. Aggressive chewer? </label>
                        <input type="radio" id="4c_yes" name="IsChewer" value="yes">
                        <label for="4c_yes">YES</label>
                        <input type="radio" id="4c_no" name="IsChewer" value="no">
                        <label for="4c_no">NO</label>
                        <br>
    
                        <label>d. Escape artist of any kind? </label>
                        <input type="radio" id="4d_yes" name="IsEscapeArtist" value="yes">
                        <label for="4d_yes">YES</label>
                        <input type="radio" id="4d_no" name="IsEscapeArtist" value="no">
                        <label for="4d_no">NO</label>
                        <br>
    
                        &nbsp;&nbsp;
                        <label for="EscapeDesc">i. If yes, please describe his/her escaping abilities.</label>
                        <br>
                        &nbsp;&nbsp;
                        <textarea name="EscapeDesc" id="EscapeDesc"></textarea>
                    </p>
    
    
                    <p>
                        <legend>5. Do you prefer your dog to participate in water activities (weather permitting)?</legend>
                        <input type="radio" id="5yes" name="CanWater" value="yes">
                        <label for="5yes">YES</label>
                        <input type="radio" id="5no" name="CanWater" value="no">
                        <label for="5no">NO</label>
                    </p>
    
                    <p>
                        <legend>6. Is your dog permitted to have edible treats? </legend>
                        <input type="radio" id="6yes" name="CanTreat" value="yes">
                        <label for="6yes">YES</label>
                        <input type="radio" id="6no" name="CanTreat" value="no">
                        <label for="6no">NO</label>
                    </p>
    
    
                    <p>
                        <legend>7. Any activity limitations or time restrictions? </legend>
                        <input type="radio" id="7yes" name="IsRestriction" value="yes">
                        <label for="7yes">YES</label>
                        <input type="radio" id="7no" name="IsRestriction" value="no">
                        <label for="7no">NO</label>
                        <br>
    
                        &nbsp;&nbsp;
                        <label for="RestrictionDesc">a. If yes, please describe.</label>
                        <br>
                        &nbsp;&nbsp;
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
                        <input type="radio" id="12yes" name="IsLeashTrained" value="yes">
                        <label for="12yes">YES</label>
                        <input type="radio" id="12no" name="IsLeashTrained" value="no">
                        <label for="12no">NO</label>
                        <br>
    
                        <label for="FoodPref">13. What is your dog's feeding schedule?</label>
                        <input type="text" name="FoodPref" id="FoodPref">
                        <br>
    
                        <label for="BathroomRoutine">14. What is your dog's normal potty routine?</label>
                        <input type="text" name="BathroomRoutine" id="BathroomRoutine">

                            <!-- Checks if Dog is escape artist -->

                            <!-- Checks if Dog is a climber -->

                            <!-- Checks if Dog is leash trained -->

                            <!-- Checks if Dog is a chewer -->

                            <!-- Checks Dogs Bathroom Routine -->

                            <!-- Checks any other information regarding behavior -->
                </fieldset>
                </form>
        </body>
    </html>
<?php } ?>