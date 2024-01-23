<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lab-09e</title>
    <style>
        body {
            background-color: #f2f2f2; /* Light grey background */
            font-family: Arial, sans-serif;
            color: #333; /* Dark grey text color */
        }

        .random-image {
            text-align: center;
            margin: 20px;
            background-color: #fff; /* White background for the image container */
            padding: 20px;
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Box shadow for a subtle lift */
        }

        .random-image img {
            width: 400px;
            height: 400px;
            border: 4px solid #ddd; /* Light grey border around the image */
            border-radius: 6px; /* Rounded corners for the image */
        }

        .total-images {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php
    function displayRandomImage($connect) {
        $query = "SELECT * FROM photographs ORDER BY RAND() LIMIT 1";
        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));

        echo "<div class='random-image'>";
        echo "<h2>Random Image</h2>";

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $pictureUrl = $row['picture_url'];
            $subject = $row['subject'];
            $location = $row['location'];

            echo "<img src='$pictureUrl' alt='$subject'>";
            echo "<p><b>Subject:</b> $subject</p>";
            echo "<p><b>Location:</b> $location</p>";
        } else {
            echo "<p>No images found.</p>";
        }

        echo "</div>";
    }

    function displayTotalImages($connect) {
        $query = "SELECT COUNT(*) AS total FROM photographs";
        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $totalImages = $row['total'];

            echo "<div class='total-images'>";
            echo "<p>Total Images in the Database: $totalImages</p>";
            echo "</div>";
        }
    }

    $hostname = "localhost";
    $username = "pslay";
    $password = "BUXbZegP";
    $database = "pslay";

    $connect = mysqli_connect($hostname, $username, $password, $database) or die(mysqli_error($connect));
    print "<div>Connected to MySQL Database <b>$database</b></div>";

    displayRandomImage($connect);
    displayTotalImages($connect);

    mysqli_close($connect);
    ?>
</body>
</html>
