<?php
    require_once '../UserHandling/core/init.php';
    
    if (!Session::exists('home')) {
        echo '<p>'. Session::flash('home') .'</p>';
    }

    $user = new User();
    $customer = new Customer();
    $dog = new Dog();

    if($user->isLoggedIn()) {

    //Adds Admin NavBar if Admin Acct logged in
    if($user->data()->group == 3 ){
        include("../AdminPortal/AdminNavBar.php");

    
    
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
        <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/DeleteKennel.css">
    
    <title>Announcement Deletetion</title>
</head>
<body>
    <div class = 'content'>
    <form method="POST" class="Kennel-Selector">
        <fieldset>
            <legend>Select an Announcement to Delete</legend>
            <br><br>

                <!-- Php code for drop down menu for dogs --> 
                <?php
                        $kennel = new Kennel();

                        $kennel->getKennels();

                        $kennelData = $kennel->data();



                        // Check if $dogData is not empty
                        if (!empty($kennelData)) {
                            ?>  
                                <!-- Dog Option for Each Dog in the Table -->
                                <!-- <label for="dogDropdown">Select a dog:</label> -->
                                <select id="kennelDropdown" name="selectedKennel">
                                    <?php foreach ($kennelData as $kennel) {
                                        $kennelID = $kennel->KennelID;
                                        $kennelName = $kennel->KennelName;
                                        echo "<option value='$kennelID'>$kennelName</option>";
                                    } ?>
                                    </select>
                                

                            <?php
                        } else  {
                            // Prints No Dogs Statement
                            echo "No Kennels found.";
                        }
                        ?>

                        <!-- Generates Token and submits input -->
                        <br><br><br>
                        <input type="hidden" name="token" value="<?php echo token::generate(); ?>">
                        <input type="submit" value="Delete"><br><br>
                        

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
                                        //Gets the selected Dogs Info
                                        $selectedKennelID = Input::get('selectedKennel');

                                        $db = DB::getInstance();

                                        // Define the table, row id, and fields you want to delete.
                                        $table = 'kennel';
                                
                                        $where = ['KennelID', '=', $selectedKennelID];
                                        
                                        //Deletes from Database
                                        $db->delete($table,$where); 
                                 

                                    } 
                                    //Error Handling
                                    catch(Exception $e) {
                                        die($e->getMessage());
                                        
                                    }

                                    Redirect::to('../AdminPortal/ControlPanel.php');

                                }else { ## Is this an error?
                                    // output errors
                                    foreach ($validation->errors() as $error) {
                                        echo $error, '<br>';
                            }

                        }}}
                    ?>
                    </fieldset>
            </form>
    </div>


</body>
</html>
<?php }else 
        { Redirect::to('../UserHandling/login.php');} //Redirect User to Login if not logged in; 
    }else 
        { Redirect::to('../UserHandling/login.php');} //Redirect User to Login if not logged in
?>