<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lab-09d</title>
    <style>
        .search-form {
            margin: 20px;
        }

        .search-results {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin: 20px;
        }

        .result-image {
            margin: 10px;
            text-align: center;
        }

        .result-image img {
            width: 200px;
            height: 200px;
        }
    </style>
</head>
<body>
    <?php
    function generateLocationOptions($connect) {
        $query = "SELECT DISTINCT location FROM photographs";
        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));

        echo "<select name='location'>";
        echo "<option value=''>-- Select Location --</option>";

        while ($row = mysqli_fetch_assoc($result)) {
            $location = $row['location'];
            echo "<option value='$location'>$location</option>";
        }

        echo "</select>";
    }

    function generateYearOptions($connect) {
        $query = "SELECT DISTINCT YEAR(date_taken) AS year FROM photographs";
        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));

        echo "<select name='year'>";
        echo "<option value=''>-- Select Year --</option>";

        while ($row = mysqli_fetch_assoc($result)) {
            $year = $row['year'];
            echo "<option value='$year'>$year</option>";
        }

        echo "</select>";
    }

    function displaySearchResults($connect, $location, $year) {
        $query = "SELECT * FROM photographs WHERE location = '$location' AND YEAR(date_taken) = '$year'";
        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));

        echo "<h2>Search Results</h2>";

        if (mysqli_num_rows($result) > 0) {
            echo "<div class='search-results'>";

            while ($row = mysqli_fetch_assoc($result)) {
                $pictureUrl = $row['picture_url'];
                $subject = $row['subject'];
                $location = $row['location'];

                echo "<div class='result-image'>";
                echo "<img src='$pictureUrl' alt='$subject'>";
                echo "<p><b>Subject:</b> $subject</p>";
                echo "<p><b>Location:</b> $location</p>";
                echo "</div>";
            }

            echo "</div>";
        } else {
            echo "<p>No matching photos found.</p>";
        }
    }

    $hostname = "localhost";
    $username = "pslay";
    $password = "BUXbZegP";
    $database = "pslay";

    $connect = mysqli_connect($hostname, $username, $password, $database) or die(mysqli_error($connect));
    print "<div>Connected to MySQL Database <b>$database</b></div>";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $selectedLocation = $_POST["location"];
        $selectedYear = $_POST["year"];

        displaySearchResults($connect, $selectedLocation, $selectedYear);
    } else {
        echo "<form class='search-form' method='post' action='lab9d.php'>";
        echo "<label for='location'>Select Location:</label>";
        generateLocationOptions($connect);
        echo "<br><br>";
        echo "<label for='year'>Select Year:</label>";
        generateYearOptions($connect);
        echo "<br><br>";
        echo "<input type='submit' value='Search'>";
        echo "</form>";
    }

    mysqli_close($connect);
    ?>
</body>
</html>
