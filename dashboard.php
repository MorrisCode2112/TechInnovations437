<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include dirname(__FILE__) . '/resource/database_techInnovations.php';
include dirname(__FILE__) . '/Models/AirQualityNode.php';

if (isset($db)) {
    $airQualityNodes = new AirQualityNode($db);
}
$current_status = $airQualityNodes->getAirQualityNodesCurrentInfo();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Import Bootstrap 5 Framework -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="js/jquery.js" type="application/javascript"></script>
    <title>Document</title>
</head>
<body>
<div class="container" style="margin-top: 125px;">
    <div class="row">
        <div class="col-lg-12">
            <h3>Air Quality - ISAT Building - Dashboard</h3>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Node ID</th>
                    <th scope="col">Location</th>
                    <th scope="col">Timestamp</th>
                    <th scope="col">CO2</th>
                    <th scope="col">Temp</th>
                    <th scope="col">Humidity</th>
                    <th scope="col">Pressure</th>
                </tr>
                </thead>
                <tbody id="table_body_airqualitystatus">
                <?php foreach ($current_status as $item) { ?>
                    <tr id="<?php echo $item['node_id']; ?>">
                        <td><?php echo $item['node_id']; ?></td>
                        <td><?php echo $item['location']; ?></td>
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
<script>
    let markup = "";
    let target_row = "";
    /* ======= AJAX REQUEST ========
       Return data as JSON OBJECT
       Retrieve data and send as parameter to function
    */
    setInterval(function () {
        let request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;
        request.open('GET', '/api/api_returnCurrentAirQualityStatus.php', true);
        request.setRequestHeader("content-type", "application/json");
        request.send();
        // console.log("Request: ", request);
        request.onreadystatechange = function () {
            if ((request.readyState === 4) && (request.status === 200)) {
                let items = JSON.parse(request.responseText);
                console.log("JSON: ", items);
                items.forEach(element => {
                    let node_id = element['node_id'];
                    let location = element['location'];
                    let timestamp = element['timestamp'];
                    let node_name = element['node_name'];
                    let co2 = element['co2'];
                    let temp = element['temp'];
                    let humidity = element['humidity'];
                    let pressure = element['pressure'];
                    let quality_status = element['quality_status'];
                    target_row = document.getElementById(node_id);
                    markup =
                        "<td style=\"color: green\">" + node_id + "</td>" +
                        "<td style=\"color: green\">" + location + "</td>" +
                        "<td style=\"color: green\">" + timestamp + "</td>" +
                        "<td style=\"color: green\">" + co2 + "</td>" +
                        "<td style=\"color: green\">" + temp + "</td>" +
                        "<td style=\"color: green\">" + humidity + "</td>" +
                        "<td style=\"color: green\">" + pressure + "</td>";
                    // console.log(target_row.innerHTML);
                    target_row.innerHTML = markup;
                })
                markup = "";
            }
        }
    }, 5000);


</script>
<!-- Import Bootstrap 5 JavaScript Files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

</body>
</html>

