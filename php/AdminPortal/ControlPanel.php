<?php
    require_once '../UserHandling/core/init.php';
    
    if (!Session::exists('home')) {
        echo '<p>'. Session::flash('home') .'</p>';
    }

    $user = new User();
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
    <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/ControlPanel.css">

    <title>Check Out Portal</title>
</head>
<body> 
<div class=content>
<h1>Admin Control Panel<h1>
<h2>Customer Account Actions:</h2>
  <a href="">Update Customer Account</a>
  <a href="">Delete Customer Account</a>

  <h2>Dog Account Actions:</h2>
  <a href="">Update Dog Account</a>
  <a href="">Delete Dog Account</a>

  <h2>Boarding/Daycare Reservation Actions:</h2>
  <a href="">Update Boarding/Daycare Reservation</a>
  <a href="">Delete Boarding/Daycare Reservation</a>

  <h2>Grooming Reservation Actions:</h2>
  <a href="">Update Grooming Reservation</a>
  <a href="">Delete Grooming Reservation</a>

  <h2>Kennel Actions:</h2>
  <a href="">Create Kennel</a>
  <a href="">Update Kennel</a>
  <a href="">Delete Kennel</a>

  <h2>Announcement Actions:</h2>
  <a href="">Create Announcement</a>
  <a href="">Update Announcement</a>
  <a href="">Delete Announcement</a>

</div>
</body>
</html>
<?php }else{Redirect ::to('../UserHandling/login.php');}
