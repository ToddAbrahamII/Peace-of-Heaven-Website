<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Calendar</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .prev, .next {
            cursor: pointer;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            margin: 5px;
        }

        .book-now-btn {
            cursor: pointer;
            padding: 5px;
            border: none;
            border-radius: 3px;
            background-color: #007BFF;
        }

        .unavailable-btn {
            background-color: #dddddd;
            color: #555;
            cursor: not-allowed;
        }
    </style>
</head>
<body>

<?php
// Get the current year and month
$year = isset($_GET['year']) ? $_GET['year'] : date("Y");
$month = isset($_GET['month']) ? $_GET['month'] : date("m");

// Get the first day of the month and the total number of days in the month
$firstDay = date("w", mktime(0, 0, 0, $month, 1, $year));
$totalDays = date("t", mktime(0, 0, 0, $month, 1, $year));

// Define availability for each day
function getAvailability($day, $month, $year) {
    $currentDate = date("Y-m-d");
    $selectedDate = "$year-$month-" . sprintf("%02d", $day);

    if ($selectedDate < $currentDate) {
        return 'unavailable';
    } else {
        // Add your logic to determine availability for future dates
        // For now, return 'available' as a placeholder
        return 'available';
    }
}

?>

<h2><?php echo date("F Y", mktime(0, 0, 0, $month, 1, $year)); ?></h2>

<a class="prev" href="?year=<?php echo ($month == 1) ? $year - 1 : $year; ?>&month=<?php echo ($month == 1) ? 12 : $month - 1; ?>">Previous Month</a>
<a class="next" href="?year=<?php echo ($month == 12) ? $year + 1 : $year; ?>&month=<?php echo ($month == 12) ? 1 : $month + 1; ?>">Next Month</a>

<table>
    <tr>
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
        $dayCount = 1;

        // Print blank cells until the first day of the month
        for ($i = 0; $i < $firstDay; $i++) {
            echo "<td>&nbsp;</td>";
            $dayCount++;
        }

        // Print the days of the month
        for ($day = 1; $day <= $totalDays; $day++) {
            $availability = getAvailability($day, $month, $year);

            echo "<td>";
            echo "<span value='$year-$month-" . sprintf("%02d", $day) . "' class='$availability'>$day</span>";
            
            // Check if the date is before the current date
            if ($availability === 'unavailable') {
                echo "<br><button class='book-now-btn unavailable-btn'>Unavailable</button>";
            } else {
                // For future dates, display the Book Now button
                echo "<br><button class='book-now-btn' onclick='bookNow(\"$year-$month-" . sprintf("%02d", $day) . "\")'>Book Now</button>";
            }

            echo "</td>";

            // Start a new row every 7 days
            if ($dayCount % 7 == 0) {
                echo "</tr><tr>";
            }

            $dayCount++;
        }

        // Fill in remaining blank cells
        while ($dayCount % 7 != 1) {
            echo "<td>&nbsp;</td>";
            $dayCount++;
        }
        ?>
    </tr>
</table>



</body>
</html>
