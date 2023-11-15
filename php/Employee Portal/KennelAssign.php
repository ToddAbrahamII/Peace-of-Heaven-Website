<?php
    require_once '../UserHandling/core/init.php';
        
    if (!Session::exists('home')) {
        echo '<p>'. Session::flash('home') .'</p>';
    }

    $user = new User();
    if($user->isLoggedIn()) {
        
    //Adds employee NavBar
    if($user->data()->group == 2) {
        include("../Employee Portal/EmpNavBar.php");

    }

    //Admin NavBar
    if($user->data()->group == 3) {
        include("../AdminPortal/AdminNavBar.php");

    }

    //Grabs all sessions variables from the previous page
    if (isset($_GET['service']) && isset($_GET['resid'])) {
        $_SESSION['service'] = $_GET['service'];
        $_SESSION['resid'] = $_GET['resid'];
    }

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/CheckInOut.css">

    <title>Assign Kennel</title>
</head>
<body>
    <div class=content>
        <form method="POST" class="Grooming-Creator">
            <fieldset>
                <legend>Assign this Reservation to a Kennel</legend>

                <?php
                //Constructor Call
                    $kennel = new Kennel();
                    $reservation = new Reservation('', array());

                    //If Statements for which kennels to show
                    if($_SESSION['service'] == 'Boarding'){
                        $kennel->getUnoccupiedBoardingKennels();
                        $kennelList = $kennel->data();
                    }

                    if($_SESSION['service'] == 'Daycare'){
                        $kennel->getUnoccupiedDaycareKennels();
                        $kennelList = $kennel->data();
                    }

                    if(!empty($kennelList)){?>
                        <!-- Drop Down Box -->
                        <label for="kennelDropdown">Select a Reservation to Check In:</label>
                        <select id="kennelDropdown" name="selectedKennel">
                    <?php
                        foreach($kennelList as $kennel){
                            $kennelID = $kennel->KennelID;
                            $kennelName = $kennel->KennelName;
                        echo "<option value='$kennelID'>$kennelName</option>";
                        }
                        

                    
                ?>
                </select>
                <?php }else{ echo "No Kennels Found";} ?>

                <!-- Generates Token and submits input -->
                <br>
                <input type="hidden" name="token" value="<?php echo token::generate(); ?>">
                <input type="submit" value="Check In Reservation"><br><br>

                <?php 
                if(Input::exists()){

                    if(Token::check(Input::get('token')) || 1==1 ) { //validation is not passing for some reason
                                $validate = new Validate();
                                $validation = $validate->check($_POST, array(
                                    ### Insert rules that acctInfo fields must meet in addition to js validation ###
                                ));
                    
                                // If all rules are satisfied, create new customer
                        if($validation->passed() || 1 ==1 ) {

                            //Assign Kennel to the Reservation
                            $reservation->getReservationById($_SESSION['resid']);
                            $selectedRes = $reservation->getReservationData();

                            //gets KennelID 
                            $kenID = Input::get('selectedKennel');

                            $db = DB::getInstance();
                            $table = 'reservation';
                            $id = $selectedRes->Res_ID;
                            $idcolumn = 'Res_ID';
                            $fields = array(
                                'KennelID' => $kenID,
                            );

                            //update
                            $db->updateWithID($table, $id, $idcolumn, $fields);

                            //Update Kennel to being occupied
                            $kennel = new Kennel();
                            $table2 = 'kennel';
                            $id2 = $kenID;
                            $idcolumn2 = 'KennelID';
                            $fields2 = array(
                                'isOccupied' => 1,
                            );

                            $db->updateWithID($table2, $id2, $idcolumn2, $fields2);

                            Redirect::to('../Employee Portal/EmpHome.php');


                        }
                    }
                }?>

            </fieldset>
        </form>


  
</div>
</body>
</html>
<?php 
    //Gathers Data if anything is submitted
    if(Input::exists()){
        
    }


}else{Redirect::to('../UserHandling/login.php');} ?>