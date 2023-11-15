<?php
    require_once '../UserHandling/core/init.php';
    
    if (!Session::exists('home')) {
        echo '<p>'. Session::flash('home') .'</p>';
    }

    $user = new User();
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

   
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/CustHome.css">

    <title>Customer Portal</title>
</head>
<body> 
<div class=content>
     <!-- Table to showcase Confirm Reservations -->
     <h2>All Announcements </h2>
      <?php
      
      //Constructor Call 
      $announcement = new Announcement();

      //Call all relevant Announcements
      $announcement->getAnnouncements();
      $allAnnouncements = $announcement->data();

      //Checks for empty and prints announcement for each 
      if(!empty($allAnnouncements)){
        foreach($allAnnouncements as $announcement){
          
          //Gather data
          $header = $announcement->header;
          $date = $announcement->date;
          $description = $announcement->description;

          echo '<div class="announcement">';
          echo '<h3>'.$header.'</h3>';
          echo '<p class="date">'.$date.'</p>';
          echo '<p class="description">'.$description.'</p>';
          echo '</div>';

        }
      }
      
      ?>
    </body>
    </html>
<?php } else {
            Redirect ::to('../UserHandling/login.php');
            }
?>