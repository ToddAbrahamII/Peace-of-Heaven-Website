<?php
    require_once '../UserHandling/core/init.php';
        
    if (!Session::exists('home')) {
        echo '<p>'. Session::flash('home') .'</p>';
    }

    //Class Constructor Calls
    $user = new User();
    $customer = new Customer();
    $dog = new Dog();

    //Get Current Month and Date for Calendar
    $currentMonth = date('m');
    $currentYear = date('Y');

    //Checks if user is logged in
    if($user->isLoggedIn()) {

    //Adds Customer NavBar if Customer Acct logged in
    if($user->data()->group == 1){
        include("../Customer Portal/CustNavBar.php");
    }

    //Adds Employee NavBar if Employee Acct logged in
    if($user->data()->group == 2){
        include("../Employee Portal/EmpNavBar.php");
    }

    //Adds Admin NavBar if Admin Acct logged in
    if($user->data()->group == 3 ){
        include("../AdminPortal/AdminNavBar.php");
    }

?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/DayCareForm.css">
    </head>
<body>
    <div class='content'>
        <!-- Add HTML FOR CALENDAR, HEADER, AND TABLE -->
        <div class='calendar'>
        <!--Implement logic that on -1 to $currentMonth and if $currentMonth =1 then -1 to $currentYear  -->
        <button id="prev-month" onclick="prevMonth()">Previous Month</button>

            <h2><?php echo"$currentMonth/$currentYear"?></h2>

            <button id="next-month" onclick="nextMonth()">Next Month</button>

        <!-- Creates Table with List of Days -->
        <table>
        <tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>

        <?php
        // Calculate days in the current month and the first day of the month
        $daysInMonth = date('t', strtotime("$currentYear-$currentMonth-01"));
        $firstDay = date('w', strtotime("$currentYear-$currentMonth-01"));
        ?>

        <tr>
    
        <?php
        // Fill the empty cells at the beginning of the month
        for ($i = 0; $i < $firstDay; $i++) {
            echo "<td></td>";
        }

    // Generate calendar cells for each day
    for ($day = 1; $day <= $daysInMonth; $day++) {
        // Fetch data for the day from the database
        // Replace this with actual database retrieval
        $date = "$currentYear-$currentMonth-$day";
        $is_booked = false; // Replace with actual data

        $cellClass = $is_booked ? "booked" : "available";

        echo "<td class='$cellClass'>";
        echo "<div class='day'>$day</div>";
        echo "<div class='event'>$event_title</div>";
        echo "<button class='book-now'>Book Now</button>";
        echo "</td>";

        // Start a new row if it's a Saturday
        if (($day + $firstDay) % 7 == 0) {
            echo "</tr><tr>";
        }
        }

    // Close any remaining cells in the last row
    while (($day + $firstDay) % 7 != 0) {
        echo "<td></td>";
        $day++;
         }
        ?>

    </tr>
    </table>

    </div>
</body>
</html>
<?php }else{Redirect::to('../UserHandling/login.php');}
?>