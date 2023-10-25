<?php
session_start(); //Starts the session -- REQUIRED ON EVERY PAGE --

    include("connection.php"); //Needed for making login required, calls other php page
    include("functions.php");//Needed for making login required, calls other php page
    include("/xampp/htdocs/PeaceOfHeavenWebPage/php/Core/init.php");

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
            //Pulls input into variables
            $custFirstName = $_POST['custFirstName'];
            $custLastName = $_POST['custLastName'];
            $custPhone = $_POST['cell_phone'];
            $acctEmail = $_POST['email'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $zip = $_POST['zip'];

            //Posts to Database
            //$query = "INSERT INTO customer (CustFirstName, CustLastName, CustPhone, CustAddress, CustCity, CustState, CustZip, AcctEmail) values ('$custFirstName', '$custLastName', '$custPhone', '$address', '$city', '$state', '$zip', '$acctEmail')
              //         SELECT * FROM customer INNER JOIN login ON login.User_ID = customer.User_ID";

            $query = "UPDATE customer JOIN login ON customer.User_ID = login.User_ID SET CustFirstName = '$custFirstName', CustLastName = '$custLastName', CustPhone = '$custPhone', AcctEmail='$acctEmail', CustAddress='$address', CustState='$state', CustCity='$city', CustZip='$zip'";        
            mysqli_query($connection, $query);

            //Redirects
            header("Location: login.php");
            die;

    }
?>
<!DOCTYPE html>
<html>
<head>

</head>

<body>
    <form method="POST" class="CustInfo-Form">
        <fieldset>

            <legend>Customer Account Signup Information</legend>
            <p>
                <label for="custFirstName">First Name:</label>
                <input type="text" name="custFirstName" id="custFirstName" required>
            
                <label for="custLastName">Last Name:</label> <!-- In the form there is an option for more than one -->
                <input type="text" name="custLastName" id="custLastName" required>

                <label for="cell_phone"><br>Cell Phone:</label>
                <input type="tel" id="cell_phone" name="cell_phone" placeholder="(123)-456-678" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>

                <label for="AcctEmail"><br>Email:</label>
                <input type="email" id="email" name="email" required> <!-- There is a multiple keyword that will allow multiple addresses-->

                <label for="address"><br>Address:</label>
                <input type="text" name="address" id="address" required>

                <label for="city"><br>City:</label>
                <input type="text" name="city" id="city" required>

                <label for="state">State:</label>
                <input type="text" name="state" id="state" required>

                <label for="zip">Zip:</label>
                <input type="text" name="zip" id="zip" required><br>

                <input type="submit" value="Complete Signup"><br><br>

</p>
        </fieldset>
    </form>

</body>
    
</html>