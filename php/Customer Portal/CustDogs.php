<?php
    require_once '../UserHandling/core/init.php';
    
    if (!Session::exists('home')) {
        echo '<p>'. Session::flash('home') .'</p>';
    }

    $user = new User();
    $customer = new Customer();
    $dog = new Dog();

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
    
    //Matches UserID to CustID with account logged in
    $customer->findCustInfo($user->data()->id);

    //Stores the CustID
    $custid = $customer->data()->CustID;

    //Finds all Dogs linked by CustID
    $dog->findDogArray($customer->data()->CustID);

    //Stores the Dogs Found
    $dogData = $dog->data();

?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/CustDogs.css">
    
    <title>Customer Dogs</title>
</head>
<body>
    <div class = 'content'>
    <h1> Your Linked Dog Accounts </h1>

    <?php //Generates the Table from the Database of All Dogs in the DB
    if (!empty($dogData)) {
        echo '<table>';
        //Creates Table Columns 
        echo '<tr><th>Dog Name</th><th>Breed</th><th>Age</th><th>Color</th></tr>'; 

        foreach ($dogData as $dog) {
            //Populates the Table Columns
            echo '<tr>';
            echo '<td>' . $dog->DogName . '</td>';
            echo '<td>' . $dog->Breed . '</td>';
            echo '<td>' . $dog->DogDOB . '</td>';
            echo '<td>' . $dog->Color . '</td>';
            // Add more columns for other dog details

            echo '</tr>';
        }

        echo '</table>';
    } else {
        //Error Handling for if there are not dogs found
        echo 'No dogs found for this customer.';
    }

?>
</div>
</body>
</html>
<?php }else 
        { Redirect::to('../UserHandling/login.php');} //Redirect User to Login if not logged in
?>