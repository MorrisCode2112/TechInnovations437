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
    <nav>
        <ul>
            <li><a href="http://www.leebweeb.com/">Home</a></li>
            <li><a href="/history_one.php">Quality History</a></li>
            <li><a href="/co2map.php">CO2 Map</a></li>
        </ul>

    </nav>
</head>
<script>

    function draw() {
        let canvas = document.getElementById('airmap');
        setInterval(function() {
            clear();
            let co1 = <?php $airQualityNodes->getNodeOneCO(); ?>;
            let co2 = <?php $airQualityNodes->getNodeTwoCO(); ?>;
            let co3 = <?php $airQualityNodes->getNodeThreeCO(); ?>;

            if (400 < co1 < 1000) {
                let n1g = co1;
                let n1r = .425 * (co1 - 400);
            }

            if (co1 > 1000) {
                let n1r = co1;
                let n1g = 1.275 * (co1 - 1000);
            }

            if (canvas.getContext) {
                let ctx = canvas.getContext('2d');
                ctx.fillStyle = 'rgb(200, 24, 0)';
                ctx.fillRect(10, 10, 50, 50);

                ctx.fillStyle = 'rgba(0, 0, 200, 0.5)';
                ctx.fillRect(30, 30, 50, 50);
            }
        }, 1000);
    }
    function clear() {
        let canvas = document.getElementById('airmap');

        if (canvas.getContext) {
            let ctx = canvas.getContext('2d');
            ctx.clearRect(0, 0, canvas.width, canvas.height);

        }
    }
</script>
<body onload="draw();">

<br>
<br>
<p style="text-align:center;">
<img src="/images/isatmap.png" alt="ISAT Map"  width="878" height="467">
    <canvas id="airmap" width="878" height="467">

    </canvas>
</p>
</body>
</html>