<?php
    require_once '../UserHandling/core/init.php';
    
    if (!Session::exists('home')) {
        echo '<p>'. Session::flash('home') .'</p>';
    }

    $customer = new Customer();
    $dog = new Dog();
    $reservation = new Reservation('', array());


    if($user->isLoggedIn()) {

    //Adds Customer NavBar if Customer Acct logged in
    if($user->data()->group == 1){
        include("../Customer Portal/CustNavBar.php");
    }

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
        <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/MyReservations.css">
    
    <title>Reservation List</title>
</head>
<body>
    <div class = 'content'>
          <!-- Table to show pending reservations -->
  <h2>Pending Boarding and Daycare Reservations</h2>
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
      <tr>
        <!-- PHP Data Loaded In Here -->
      </tr>
    </tbody>
  </table>
  <br><br>
   
 <!-- Table to show pending reservations -->
 <h2>Grooming Reservations</h2>
  <table>
    <thead>
      <tr>
        <th>Time Range</th>
        <th>Dog</th>
        <th>Description</th>
        <th>Service</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <!-- Load in Pending Grooming Appointments -->
        <?php
        //Constructor Class Calls
        $groomingReservation = new GroomingReservation('Grooming', array());
        $dog = new Dog();
        $user = new User();
        $customer = new Customer();

        //Find Customer with Customer ID
        $customer->findCustInfo($user->data()->id); //Finds matching user id
        $custid = $customer->data()->CustID; //stores the customer id

        //Finds Unapproved Reservations Linked to Account
        $groomingReservation->getReservationsWithCustID($custid);
        $allGroomingData = $groomingReservation->getReservationData();


            //Checks that query has results
            if(!empty($allGroomingData)){
                //Goes through each table row

                foreach ($allGroomingData as $reservationGrooming){
                    //populates rows
                    echo '<tr>';
                    echo '<td>'. $reservationGrooming->ResStartDate . ' - ' .  $reservationGrooming->ResEndDate.'</td>';

                    //Finds the dog name with their ID
                    $dog->findDogInfoWithDogID($reservationGrooming->DogID);
                    $dogName = $dog->data()->DogName;

                    echo '<td>'. $dogName . '</td>';
                    echo '<td>'. $reservationGrooming->GroomingDesc. '</td>';
                    echo '<td>Grooming</td>';
                    echo '<td>Pending</td>';
                    echo '</tr>';
             }
            } ?>
      </tr>
    </tbody>
  </table>
  <br><br>

    

</div>
</body>
</html>
<?php }else 
        { Redirect::to('../UserHandling/login.php');} //Redirect User to Login if not logged in
?>