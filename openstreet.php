<?php
$servername = "localhost";
$username = "ozgun";
$password = "3340";
$dbname = "openstreet";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM `ways_tags` WHERE key_ways = 'highway'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

     //output data of each row
    while($row = $result->fetch_assoc()) {
        if ($row["value"] == "motorway"){
            $motorway = $motorway + 1;
            echo "<a href=\"way.php?wayid=".$row["way_id"]."\">".$row["value"]."</a>";
            echo "<br>";
        }
        if ($row["value"] == "trunk"){
            $trunk = $trunk + 1;
            echo "<a href=\"way.php?wayid=".$row["way_id"]."\">".$row["value"]."</a>";
            echo "<br>";
        }
//        echo "<a href=\"workout.php?workoutid=".$row["value"]."\">WORKOUT: ".$row["value"]."</a>";

    }
    echo $motorway;
} else {
    echo "0 results";
}
$conn->close();
?>