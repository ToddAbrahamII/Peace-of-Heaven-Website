<?php
    require_once '../UserHandling/core/init.php';
    
    //Make sure session is logged in
    if (!Session::exists('home')) {
        echo '<p>'. Session::flash('home') .'</p>';
    }

    //Class Calls
    $user = new User();
    $customer = new Customer();

    //Checks if user is logged in
    if($user->isLoggedIn()) {

    //Adds Customer NavBar if Customer Acct logged in
    if($user->data()->group == 1){
        include("../Customer Portal/CustNavBar.php");
    }

    //Adds Employee NavBar if Employee Acct logged in
    if($user->data()->group == 2){
        include("../Employee Portal/EmpNavBar.php");
    }

    //Adds Admin NavBar if Admin Acct logged in
    if($user->data()->group == 3 ){
        include("../AdminPortal/AdminNavBar.php");
    }

    ?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/SelectService.css">

    <title>Create a Reservation</title>
</head>
<body>
    <div class='content'>
    <form method="POST" class="Reservation-Creator">
                <fieldset>
                        <!-- Collects information for the beginning of a reservation -->
                        <legend>Reservation Selection Start</legend>
                    <p> 
                        <!-- Allows user to select service for reservation -->
                    <label for="service">Select a Service:</label>
                    <select name="service" id="service">
                        <option value="Grooming">Grooming</option>
                        <option value="Boarding">Boarding</option>
                        <option value="Daycare">Daycare</option>
                    </select>
                    <br><br>
                                
                    <!-- Generates Token and submits input -->
                    <input type="hidden" name="token" value="<?php echo token::generate(); ?>">
                    <input type="submit" value="Next"><br><br>

                    <?php 

                //Code for when instance exists
                if(Input::exists()){

                    //Stores which service was selected
                    $serviceCheck = Input::get('service');

                    //IF Statement for if user has 0 dogs in table to redirect them to create a dog
                    //Else redirect them to their service page



                        //If statement for if grooming was selected
                        if($serviceCheck == 'Grooming')
                        {
                            Redirect::to('../Forms/GroomingForm.php');
                        }

                        //If statement for if daycare was selected
                        if($serviceCheck == 'Boarding')
                        {
                            Redirect::to('../Customer Portal/SelectDog.php?service=' . $serviceCheck);
                        }

                        //If statement for if boarding was selected 
                        if($serviceCheck == 'Daycare')
                        {
                            Redirect::to('../Customer Portal/SelectDog.php?service=' . $serviceCheck);
                        }




                    }
                    ?>

                    </p>


                </fieldset>
        </form> 
    </div>

</body>

</html>
<?php } else{Redirect::to('../UserHandling/login.php');} ?>