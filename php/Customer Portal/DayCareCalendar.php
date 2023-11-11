<?php
    require_once '../UserHandling/core/init.php';
        
    if (!Session::exists('home')) {
        echo '<p>'. Session::flash('home') .'</p>';
    }

    //Makes Sure User is Logged In
    $user = new User();
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

    //Grabs Current Year and Current Month
    $year = isset($_GET['year']) ? $_GET['year'] : date("Y");
    $month = isset($_GET['month']) ? $_GET['month'] : date("m");

    //Calculate first day of the month and total number of days
    $firstDay = date("w", mktime(0, 0, 0, $month, 1, $year));
    $totalDays = date("t", mktime(0, 0, 0, $month, 1, $year));

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/DayCareCalendar.css">

    <title>Day Care Calendar</title>
</head>
    <body>
        <div class=content>
            <!-- Header with the Month and the Year -->
            <h2><?php echo date("F Y", mktime(0, 0, 0, $month, 1, $year)); ?></h2>

            <!-- Buttons to go to the next month -->
            <a class="prev" href="?year=<?php echo ($month == 1) ? $year - 1 : $year; ?>&month=<?php echo ($month == 1) ? 12 : $month - 1; ?>">Previous Month</a>
            <a class="next" href="?year=<?php echo ($month == 12) ? $year + 1 : $year; ?>&month=<?php echo ($month == 12) ? 1 : $month + 1; ?>">Next Month</a>

            <table>
                <tr>
                    <!-- Days of the week -->
                    <th>Sun</th>
                    <th>Mon</th>
                    <th>Tue</th>
                    <th>Wed</th>
                    <th>Thu</th>
                    <th>Fri</th>
                    <th>Sat</th>
                </tr>
                <tr>
                    <?php
                    //Count to move through each of the days
                    $dayCount = 1;

                    //stores the current date to stop people from booking before the day
                    $currentYear = date("Y");
                    $currentMonth = date("m");
                    $currentDate = date("Y-m-d");

                    for ($day = 1; $day <= $totalDays; $day++) {
                        echo "<td>";
                        $formattedDate = "$year-$month-" . sprintf("%02d", $day);

                        // Check if the selected month is the current month or a future month
                        if (($year > $currentYear) || ($year == $currentYear && $month >= $currentMonth)) {
                            // Check if the date is before the current date
                            if ($formattedDate < $currentDate) {
                                echo "Unavailable";
                            } else {
                                // Print the numerical day
                                echo "<span value='$formattedDate'>$day</span>";
                                // Display the formatted date
                                echo "<br>$formattedDate";
                                // Display the "Book Now" button
                                echo "<br><button>Book Now</button>";
                            }
                        } else {
                            echo "Unavailable";
                        }

                        echo "</td>";

                        // Start a new row every 7 days
                        if ($dayCount % 7 == 0) {
                            echo "</tr><tr>";
                        }

                        $dayCount++;
                    }




                    ?>
                </tr>
            </table>
        </div>
    </body>

+    </html>


<?php }else{Redirect::to('../UserHandling/login.php');}?>