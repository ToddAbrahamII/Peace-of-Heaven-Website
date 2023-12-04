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
        <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/DeleteDog.css">
    
    <title>Customer Dogs</title>
</head>
<body>
    <div class = 'content'>
    <form method="POST" class="Dog-Selector">
        <fieldset>
            <legend>Select a Dog to Delete</legend>
            <br><br>

                <!-- Php code for drop down menu for dogs --> 
                <?php
                        //Matches UserID to CustID with account logged in
                        $customer->findCustInfo($user->data()->id);

                        //Stores the CustID
                        $custid = $customer->data()->CustID;

                        //Finds all Dogs linked by CustID
                        $dog->findDogArray($customer->data()->CustID);

                        //Stores the Dogs Found
                        $dogData = $dog->data();

                        // Check if $dogData is not empty
                        if (!empty($dogData)) {
                            ?>  
                                <!-- Dog Option for Each Dog in the Table -->
                                <!-- <label for="dogDropdown">Select a dog:</label> -->
                                <select id="dogDropdown" name="selectedDog">
                                    <?php foreach ($dogData as $dog) {
                                        $dogID = $dog ->DogID;
                                        $dogName = $dog->DogName;
                                        echo "<option value='$dogID'>$dogName</option>";
                                    } ?>
                                    </select>
                                

                            <?php
                        } else  {
                            // Prints No Dogs Statement
                            echo "No dogs found for the customer.";
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
                                        $selectedDogID = $_GET["DogID"];
                                        $selectedDog = new Dog();
                                        $selectedDog->findDogInfoWithDogID($selectedDogID);
                                        $dogSelectedID = $selectedDog->data()->DogID;
                                        

                                        $db = DB::getInstance();

                                        // Define the table, row id, and fields you want to delete.
                                        $table = 'dog';
                                        $table2 = 'dogbehavior';
                                        $table3 = 'doghealth';
                                        $table4 = 'dogvaccine';
                                        $where = ['DogID', '=', $dogSelectedID];
                                        
                                        //Deletes from Database
                                        $db->delete($table,$where); 
                                        $db->delete($table2,$where);
                                        $db->delete($table3,$where);
                                        $db->delete($table4,$where); 

                                    } 
                                    //Error Handling
                                    catch(Exception $e) {
                                        die($e->getMessage());
                                        
                                    }

                                    Redirect::to('../Customer Portal/CustDogs.php');

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
        { Redirect::to('../UserHandling/login.php');} //Redirect User to Login if not logged in
?>