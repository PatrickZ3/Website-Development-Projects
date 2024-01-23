<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lab-09b</title>
</head>
<body>
    <?php
    function displayAllPictures($connect) {
        $query = "SELECT * FROM photographs";
        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));

        echo "<h2>All Images</h2>";
        echo "<div style='display: flex; flex-wrap: wrap;'>";

        while ($row = mysqli_fetch_assoc($result)) {
            $pictureUrl = $row['picture_url'];
            $subject = $row['subject'];
            $location = $row['location'];

            echo "<div style='margin: 10px; text-align: center;'>";
            echo "<img src='$pictureUrl' alt='$subject' style='width: 200px; height: 200px;'>";
            echo "<p><b>Subject:</b> $subject</p>";
            echo "<p><b>Location:</b> $location</p>";
            echo "</div>";
        }

        echo "</div>";
    }

    $hostname = "localhost"; 
    $username = "pslay";
    $password = "BUXbZegP";
    $database = "pslay"; 

    $connect = mysqli_connect($hostname, $username, $password, $database) or die(mysqli_error($connect));
    print "<div>Connected to MySQL Database <b>$database</b></div>";

    displayAllPictures($connect);

    mysqli_close($connect);
    ?>
</body>
</html>
