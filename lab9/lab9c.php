<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lab-09c</title>
    <style>
        .ontario-images {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .ontario-image {
            margin: 10px;
            text-align: center;
        }

        .ontario-image img {
            width: 400px;
            height: 400px;
        }
    </style>
</head>
<body>
    <?php
    function displayOntarioPictures($connect) {
        $query = "SELECT * FROM photographs WHERE location = 'Ontario'";
        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));

        echo "<h2>Ontario Pictures</h2>";

        if (mysqli_num_rows($result) > 0) {
            echo "<div class='ontario-images'>";
            
            while ($row = mysqli_fetch_assoc($result)) {
                $pictureUrl = $row['picture_url'];
                $subject = $row['subject'];
                $location = $row['location'];

                echo "<div class='ontario-image'>";
                echo "<img src='$pictureUrl' alt='$subject'>";
                echo "<p><b>Subject:</b> $subject</p>";
                echo "<p><b>Location:</b> $location</p>";
                echo "</div>";
            }

            echo "</div>";
        } else {
            echo "<p>No Ontario photos found.</p>";
        }
    }

    $hostname = "localhost"; 
    $username = "pslay";
    $password = "BUXbZegP";
    $database = "pslay"; 

    $connect = mysqli_connect($hostname, $username, $password, $database) or die(mysqli_error($connect));
    print "<div>Connected to MySQL Database <b>$database</b></div>";

    displayOntarioPictures($connect);

    mysqli_close($connect);
    ?>
</body>
</html>
