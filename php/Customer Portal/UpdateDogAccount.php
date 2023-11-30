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
    $dogid = $_GET['DogID'];

    //Stores the Dog Selected
    $dog->findDogInfoWithDogID($dogid);

    $dogData = $dog->data();

    if(Input::exists()) {
        if(Token::check(Input::get('token'))){

            $fieldsToUpdate = array(
                        'DogName' => Input::get('DogName'),
                        'Breed' => Input::get('Breed'),
                        'DogDOB' => Input::get('DogDOB'),
                        'Sex' => Input::get('sex'),
                        'isFixed' => Input::get('fixed'),
                        'Weight' => Input::get('DogWeight'),
                        'Color' => Input::get('DogColor'),
                        'DogOtherInfo' => Input::get('DogOtherInfo'),
            );
            $key = 'DogID';

              // UPDATE CUSTOMER TABLE
              if ($dog->update($fieldsToUpdate, $key, $dogid)) {
                echo "Update successful!";
                header("Refresh:0"); // Reload the page after 0 seconds (immediately)
            } else {
                echo "Update failed.";
            }

            Redirect::to('../Customer Portal/CustDogs.php');
        }
    }


?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/UpdateDogAccount.css">
    
    <title>Customer Dogs</title>
</head>
<body>
    <div class = 'content'>
    <form method="POST" class="Dog-Selector">
        <fieldset>
           
        <legend>Dog General Information</legend>
                    <p> 
                            <!-- Gets Dog Name From Input -->
                            <label for="DogName">Update dog name? </label>
                            <input type="text" name="DogName" id="DogName" required
                            value="<?php echo $dogData->DogName?>"><br><br>

                            <!-- Gets Dog Breed From Input -->
                            <label for="Breed">Update breed? </label>
                            <input type="text" name="Breed" id="Breed" required
                            value="<?php echo $dogData->Breed?>"><br><br>

                            <!-- Gets Dog DOB From Input -->
                            <label for="DogDOB">Update dog's date of birth?</label>
                            <input type="date" name ="DogDOB" id="DogDOB" required
                            value="<?php echo $dogData->DogDOB?>"><br><br>
                            
                            <!-- Gets Dog Sex from Male and Female Option -->
                            <label for="DogSex">Update the sex of your dog?</label>
                            <input type="radio" id="M" name="sex" value="M">
                            <label for="M">Male</label>

                            <input type="radio" id="F" name="sex" value="F">
                            <label for="F">Female</label><br><br>

                            
                            <!-- Gets If the Dog is Fixed from Options -->
                            <label>Update if your dog has been fixed?</label>
                            <input type="radio" id="T" name="fixed" value="1">
                            <label for="T">Fixed</label>

                            <input type="radio" id="F" name="fixed" value="0">
                            <label for="F">Not Fixed</label><br><br>
                            
                            <!-- Gets the Dog's Weight from Input -->
                            <label for="DogWeight"> Update dog's weight?</label>
                            <input type="number" id="DogWeight" name="DogWeight" required
                            value="<?php echo $dogData->Weight?>"><br><br>

                            <!-- Gets the Dog's Color from Input -->
                            <label for="DogColor">Update dog's color</label>
                            <input type="text" id="DogColor" name="DogColor" required
                            value="<?php echo $dogData->Color?>"><br><br>
                            
                            <!-- Gets the Dog's Other Information -->
                            <label for="DogOtherInfo">Update if there anything else you would like to tell us about your dog?</label>
                            <input type="text" id="DogOtherInfo" name="DogOtherInfo"
                            value="<?php echo $dogData->DogOtherInfo?>"><br><br>

                            <!-- Generates token and submits -->
                            <input type="hidden" name="token" value="<?php echo token::generate(); ?>">
                            <input type="submit" value="Update"><br><br>
                        </p>




                    </fieldset>
            </form>
    </div>


</body>
</html>
<?php }else 
        { Redirect::to('../UserHandling/login.php');} //Redirect User to Login if not logged in
?>