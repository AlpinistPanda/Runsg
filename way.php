<?php
/**
 * Created by PhpStorm.
 * User: ozgunbalaban
 * Date: 21/1/18
 * Time: 4:00 PM
 */

// 1. Create a database connection
$dbhost = "localhost";
$dbuser = "ozgun";
$dbpass = "3340";
$dbname = "openstreet";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
// Test if connection occurred.
if(mysqli_connect_errno()){
    die("Database connection failed: ".
        mysqli_connect_error().
        "(" . mysqli_connect_errno() . ")");
}
?>


<?php
// 2. Perform database query

$query = "SELECT * FROM ways_tags WHERE way_id = ".$_GET["wayid"].";";
$query .= "SELECT * FROM ways_nodes WHERE way_id = ".$_GET["wayid"];


if ($connection->multi_query($query)) {
    do {
        /* store first result set */
        if ($result = $connection->store_result()) {
            while ($row = $result->fetch_row()) {
//                var_dump($row);
               echo $row["key_ways"];
                if ($row["key_ways"]=="name"){
                    echo "NAME OF THE ROAD: ". $row["value"];
                    printf( "Hello again");
                }
            }
            $result->free();
        }
        /* print divider */
        if ($connection->more_results()) {
            echo "<br>";
            printf("-----------------\n");
            echo $row["key_ways"];
        }
        echo $row;
    } while ($connection->next_result());
}

?>

<?php
// 5. Close database connection
mysqli_close($connection);
?>