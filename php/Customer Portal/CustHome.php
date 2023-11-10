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
    <!-- Box to style welcome statement -->
    <div class="header">
        <div class="welcome-box">
        <h1>Welcome to the Customer Portal</h1>
        </div>
    </div>

    <!-- Table to showcase Confirm Reservations -->
    <h2>Confirmed Reservations</h2>
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
    <div class="view-button-container">
        <a href="">
            <button class="view-button">View My Reservations</button>
        </a>
    </div>
  <br><br>

  <!-- Table to show pending reservations -->
  <h2>Pending Reservations</h2>
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
   
  <!-- Table to show all dogs the customer has -->
  <h2>My Dogs</h2>
  <table>
    <thead>
      <tr>
        <!-- Creates Table Headers -->
        <th>Name</th>
        <th>Breed</th>
        <th>DOB</th>
        <th>Sex</th>
        <th>Weight</th>
        <th>Color</th>
        
      </tr>
    </thead>
    <tbody>
        <?php 
            //Calls Customer, Links with UserID and Stores CustID
            $customer = new Customer();
            $customer->findCustInfo($user->data()->id);
            $custid = $customer->data()->CustID;

            //Class call
            $dog = new Dog();

            //Finds all Dogs linked by CustID
            $dog->findDogArray($customer->data()->CustID);

            //Stores the Dogs Found
             $dogData = $dog->data();


            if(!empty($dogData)){
            //Lists Each Dog found in the Array
            foreach ($dogData as $dog) {
                    //Populates the Table Columns
                    echo '<tr>';
                    echo '<td>' . $dog->DogName . '</td>';
                    echo '<td>' . $dog->Breed . '</td>';
                    echo '<td>' . $dog->DogDOB . '</td>';
                    echo '<td>' . $dog->Sex . '</td>';
                    echo '<td>' . $dog->Weight . '</td>';
                    echo '<td>' . $dog->Color . '</td>';
                    // Add more columns for other dog details

                    echo '</tr>';
                }
            }

            
        ?>
    </tbody>
  </table>
    <div class="view-button-container">
        <a href="../Customer Portal/CustDogs.php">
            <button class="view-button">View My Dogs</button>
        </a>
    </div>

</div>
</div>
</body>
</html>
<?php } else {
            Redirect ::to('../UserHandling/login.php');
            }
?>