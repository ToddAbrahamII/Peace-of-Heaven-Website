<?php
    require_once '../UserHandling/core/init.php';
        
    if (!Session::exists('home')) {
        echo '<p>'. Session::flash('home') .'</p>';
    }

    $user = new User();
    if($user->isLoggedIn()) {

    //Adds Employee NavBar if Employee Acct logged in
    if($user->data()->group === 2){
        include("../Employee Portal/EmpNavBar.php");

    }

    //Adds Admin NavBar if Admin Acct logged in
    if($user->data()->group === 3){
        include("../AdminPortal/AdminNavBar.php");

    }

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/EmpHome.css">

    <title>Employee Portal</title>
</head>
<body>
    <div class=content>
    <h1> Welcome to the Employee Portal </h1>
    <p>Hello, <?php echo $user_data['User_Name']; ?>! </p>

    </div>
</body>
</html>
<?php } ?>