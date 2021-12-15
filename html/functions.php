<?php

/* The "require_once 'resource/database.php';" statement below is pulling the database.php for
 * use in this page. Open database.php and take a look. Notice that database.php establishes a
 * connection to your database and stores that connection into a variable called $db. By including
 * database.php on this page we have access to the $db connection. We pass $db into a function
 * to make the connection and query the database.
 */

include 'resource/database_techInnovations.php';

function returnAllNodes($timestamp, $node_id, $db)
{
    try {
        $sqlQuery = /** @lang MariaDB */
            "SELECT * FROM db_techInnovations.records WHERE timestamp = :timestamp AND node_id =:node_id";
        $statement = $db->prepare($sqlQuery);
        $statement->execute(array(':timestamp' => $timestamp, ':node_id' => $node_id));
        if ($statement->rowCount() > 1) {
            return true;
        }
        return false;
    } catch (PDOException $ex) {
        //handle exception
        return false;
    }
}

function checkDuplicateWaypoints($timestamp, $node_id, $db)
{
    try {
        $sqlQuery = /** @lang MariaDB */
            "SELECT * FROM db_techInnovations.records WHERE timestamp = :timestamp AND node_id =:node_id";
        $statement = $db->prepare($sqlQuery);
        $statement->execute(array(':timestamp' => $timestamp, ':node_id' => $node_id));
        if ($statement->rowCount() > 1) {
            return true;
        }
        return false;
    } catch (PDOException $ex) {
        //handle exception
        return false;
    }
}

//function fetch_light_status($db)
//{
//    $sql = /** @lang MariaDB */
//        "SELECT * FROM db_techInnovations.nodes.quality_status";
//    $stmt = $db->prepare($sql);
//    $stmt->execute();
//    return $stmt->fetchAll(PDO::FETCH_ASSOC);
//}

/*
 * This function is used for displaying an array on the frontend
 * in a nice, easy to read format
 */
function pre_r($array)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

/*
 * Sanitizes user input
 */
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
