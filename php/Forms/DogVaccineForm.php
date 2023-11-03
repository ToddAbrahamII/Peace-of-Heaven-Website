<?php
    require_once '../UserHandling/core/init.php';

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
                        //Creates array of all input to be inserted into dog table
                        $dog = new Dog(); //constructor call
                        $customer->findCustInfo($user->data()->id); //Finds matching user id
                        $custid = $customer->data()->CustID; //stores the customer id
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
?>



<!DOCTYPE html>
<html lang="en">
    <head>

    </head>

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