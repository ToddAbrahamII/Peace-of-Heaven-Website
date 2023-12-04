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
    <h1> Update or Delete </h1>

    <?php 
    //Generates the Table from the Database of All Dogs in the DB
    $dogId = $_GET['DogID'];
    // Constructor Call
    $dog = new Dog(); 

    // Store Dog Info
    $dog->findDogInfoWithDogID($dogId);
    $dogData = $dog->data();
    $custId = $dogData->CustID;

    // retrieve and store customer info
    $customer = new Customer();
    $customerData = $customer->findCustInfoWithCustID($custId);

    
    if (!empty($dogData)) {
        echo '<table>';
        //Creates Table Columns 
        echo '<tr>
        <th>Name</th>
        <th>Breed</th>
        <th>Color</th>
        <th>Age</th>
        <th>Owner</th>
        <th>Weight</th>
        <th>Color</th>
        <th>Dog Notes</th>
        <th>Manage</th>
        </tr>'; 

        // Get Customer Data 
        $customer->findCustInfoWithCustID($dogData->CustID);
        $customerData = $customer->getCustomerData();
        echo '<tr>'; // START ROW
        echo '<td>' . $dogData->DogName . '</td>';
        echo '<td>' . $dogData->Breed . '</td>';
        echo '<td>' . $dogData->Color . '</td>';
        echo '<td>' . $dogData->DogDOB .'</td>';
        echo '<td>' . $customerData->CustFirstName . ' ' . $customerData->CustLastName . '</td>';
        echo '<td>' . $dogData->Weight . '</td>';
        echo '<td>' . $dogData->Color . '</td>';
        echo '<td>' . $dogData->DogOtherInfo . '</td>';
        echo '<td>' 
            . '<p><a href="../Customer Portal/UpdateDogAccount.php?DogID='
            . urlencode($dogData->DogID) . '">Update</a></p>'. 
            '<p><a href="../Customer Portal/DeleteDog.php?DogID='
            . urlencode($dogData->DogID) . '">Delete</a></p>' .

            '</td>';
        echo '</tr>';

        echo '</table>';
    } else {
        //Error Handling for if there are not dogs found
        echo 'No dogs found for this customer.';
    }

?><br><br>

<div>

    <!-- Go to delete dog -->
    <a href="../Customer Portal/DeleteDog.php">
        <button>Delete a Dog Account</button>
    </a>

</body>
</html>
<?php }else 
        { Redirect::to('../UserHandling/login.php');} //Redirect User to Login if not logged in
?>