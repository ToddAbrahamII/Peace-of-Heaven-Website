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
    $announceid = $_GET['id'];

    $announcement = New Announcement();

    $announcement->getAnnouncementsWithID($announceid);

    if(Input::exists()) {
        if(Token::check(Input::get('token'))){

            $fieldsToUpdate = array(
                'header' => Input::get('headerInput'),
                'description' => Input::get('description'),
                'age' => 0,
                'date' => date('Y-m-d H:i:s')
            );
            $key = 'id';

              // UPDATE CUSTOMER TABLE
              if ($announcement->update($fieldsToUpdate, $key, $announceid)) {
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
        <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/Announcement.css">
    
    <title>Customer Dogs</title>
</head>
<body>
    <div class = 'content'>
     
           
        <h2>Announcement Form</h2>

                <form action="#" method="post">
                <label for="headerInput">Message Header:</label>
                <input type="text" id="headerInput" name="headerInput" value="<?php echo $announcement->data()->header?>">
                <br><br>

                <label for="description">Enter Announcement Message:</label>
                <textarea id="description" name="description" rows="4" cols="50"> <?php echo $announcement->data()->description ?></textarea>

                <br>

                <input type="hidden" name="token" value="<?php echo token::generate(); ?>">
                <input type="submit" value="Update">
                </form>
    
    </div>


</body>
</html> 
<?php  }else 
        { Redirect::to('../UserHandling/login.php');} //Redirect User to Login if not logged in
    }else 
    { Redirect::to('../UserHandling/login.php');} //Redirect User to Login if not logged in
?>