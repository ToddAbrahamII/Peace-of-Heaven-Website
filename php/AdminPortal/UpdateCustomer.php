<?php
require_once '../UserHandling/core/init.php';

if (!Session::exists('home')) {
    echo '<p>'. Session::flash('home') .'</p>';
}

$user = new User();
if($user->isLoggedIn()) {


    //Only shows page to users with the correct PermissionLvl
    if($user->data()->group == 3)
    {
        //Shows Admin NavBar
        include("../AdminPortal/AdminNavBar.php");

        // GET CUSTID FROM URL
        $customerId = $_GET['CustID'];

        // CONSTRUCTOR CALL
        $customer = new Customer();

        // STORE CUSTOMER DATA
        $customer->findCustInfoWithCustID($customerId);

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
                if ($customer->update($fieldsToUpdate, $key, $customerId)) {
                    echo "Update successful!";
                    header("Refresh:0"); // Reload the page after 0 seconds (immediately)
                } else {
                    echo "Update failed.";
                }

                Redirect::to('../AdminPortal/ManageCustomers.php');

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
<?php
        if(Input::exists()) {
            if(Token::check(Input::get('token'))) {

                $validate = new Validate();
                $validation = $validate->check($_POST, array(
                    ### Insert rules that Employee Creation fields must meet in addition to js validation ###
                ));

                // If all rules are satisfied, create new employee
                if($validation->passed()) {
                    $kennel = New Kennel();
                    // Generate a unique salt for the user
                    $salt = Hash::salt(32);


                    try {
                        //Grabs Input for Users Table
                        $kennel->create(array(
                            'KennelName' => Input::get('kennelName'),
                            'isOccupied' => 0,
                            'isBoarding' => Input::get('kennelType')

                        ));

                        //Code to Redirect
                        Redirect::to('../AdminPortal/AdminHome.php');

                    }catch (Exception $e) {
                        die($e->getMessage()); //Outputs error
                    }

                    //Code to Redirect
                    Redirect::to('../AdminPortal/AdminHome.php');

                }else {
                    foreach ($validation->errors() as $error) {
                        echo $error, '<br>';
                    }
                }
            }
        }
    }

    ?>

<?php } ?>

