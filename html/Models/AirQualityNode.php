<?php

class AirQualityNode
{
    private $conn;
    private $mac_address;

    public $node_id;
    public $node_name;
    public $location;
    public $quality_status;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAirQualityNodesCurrentInfo()
    {
        $sql_query = /** @lang MySQL */
//            "SELECT * FROM db_techInnovations.node_records_view group by node_id, timestamp order by node_id, timestamp asc";
            "SELECT 
                db_techInnovations.nodes.node_id,
                db_techInnovations.nodes.node_name,
                db_techInnovations.nodes.location,
                db_techInnovations.node_records_view.node_id,   
                db_techInnovations.node_records_view.co2,
                db_techInnovations.node_records_view.temp,
                db_techInnovations.node_records_view.humidity,
                db_techInnovations.node_records_view.pressure,    
                db_techInnovations.node_records_view.timestamp
            from db_techInnovations.nodes 
            left join db_techInnovations.node_records_view on       
                db_techInnovations.nodes.node_id = db_techInnovations.node_records_view.node_id;
       

            ";
        $stmt = $this->conn->prepare($sql_query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAll()
    {
        $sql_query = /** @lang MySQL */
            "SELECT 
                db_techInnovations.nodes.node_id,
                db_techInnovations.nodes.location,
                db_techInnovations.records.co2,
                db_techInnovations.records.timestamp,
                db_techInnovations.records.temp,
                db_techInnovations.records.humidity,
                db_techInnovations.records.pressure
                from db_techInnovations.nodes 
                inner join db_techInnovations.records ON 
                db_techInnovations.nodes.node_id = db_techInnovations.records.node_id";
        $stmt = $this->conn->prepare($sql_query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNodeOne() {
        $sql_query = /** @lang MySQL */
            "SELECT 
                
                db_techInnovations.records.node_id,
                db_techInnovations.records.co2,
                db_techInnovations.records.timestamp,
                db_techInnovations.records.temp,
                db_techInnovations.records.humidity,
                db_techInnovations.records.pressure
                from db_techInnovations.records
                where db_techInnovations.records.node_id = 1
                ";
        $stmt = $this->conn->prepare($sql_query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNodeTwo() {
        $sql_query = /** @lang MySQL */
            "SELECT 
                
                db_techInnovations.records.node_id,
                db_techInnovations.records.co2,
                db_techInnovations.records.timestamp,
                db_techInnovations.records.temp,
                db_techInnovations.records.humidity,
                db_techInnovations.records.pressure
                from db_techInnovations.records
                where db_techInnovations.records.node_id = 2
                ";
        $stmt = $this->conn->prepare($sql_query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNodeThree() {
        $sql_query = /** @lang MySQL */
            "SELECT 
                
                db_techInnovations.records.node_id,
                db_techInnovations.records.co2,
                db_techInnovations.records.timestamp,
                db_techInnovations.records.temp,
                db_techInnovations.records.humidity,
                db_techInnovations.records.pressure
                from db_techInnovations.records
                where db_techInnovations.records.node_id = 3
                ";
        $stmt = $this->conn->prepare($sql_query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNodeOneCO() {
        $sql_query = /** @lang MySQL */
            "SELECT 
                db_techInnovations.node_records_view.co2
                from db_techInnovations.node_records_view
                where db_techInnovations.node_records_view.node_id = 1
                ";
        $stmt = $this->conn->prepare($sql_query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNodeTwoCO() {
        $sql_query = /** @lang MySQL */
            "SELECT 
                db_techInnovations.node_records_view.co2
                from db_techInnovations.node_records_view
                where db_techInnovations.node_records_view.node_id = 2
                ";
        $stmt = $this->conn->prepare($sql_query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNodeThreeCO() {
        $sql_query = /** @lang MySQL */
            "SELECT 
                db_techInnovations.node_records_view.co2
                from db_techInnovations.node_records_view
                where db_techInnovations.node_records_view.node_id = 3
                ";
        $stmt = $this->conn->prepare($sql_query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}