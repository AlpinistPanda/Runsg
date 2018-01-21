<?php
/**
 * Created by PhpStorm.
 * User: 1000891
 * Date: 5/22/2017
 * Time: 4:28 PM
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


    <!DOCTYPE html PUBLIC "-//W3C">

    <html lang="eng">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <title>Workouts</title>

    </head>
    <body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">BIG-DID</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li><a href="#">BIG-DID</a></li>
                    <li><a href="#">District</a></li>
                    <li ><a href="users.php">Users</a></li>
                    <li  class="active"><a href="workouts.php">Workouts</a></li>
                    <li><a href="heatmap2.php">Maps</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-2 sidenav">
                <p><a href="#">Link1</a></p>
                <p><a href="#">Link2</a></p>
                <p><a href="#">Link3</a></p>
            </div>

            <div class="col-sm-8 text-left">
                <!--        <div class="container">-->
                <div style="clear:both"></div>
                <br />

                <!--        </div>-->




                <?php
                // 2. Perform database query
                $query = "SELECT * FROM `ways_tags` WHERE key_ways = 'highway'";
                $result = mysqli_query($connection,$query);

                // Test if there was a query error
                if(!$result){
                    die("Database Query failed.");
                }
                ?>
                <h2>List of streets in SINGAPORE</h2>

                <p>These are the principal tags for the road network. They range from the most to least important.
                        </p>

                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Key</th>
                        <th>Value</th>
                        <th>Comment</th>
                        <th>Photo</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>highway</td>
                        <td>motorway</td>
                        <td>Restricted access major divided highway, normally with 2 or more running lanes plus
                            emergency hard shoulder. Equivalent to the Freeway, Autobahn, etc..</td>
                        <td>motorway</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>highway</td>
                        <td>trunk</td>
                        <td>The most important roads in a country's system that aren't motorways. (Need not
                            necessarily be a divided highway.)</td>
                        <td>trunk</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>highway</td>
                        <td>primary</td>
                        <td>The next most important roads in a country's system. (Often link larger towns.)</td>
                        <td>the Bird</td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>highway</td>
                        <td>secondary</td>
                        <td>The next most important roads in a country's system. (Often link towns.)</td>
                        <td>the Bird</td>
                    </tr>
                    <tr>
                        <th scope="row">5</th>
                        <td>highway</td>
                        <td>tertiary</td>
                        <td>The next most important roads in a country's system. (Often link smaller towns and villages) </td>
                        <td>the Bird</td>
                    </tr>
                    <tr>
                        <th scope="row">6</th>
                        <td>highway</td>
                        <td>unclassified</td>
                        <td>The least most important through roads in a country's system – i.e. minor roads of a
                            lower classification than tertiary, but which serve a purpose other than access to properties.
                            Often link villages and hamlets. (The word 'unclassified' is a historical artefact of the UK road system
                            and does <b>not</b> mean that the classification is unknown; you can use</td>
                        <td>the Bird</td>
                    </tr>
                    <tr>
                        <th scope="row">7</th>
                        <td>highway</td>
                        <td>residential</td>
                        <td>Roads which serve as an access to housing, without function of connecting settlements. Often lined with housing. </td>
                        <td>the Bird</td>
                    </tr>
                    <tr>
                        <th scope="row">8</th>
                        <td>highway</td>
                        <td>service</td>
                        <td>For access roads to, or within an industrial estate, camp site, business park, car park etc.
                            Can be used in conjunction with service to indicate the type of usage and with
                            access to indicate who can use it and in what circumstances.</td>
                        <td>the Bird</td>
                    </tr>
                    </tbody>
                </table>

                <?php
                // 3. Use returned data (if any)
                //$numResults = mysqli_num_rows($result);
                //$counter = 0;
                $motorway = array();
                $trunk = array();
                $primary = array();
                $secondary = array();
                $tertiary = array();
                $unclassified = array();
                $residential = array();
                $service = array();

                while($row = mysqli_fetch_assoc($result)){
                    //output data from each row
                    // var_dump($row);
                    if ($row["value"] == "motorway"){
                        $motorway[] = $row["way_id"];
                    }
                    if ($row["value"] == "trunk"){
                        $trunk[] = $row["way_id"];
                    }
                    if ($row["value"] == "primary"){
                        $primary[] = $row["way_id"];
                    }
                    if ($row["value"] == "secondary"){
                        $secondary[] = $row["way_id"];
                    }
                    if ($row["value"] == "tertiary"){
                        $tertiary[] = $row["way_id"];
                    }
                    if ($row["value"] == "unclassified"){
                        $unclassified[] = $row["way_id"];
                    }
                    if ($row["value"] == "residential"){
                        $residential[] = $row["way_id"];
                    }
                    if ($row["value"] == "service"){
                        $service[] = $row["way_id"];
                    }

                    }
                    echo count($motorway)." motorways";
                echo '<br>';
                foreach ($motorway as $value) {
                    echo "<a href=\"way.php?wayid=".$value."\">".motorway."</a>";
                    echo '<br>';
                }
                echo count($trunk)." trunk";
                echo '<br>';
                foreach ($trunk as $value) {
                    echo "<a href=\"way.php?wayid=".$value."\">".trunk."</a>";
                    echo '<br>';
                }
                echo '<br>';
                echo count($primary)." primary";
                foreach ($primary as $value) {
                    echo "<a href=\"way.php?wayid=".$value."\">".primary."</a>";
                    echo '<br>';
                }
                echo '<br>';
                echo count($secondary);
                foreach ($secondary as $value) {
                    echo "<a href=\"way.php?wayid=".$value."\">".secondary."</a>";
                    echo '<br>';
                }
                echo '<br>';
                echo count($tertiary);
                foreach ($tertiary as $value) {
                    echo "<a href=\"way.php?wayid=".$value."\">".tertiary."</a>";
                    echo '<br>';
                }
                echo '<br>';
                echo count($unclassified);
                foreach ($unclassified as $value) {
                    echo "<a href=\"way.php?wayid=".$value."\">".$unclassified."</a>";
                    echo '<br>';
                }
                echo '<br>';
                echo count($residential);
                foreach ($residential as $value) {
                    echo "<a href=\"way.php?wayid=".$value."\">".trunk."</a>";
                    echo '<br>';
                }
                echo '<br>';
                echo count($service);
                foreach ($service as $value) {
                    echo "<a href=\"way.php?wayid=".$value."\">".trunk."</a>";
                    echo '<br>';
                }

                //}
                //   echo"];";

                ?>



                <?php
                // 4. Release returned data
                mysqli_free_result($result);
                ?>
            </div>

            <div class="col-sm-2 sidenav">
                Graphs
                <div class="well">
                    <p><a href="timegraph.php">Time Graphs</a></p>
                </div>
                <div class="well">
                    <p>Users</p>
                </div>
            </div>
        </div>
    </body>
    </html>
<?php
// 5. Close database connection
mysqli_close($connection);
?>