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
        <h2>All Kennels</h2>
        <table>
        <thead>
        <tr>
            <th>Kennel Name</th>
            <th>Kennel Type</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
            <?php
                //populates array with all kennel data
                $kennel->getKennels();
                $kennel = $kennel->data();
                
                if(!empty($kennel)){
                    //Goes through each table row

    
                    foreach ($kennel as $kennel){

                    //gather data for if checks
                    $occupation = $kennel->isOccupied;
                    $kennelType = $kennel->isBoarding;

                    //prints rows
                    echo '<tr>';
                    echo '<td>'. $kennel->KennelName . '</td>';

                    //Formats the kennel type
                    if($kennelType == 0)
                    {
                        echo'<td>Boarding<td>';
                    }else{
                        echo '<td>Daycare<td>';
                    }

                    //Formats open vs occupied
                    if($occupation == 0){
                        echo '<td>Open<td>';
                    }else{
                        echo '<td>Occupied<td>';
                    }

                    echo '<tr>';

                    }
                }?>
        </tbody>
    </table>
    <br><br>

</div>
</body>
</html>
<?php }else{Redirect ::to('../UserHandling/login.php');}