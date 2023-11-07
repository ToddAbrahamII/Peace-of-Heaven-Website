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
    // if($user->data()->group == 1){
    //     include("../Customer Portal/CustNavBar.php");
    // }

    // //Adds Employee NavBar if Employee Acct logged in
    // if($user->data()->group == 2 ){
    //     include("../Employee Portal/EmpNavBar.php");

    // }

    // //Adds Admin NavBar if Admin Acct logged in
    // if($user->data()->group == 3 ){
    //     include("../AdminPortal/AdminNavBar.php");

    // }
    
    $customer->findCustInfo($user->data()->id);
    $custid = $customer->data()->CustID;
    //print_r($customer->data()->CustID);
    $dog->findDogInfo($customer->data()->CustID);

    print_r($dog->data());



}
?>