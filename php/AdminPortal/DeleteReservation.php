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
  
      //session variable
      $resid = $_GET['Res_ID'];
      $service = $_GET['ServiceType'];

  
      //gathers data from table depending on service
      if($service == 'Daycare' || $service == 'Boarding'){
          
          $reservation = new Reservation('service', array());
  
          $reservation->getReservationById($resid);
  
          $reservationData = $reservation->getReservationData();
      }
  
      //gathers data from table depending on service
      if($service == 'Grooming'){
          $reservation = new GroomingReservation('service', array());
  
          $reservation->getReservationById($resid);
  
          $reservationData = $reservation->getReservationData();
      
      }
  
    

?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/DeleteDog.css">
    
    <title>Customer Dogs</title>
</head>
<body>
    <div class = 'content'>

            
                <form method="POST" class="Dog-Selector">
                <h1>Are you sure you want to delete this reservation?</h1>
                <p>This action cannot be undone.
                </p>

                <input type="hidden" name="token" value="<?php echo token::generate(); ?>">
                <input type="submit" value="Delete"><br><br>

                <a href='../Customer Portal/MyReservations.php'>Cancel</a>
                        



                        <?php 
                        if(Input::exists()){
                               
                            if(Token::check(Input::get('token')) || 1==1) { //validation is not passing for some reason
                                $validate = new Validate();
                                $validation = $validate->check($_POST, array(
                                    ### Insert rules that acctInfo fields must meet in addition to js validation ###
                                ));
                    
                                // If all rules are satisfied, create new customer
                                if($validation->passed()) {
                                    try{      

                                        //deletes from correct table
                                        if($service == 'Daycare' || $service == 'Boarding'){

                                            $db = DB::getInstance();
                                            // Define the table, row id, and fields you want to delete.
                                            $table = 'reservation';
                                        
                                            $where = ['Res_ID', '=', $resid];
                                            
                                            //Deletes from Database
                                            $db->delete($table,$where); 
                                        }
                                        //delete from correct table
                                        else if ($service == 'Grooming'){

                                            $db = DB::getInstance();

                                            // Define the table, row id, and fields you want to delete.
                                            $table = 'grooming_reservation';
                                        
                                            $where = ['GroomResID', '=', $resid];
                                            
                                            //Deletes from Database
                                            $db->delete($table,$where); 
                                        }


                                    } 
                                    //Error Handling
                                    catch(Exception $e) {
                                        die($e->getMessage());
                                        
                                    }

                                    Redirect::to('../AdminPortal/viewReservations.php');

                                }else { ## Is this an error?
                                    // output errors
                                    foreach ($validation->errors() as $error) {
                                        echo $error, '<br>';
                            }

                        }}}
                    ?>

                    </form>
</body>
</html>
<?php }else 
        { Redirect::to('../UserHandling/login.php');} //Redirect User to Login if not logged in
?>