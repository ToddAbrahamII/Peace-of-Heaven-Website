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
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/EmployeeCreation.css">
    

    <title>Kennel Creatotion</title>
</head>
<body>
    <div class=content>
    <form method="POST" class="KennelCreation-Form">
        <fieldset>

            <legend>Kennel Creation</legend>
            <p>
                <!-- Asks for Kennel Name -->
                <label>What is the name of the kennel?</label>
                <input type="text" name="kennelName"  id="kennelNAme"><br><br>

                <!-- Asks what type of kennel it is -->
                <label for="kennelType">Select a kennel type:</label>
                <select id="kennelType" name="kennelType">
                    <option value="0">Daycare</option>
                    <option value="1">Boarding</option>
                </select><br><br>

                <!-- Creates token and submits for completion -->
                <input type="hidden" name="token" value="<?php echo token::generate(); ?>">
                <input type="submit" value="Complete Kennel"><br><br>

            </p>
        </fieldset>
    </form>
</div>
</body>
</html>
<?php } ?>