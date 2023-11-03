<?php
    require_once 'core/init.php';

    $user = new User();
    $customer = new Customer();
    $dog = new Dog();


    if ($user->isLoggedIn()) {
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                $validate = new Validate();
                //$validation = $validate->check($_POST, array());

                if ($validation->passed()) {
                    try {
                        $reservation = new Reservation();
                        $

                        $reservation->createReservation($customer->getCustomerData()->CustID, )
                    }
                }
            }
        }
    }

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/AcctInfo.css">
</head>

<body>
    <form method="POST" class="CustInfo-Form">
        <fieldset>

            <legend>Customer Account Signup Information</legend>
            <p>
                <label for="ResStartTime">Start Date:</label>
                <input type="date" name="ResStartTime" id="ResStartTime">
            
                <label for="ResEndTime">End Date: </label> <!-- In the form there is an option for more than one -->
                <input type="date" name="ResEndTime" id="custLastName" required>

                <label for="EmerPhone"><br>Emergency Contact num </label>
                <input type="tel" id="custPhone" name="custPhone" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" required>

                <label for="EmerContact"><br>Emergency Contact name</label>
                <input type="text" id="EmerContact" name="EmerContact" required> <!-- There is a multiple keyword that will allow multiple addresses-->

                <label for="isCheckedIn"><br>Is Checked in:</label>
                <input type="checkbox" name="isCheckedIn" id="IsCheckedIn" required>

                <label for="ServiceType"><br>Service type:</label>
                <input type="text" name="ServiceType" id="ServiceType" required>

                <label for="isApproved">Is approved?:</label>
                <input type="text" name="state" id="state" required>

                

                <input type="hidden" name="token" value="<?php echo token::generate(); ?>">
                <input type="submit" value="Complete Signup"><br><br>
                

</p>
        </fieldset>
    </form>

</body>
    
</html>