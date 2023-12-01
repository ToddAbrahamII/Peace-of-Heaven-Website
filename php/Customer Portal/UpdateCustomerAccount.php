<?php
require_once '../UserHandling/core/init.php';

if (!Session::exists('home')) {
    echo '<p>'. Session::flash('home') .'</p>';
}

$user = new User();
if($user->isLoggedIn()) {

        //Adds Customer NavBar if Customer Acct logged in
        if($user->data()->group == 1){
            include("../Customer Portal/CustNavBar.php");
        }
    
        //Adds Employee NavBar if Employee Acct logged in
        if($user->data()->group == 2 ){
            include("../Employee Portal/EmpNavBar.php");
    
        }

    //Only shows page to users with the correct PermissionLvl
    if($user->data()->group == 3)
    {
        //Shows Admin NavBar
        include("../AdminPortal/AdminNavBar.php");
    }

        // CONSTRUCTOR CALL
        $customer = new Customer();

                //Matches UserID to CustID with account logged in
        $customer->findCustInfo($user->data()->id);

        //Stores the CustID
        $custid = $customer->data()->CustID;

        // STORE CUSTOMER DATA
        $customer->findCustInfoWithCustID($custid);

        // GET CUSTOMER DATA
        $customerData = $customer->getCustomerData();


        if(Input::exists()) {
            if(Token::check(Input::get('token'))){

                $fieldsToUpdate = array(
                    'CustFirstName' => Input::get('custFirstName'),
                    'CustLastName'  => Input::get('custLastName'),
                    'CustPhone'     => Input::get('custPhone'),
                    'CustAddress'   => Input::get('address'),
                    'CustCity'      => Input::get('city'),
                    'CustState'     => Input::get('state'),
                    'CustZip'       => Input::get('zip'),
                    'AcctEmail'     => Input::get('email')
                );
                $key = 'CustID'; // Key for where clause

                // UPDATE CUSTOMER TABLE
                if ($customer->update($fieldsToUpdate, $key, $custid)) {
                    echo "Update successful!";
                    header("Refresh:0"); // Reload the page after 0 seconds (immediately)
                } else {
                    echo "Update failed.";
                }

                Redirect::to('../Customer Portal/Settings.php');

            }
        }


?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/AcctInfo.css">


            <title>Update Customer</title>
        </head>
        <body>
        <form method="POST" class="CustInfo-Form">
            <fieldset>

                <legend><?php echo $customerData->CustFirstName . ' ' . $customerData->CustLastName ?></legend>
                <p>
                    <label for="custFirstName">First Name:</label>
                    <input type="text" name="custFirstName" id="custFirstName" required
                           value="<?php echo $customerData->CustFirstName ?>">

                    <label for="custLastName">Last Name:</label> <!-- In the form there is an option for more than one -->
                    <input type="text" name="custLastName" id="custLastName" required
                           value="<?php echo $customerData->CustLastName ?>">

                    <label for="custPhone"><br>Cell Phone:</label>
                    <input type="tel" id="custPhone" name="custPhone" placeholder="(123)-456-678" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" required
                           value="<?php echo $customerData->CustPhone ?>">

                    <label for="email"><br>Email:</label>
                    <input type="email" id="email" name="email" required
                           value="<?php echo $customerData->AcctEmail ?>">

                    <label for="address"><br>Address:</label>
                    <input type="text" name="address" id="address" required
                           value="<?php echo $customerData->CustAddress ?>">

                    <label for="city"><br>City:</label>
                    <input type="text" name="city" id="city" required
                           value="<?php echo $customerData->CustCity ?>">

                    <label for="state">State:</label>
                    <input type="text" name="state" id="state" required
                           value="<?php echo $customerData->CustState ?>">

                    <label for="zip">Zip:</label>
                    <input type="text" name="zip" id="zip" required'
                        value="<?php echo $customerData->CustZip ?>"><br>

                    <input type="hidden" name="token" value="<?php echo token::generate(); ?>">
                    <input type="submit" value="Update"><br><br>


                </p>
            </fieldset>
        </form>

        </body>
        </html>

<?php } ?>

