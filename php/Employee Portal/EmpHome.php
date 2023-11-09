<?php
    require_once '../UserHandling/core/init.php';
        
    if (!Session::exists('home')) {
        echo '<p>'. Session::flash('home') .'</p>';
    }

    $user = new User();
    if($user->isLoggedIn()) {

    //Adds Employee NavBar if Employee Acct logged in
    if($user->data()->group == 2 ){
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
    <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/EmpHome.css">

    <title>Employee Portal</title>
</head>
<body>
    <div class=content>
    <!-- Box to style welcome statement -->
    <div class="header">
        <div class="welcome-box">
        <h1>Welcome to the Employee Portal</h1>
        </div>
    </div>

     <!-- View for Today's Reservations -->
     <h2>Todays Date: 11/9/2023</h2>
        <h2>Today's Reservations</h2>
        <table>
            <thead>
            <tr>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Dog</th>
                <th>Service</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <!-- PHP Load Data Here -->     
            </tbody>
        </table>
        <br><br>

        <!-- Table for Checked In Dogs -->
        <h2>Checked-In Dogs</h2>
        <table>
            <thead>
            <tr>
                <th>Dog</th>
                <th>Breed</th>
                <th>Date of Birth</th>
                <th>Service</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <!-- PHP Load Data Here -->     
            </tbody>
        </table>
        <br><br>

        <div class="button-container">
            <button class="check-in-button">Check-In Dog</button>
            <button class="check-out-button">Check-Out Dog</button>
        </div>

    </div>
</body>
</html>
<?php } ?>