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

        if(Input::exists()) {
            if(Token::check(Input::get('token'))) {
                
                $validate = new Validate();
                $validation = $validate->check($_POST, array(
                    ### Insert rules that Employee Creation fields must meet in addition to js validation ###
                ));

                // If all rules are satisfied, create new employee
                if($validation->passed()) {
                    $employee = new Employee();//Constructor Call

                     // Generate a unique salt for the user
                     $salt = Hash::salt(32);
                    

                    try {
                        //Grabs Input for Users Table
                        $user->create(array(
                            'username' => Input::get('User_Name'),
                            'password' => Hash::make(Input::get('password'), $salt),
                            'salt' => $salt,
                            'joined' => date('Y-m-d H:i:s'),
                            'group' => 2
                        ));
                    }catch (Exception $e) {
                        die($e->getMessage()); //Outputs error
                    }

                    try {
                        //Grabs Input for Employee Table
                        $employee->create(array(
                            'empFirstName' => Input::get('empFirstName'),
                            'empLastName'  => Input::get('empLastName'),
                            'empPhone'  => Input::get('cell_phone'),
                            'acctEmail'  => Input::get('email'),
                            'EmpAddress'  => Input::get('address'),
                            'EmpCity'  => Input::get('city'),
                            'EmpState' => Input::get('state'),
                            'EmpZip'  => Input::get('zip'),
                            //Add Code to Match User ID in users table
                            //'User_ID' => $user->update(array())
                        ));
                    }catch (Exception $e) {
                        die($e->getMessage());
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