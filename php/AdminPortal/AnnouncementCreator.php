<?php
    require_once '../UserHandling/core/init.php';
        
    if (!Session::exists('home')) {
        echo '<p>'. Session::flash('home') .'</p>';
    }

    $user = new User();
    if($user->isLoggedIn()) {

       //Adds Admin NavBar if Admin Acct logged in
       if($user->data()->group == 3) {
        //include("../AdminPortal/AdminNavBar.php");

        if(Input::exists()){
            if(Token::check(Input::get('token'))) {
                
                //Validates
                $validate = new Validate();
                $validation = $validate->check($_POST,array());

                //if all rules are satisfied, create new 
                if($validation->passed()){

                    //Constructor Call
                    $announcement = new Announcement();

                    //Uploads new Announcment
                    try {
                        //Grabs Input for Users Table
                        $announcement->create(array(
                            'header' => Input::get('headerInput'),
                            'description' => Input::get('description'),
                            'age' => 0,
                            'date' => date('Y-m-d H:i:s'),
                        ));

                        //Code to Update age of all current announcements
                        $announcement->getAnnouncements();
                        $allAnnouncements = $announcement->data();

                        //Make sure there are other announcements to update age
                        if(!empty($allAnnouncements)){
                            foreach($allAnnouncements as $announcement){
                                $announceID = $announcement->id;
                                $announceAge = $announcement->age;
                                
                                $db = DB::getInstance();
                                $table = 'announcements';
                                $id = $announceID;
                                $idcolumn = 'id';
                                $fields = array(
                                    'age' => $announceAge + 1,
                                );

                                //updates
                                $db->updateWithID($table, $id, $idcolumn, $fields);
                            }
                        }


                        //Code to Redirect
                        Redirect::to('../AdminPortal/AdminHome.php');

                    }catch (Exception $e) {
                        die($e->getMessage()); //Outputs error
                    }

                    //Code to Redirect
                    Redirect::to('../AdminPortal/AdminHome.php');

                }else{
                    foreach ($validation->errors() as $error) {
                        echo $error, '<br>';
                    }
                }
                

            }
        }

    }

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/Announcement.css">

    <title>Announcement Page</title>
</head>
    <body> 
        <div class=content>
           
            <h2>Announcement Form</h2>

                <form action="#" method="post">
                <label for="headerInput">Message Header:</label>
                <input type="text" id="headerInput" name="headerInput">
                <br><br>

                <label for="description">Enter Announcement Message:</label>
                <textarea id="description" name="description" rows="4" cols="50"></textarea>

            <br>

            <input type="hidden" name="token" value="<?php echo token::generate(); ?>">
            <input type="submit" value="Submit">
    </form>
        </div>
    </body>
</html>

<?php
    }else{Redirect::to('../UserHandling/login.php');}
?>
