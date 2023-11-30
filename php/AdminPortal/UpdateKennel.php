<?php
    require_once '../UserHandling/core/init.php';
    
    if (!Session::exists('home')) {
        echo '<p>'. Session::flash('home') .'</p>';
    }

    $user = new User();
  

    if($user->isLoggedIn()) {

    //Adds Admin NavBar if Admin Acct logged in
    if($user->data()->group == 3 ){
        include("../AdminPortal/AdminNavBar.php");


    //session variable
    $kennelid = $_GET['id'];

    $kennel = New Kennel();

    $kennel->getKennelWithID($kennelid);

    if(Input::exists()) {
        if(Token::check(Input::get('token'))){

            $fieldsToUpdate = array(
                'KennelName' => Input::get('kennelName'),
                'isOccupied' => 0,
                'isBoarding' => Input::get('kennelType')
            );
            $key = 'KennelID';

              // UPDATE CUSTOMER TABLE
              if ($kennel->update($fieldsToUpdate, $key, $kennelid)) {
                echo "Update successful!";
                header("Refresh:0"); // Reload the page after 0 seconds (immediately)
            } else {
                echo "Update failed.";
            }

            Redirect::to('../AdminPortal/ControlPanel.php');
        }
    }


?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/KennelCreation.css">
    
    <title>Customer Dogs</title>
</head>
<body>
    <div class = 'content'>
     
    <fieldset>
    <form method="POST" class="KennelCreation-Form">
        <legend>Kennel Update</legend>
        <p>
            <!-- Asks for Kennel Name -->
            <label>What is the name of the kennel?</label>
            <input type="text" name="kennelName"  id="kennelNAme" value="<?php echo $kennel->data()->KennelName ?>"><br><br>

            <!-- Asks what type of kennel it is -->
            <label for="kennelType">Select a kennel type:</label>
            <select id="kennelType" name="kennelType">
                <option value="0">Daycare</option>
                <option value="1">Boarding</option>
            </select><br><br>

            <!-- Creates token and submits for completion -->
            <input type="hidden" name="token" value="<?php echo token::generate(); ?>">
            <input type="submit" value="Complete Kennel"><br><br>

        </p>
        </fieldset>
        </form>


</body>
</html> 
<?php  }else 
        { Redirect::to('../UserHandling/login.php');} //Redirect User to Login if not logged in
    }else 
    { Redirect::to('../UserHandling/login.php');} //Redirect User to Login if not logged in
?>