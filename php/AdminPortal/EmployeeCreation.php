<?php
    require_once '../UserHandling/core/init.php';
        
    if (!Session::exists('home')) {
        echo '<p>'. Session::flash('home') .'</p>';
    }

    $user = new User();
    if($user->isLoggedIn()) {

    //Adds Admin NavBar if Admin Acct logged in
    if($user->data()->group === 3){
        include("../AdminPortal/AdminNavBar.php");

    }


//Only shows page to users with the correct PermissionLvl
if($user->data()->group === 3)
    {

 //Check if user has clicked on the post button
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //Grabs Username from encryption
        $user_name = $_POST['User_Name'];
        $password = $_POST['Password'];
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT); //Password is Encrypted

        //Check if both are empty
        if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
        {
            //All info is correct

            //Create User_Id
            $user_id = random_num(20);

            //Save to Database
            $query = "INSERT INTO login (User_ID, User_Name, Password, PermissionLvl) values ('$user_id', '$user_name', '$hashed_pass', 1)";
            mysqli_query($connection, $query);
            //Add second query that adds USERID into Customer table 
            $query1 = "INSERT INTO employee (User_ID) values ('$user_id')";
            mysqli_query($connection, $query1);
            
            //Pulls input into variables
            $empFirstName = $_POST['empFirstName'];
            $empLastName = $_POST['empLastName'];
            $empPhone = $_POST['cell_phone'];
            $acctEmail = $_POST['email'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $zip = $_POST['zip'];

            //Posts to Database
            $query = "UPDATE employee JOIN login ON employee.User_ID = login.User_ID 
                      SET EmpFirstName = '$empFirstName', EmpLastName = '$empLastName', EmpPhone = '$empPhone', AcctEmail='$acctEmail', EmpAddress='$address', EmpState='$state', EmpCity='$city', EmpZip='$zip'";        
            mysqli_query($connection, $query);


            //Redirects             Add a page here that goes to a page that collects, name, email, phone, address, etc. 
            header("Location: AdminHome.php");
            die;

        }else //Message for Wrong info
        {
            echo "<p class='invalid_username'>Please Enter Valid Information!</p>";
        }
    }
}else{
    echo "<p> You do not have access to this page </p>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/EmployeeCreation.css">
    

    <title>Employee Signup</title>
</head>
<body>
    <div class=content>
    <form method="POST" class="EmpInfo-Form">
        <fieldset>

            <legend>Employee Account Creation</legend>
            <p>
                <label>Username</label>
                <input type="text" name="User_Name"  id="User_Name"><br><br>

                <label>Password</label>
                <input type="password" name="Password"  id="Password"><br><br>

                <label for="empFirstName">First Name:</label>
                <input type="text" name="empFirstName" id="empFirstName" required>
            
                <label for="empLastName">Last Name:</label> <!-- In the form there is an option for more than one -->
                <input type="text" name="empLastName" id="empLastName" required>

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

                <input type="submit" value="Complete Employee Account"><br><br>

            </p>
        </fieldset>
    </form>
</div>
</body>
</html>
<?php } ?>