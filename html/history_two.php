<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include dirname(__FILE__) . '/resource/database_techInnovations.php';
include dirname(__FILE__) . '/Models/AirQualityNode.php';

if (isset($db)) {
    $airQualityNodes = new AirQualityNode($db);
}
$all = $airQualityNodes->getNodeTwo();

?>

<!doctype html>
<html lang="en">
<body>

<nav>
    <ul>
        <li><a href="http://www.leebweeb.com/">Home</a></li>
        <li><a href="/history_one.php">Quality History</a></li>
        <li><a href="/co2map.php">CO2 Map</a></li>
    </ul>

</nav>




<div class="container" style="margin-top: 125px;">
    <div class="row">
        <ul>
            <li><a href="/history_one.php">Node One</a></li>
            <li><a href="/history_two.php">Node Two</a></li>
            <li><a href="/history_three.php">Node Three</a></li>
        </ul>
        <div class="col-lg-12">
            <h3>Air Quality - ISAT Building - Node Two</h3>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Node ID</th>
                    <th scope="col">Location</th>
                    <th scope="col">Timestamp</th>
                    <th scope="col">CO2 (PPM)</th>
                    <th scope="col">Tempurature (F)</th>
                    <th scope="col">Humidity</th>
                    <th scope="col">Pressure(Pascals)</th>
                </tr>
                </thead>
                <tbody id="table_body_airqualitystatus">
                <?php
                foreach ($all as $item) { ?>
                    <tr id="<?php echo $item['node_id']; ?>">
                        <td>2</td>
                        <td>Stairwell</td>
                        <td><?php echo $item['timestamp']; ?></td>
                        <td><?php echo $item['co2']; ?></td>
                        <td><?php echo $item['temp']; ?></td>
                        <td><?php echo $item['humidity']; ?></td>
                        <td><?php echo $item['pressure']; ?></td>
                    </tr>
                <?php }; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Import Bootstrap 5 JavaScript Files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

</body>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <!-- Import Bootstrap 5 Framework -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="js/jquery.js" type="application/javascript"></script>
    <title>Quality History</title>
</head>
</html>

