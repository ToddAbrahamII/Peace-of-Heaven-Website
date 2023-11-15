<?php
    require_once '../UserHandling/core/init.php';
    
    if (!Session::exists('home')) {
        echo '<p>'. Session::flash('home') .'</p>';
    }

    $user = new User();
    $kennel = new Kennel();
    
    if($user->isLoggedIn()) {

    //Adds Employee NavBar if Employee Acct logged in
    if($user->data()->group == 2){
        include("../Employee Portal/EmpNavBar.php");

    }

    //Adds Admin NavBar if Admin Acct logged in
    if($user->data()->group == 3 ){
        include("../AdminPortal/AdminNavBar.php");

    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/ViewKennels.css">

    <title>Check In Portal</title>
</head>
<body> 
    <div class=content>
        <!-- Table to showcase Confirm Reservations -->
        <h1>All Kennels</h1>

        <h2>Boarding Kennels</h2>
            <?php
                //populates array with all kennel data
                $kennel->getBoardingKennels();
                $kennel = $kennel->data();

                echo'<div class="kennel-container">';

                if(!empty($kennel)){
                    //Goes through each table row

                    //prints all boarding kennels
                    foreach ($kennel as $kennel){
                    
                    //gather data for if checks
                    //prints rows
                    echo '<div class="kennel-box">';
                    echo '<div class="kennel-title">';
                    echo '<h3>'. $kennel->KennelName . '</h3>';
                    echo '</div>';
                    echo '<div class="kennel-info">';

                    //Formats the kennel type
                    echo'<p>Kennel Type: Boarding</p>';
                 
                    $occupation = $kennel->isOccupied;
                    //Formats open vs occupied
                    if($occupation == 0){
                        echo '<p>Status: Open</p>';
                    }else{
                        echo '<p>Status: Occupied</p>';
                    }

                    echo '</div>';
                    echo '</div>';
                    echo '<br>';
                        }
            
                    }


                ?>
            </div>
            <br><br><br><br>

            <!-- Daycare Kennels -->
            <h2>Daycare Kennels</h2>
            <?php
                //populates array with all kennel data
                $kennel = new Kennel();
                $kennel->getDayCareKennels();
                $kennel = $kennel->data();

                echo'<div class="kennel-container">';

                if(!empty($kennel)){
                    //Goes through each table row

                    //prints all boarding kennels
                    foreach ($kennel as $kennel){
                    
                    //gather data for if checks
                    //prints rows
                    echo '<div class="kennel-box">';
                    echo '<div class="kennel-title">';
                    echo '<h3>'. $kennel->KennelName . '</h3>';
                    echo '</div>';
                    echo '<div class="kennel-info">';

                    //Formats the kennel type
                    echo'<p>Kennel Type: Boarding</p>';
                 
                    $occupation = $kennel->isOccupied;
                    //Formats open vs occupied
                    if($occupation == 0){
                        echo '<p>Status: Open</p>';
                    }else{
                        echo '<p>Status: Occupied</p>';
                    }

                    echo '</div>';
                    echo '</div>';
                    echo '<br>';
                        }
            
                    }


                ?>
            </div>
    
</div>
            

</div>
</body>
</html>
<?php }else{Redirect ::to('../UserHandling/login.php');}