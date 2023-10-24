<?php
session_start(); //Starts the session -- REQUIRED ON EVERY PAGE --

    include("connection.php"); //Needed for making login required, calls other php page
    include("functions.php");//Needed for making login required, calls other php page
?>
<!DOCTYPE html>
<html>
<head>

</head>

<body>
    <form>
        <fieldset>

            <legend>Customer Account Signup Information</legend>
            <p>
                <label for="custFirstName">First Name:</label>
                <input type="text" name="custFirstName" id="custFirstName" required>
            
                <label for="custLastName">Last Name:</label> <!-- In the form there is an option for more than one -->
                <input type="text" name="custLastName" id="custLastName" required>

                <label for="cell_phone"><br>Cell Phone:</label>
                <input type="tel" id="cell_phone" name="cell_phone" placeholder="123-45-678" pattern="([0-9]{3})[0-9]{3}-[0-9]{4}" required>

                <label for="AcctEmail"><br>Email:</label>
                <input type="email" id="email" name="email" required> <!-- There is a multiple keyword that will allow multiple addresses-->

                <label for="address"><br>Address:</label>
                <input type="text" name="address" id="address" required>

                <label for="city"><br>City:</label>
                <input type="text" name="city" id="city" required>

                <label for="state">State:</label>
                <input type="text" name="state" id="state" required>

                <label for="zip">Zip:</label>
                <input type="text" name="zip" id="zip" required>

</p>
        </fieldset>
    </form>

</body>
    
</html>