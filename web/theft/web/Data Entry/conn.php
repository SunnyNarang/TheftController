
<?php
    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "vintage";
    $database = "theft";
    $dbport = 3306;

    // Create connection 
    $conn = new mysqli($servername, $username, $password, $database, $dbport);
    mysqli_set_charset($conn,'utf8');
?>