<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lab-09a</title>
</head>
<body>
    <?php

    $hostname = "localhost"; 
    $username = "pslay";
    $password = "BUXbZegP";
    $database = "pslay"; 

    $connect = mysqli_connect($hostname, $username, $password, $database) or die(mysqli_error($connect));
    print "<div>Connected to MySQL Database <b>$database</b></div>";

    $dropQuery = "DROP TABLE IF EXISTS photographs";
    mysqli_query($connect, $dropQuery) or die(mysqli_error($connect));
    $query = "CREATE TABLE photographs (
        picture_number INT PRIMARY KEY,
        subject VARCHAR(255),
        location VARCHAR(255),
        date_taken DATE,
        picture_url VARCHAR(255)
    )";
    
    mysqli_query($connect, $query) or die(mysqli_error($connect));

    $sampleData = [
        [1, 'Morty-1', 'Ontario', '2023-01-01', 'https://i.imgur.com/D0Q6edh.gif'],
        [2, 'Morty-2', 'Ontario', '2019-02-15', 'https://i.imgur.com/QJ365qX.gif'],
        [3, 'Turtle-1', 'Alberta', '2020-03-15', 'https://i.imgur.com/eWrz6Qi.jpeg'],
        [4, 'Turtle-2', 'Vancouver', '2022-03-25', 'https://i.imgur.com/VlIywV2.jpeg'],
        [5, 'Turtle-3', 'Alberta', '2023-04-15', 'https://i.imgur.com/Mj7rRew.jpeg'],
        [6, 'Cottage-1', 'London', '2020-04-16', 'https://i.imgur.com/y0l7pBS.jpeg'],
        [7, 'Cottage-2', 'London', '2019-05-15', 'https://i.imgur.com/M6WbGRu.jpeg'],
        [8, 'Cottage-3', 'London', '2018-06-15', 'https://i.imgur.com/6yBvrjC.jpeg'],
        [9, 'Anime-1', 'Mars', '2021-07-15', 'https://i.imgur.com/douh7U1.gif'],
        [10, 'Anime-2', 'Mars', '2022-08-15', 'https://i.imgur.com/LygOJ5M.gif']
    ];

    foreach ($sampleData as $data) {
        $insertQuery = "INSERT INTO photographs (picture_number, subject, location, date_taken, picture_url) 
                        VALUES ('$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]')";
        mysqli_query($connect, $insertQuery) or die(mysqli_error($connect));
    }

    mysqli_close($connect);
    ?>
</body>
</html>
