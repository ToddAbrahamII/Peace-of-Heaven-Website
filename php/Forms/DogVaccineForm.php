<?php
    require_once '../UserHandling/core/init.php';

    $user = new User(); //constructor call
    $customer = new Customer(); //constructor call 
    
    //checks if user is logged in
    if ($user->isLoggedIn()) {
        echo "user is logged in";
    
        if(Input::exists()) {
            echo "input exists";
    
            if(Token::check(Input::get('token'))) {
                echo "got token?";
    
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
                if($validation->passed() || 1==1){
                    echo "passed";
                    try{
                        //Creates array of all input to be inserted into dog table
                        $dog = new Dog(); //constructor call
                        $customer->findCustInfo($user->data()->id); //Finds matching user id
                        $custid = $customer->data()->CustID; //stores the customer id
                        echo $custid;
                        $dog->createVaccineRecord(array(
                            'DHPP_Date' => Input::get('dhpp_date'),
                            'RabiesDate' => Input::get('rabies_date'),
                            'BordellaDate' => Input::get('bordetella_date'),
                            'HasFleaTick' => Input::get('flea_product'),
                            'FleaTickDate' => Input::get('flea_date'),
                            'OtherVacInfo' => Input::get('other_vac_info')
                        ));
    
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
        <form action="" method="post">
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

                <input type="hidden" name="token" value="<?php echo token::generate(); ?>">
                <input type="submit" value="Register"><br><br>

            </fieldset>
        </form>
    </body>
</html>