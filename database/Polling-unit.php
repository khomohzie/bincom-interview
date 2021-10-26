<?php

    // Polling unit class

    class PollingUnit {
        public $db;

        public function __construct(DBController $db) {
            if (!isset($db->con)) return null;
            $this->db = $db;
        }

        // Display result for any individual polling unit
        function getIndividualPollingUnitResult($unique_id) {
            
            // sql query
            $sql = "SELECT * FROM `announced_pu_results` WHERE polling_unit_uniqueid = '$unique_id'";
            
            // execution of query
            $result = $this->db->con->query($sql);
            
            if ($this->db->con->error) {
            
                // logging of error into a file
                $individualPollingResult = 'fetch_result_error.txt';
                
                $error_msg = "Unable to get individual polling unit result because ".$this->db->con->error."\n";
                file_put_contents($individualPollingResult, $error_msg, FILE_APPEND);
                
                return "<div class='alert alert-danger'>"."There is an error: ".$this->db->con->error."</div>";
            }
            elseif ($result->num_rows > 0) {
                while ( $row = $result->fetch_assoc()) {
                    $rows[] = $row; 
			    }
                
                return $rows;
            } else {
                return "<div class='alert alert-danger'>Polling Unit result unavailable, please chechk back later.</div>";
            }
    
        }

        // Get polling unit from a state
        function getPollingUnit($state_id) {
            
            // sql query
            $sql = "SELECT * FROM `polling_unit` RIGHT JOIN `lga` ON `polling_unit`.lga_id = `lga`.lga_id WHERE state_id = '$state_id' ORDER BY polling_unit_name";
            
            // execution of query
            $result = $this->db->con->query($sql);
            
            if ($this->db->con->error) {
            
                // logging of error into a file
                $polling_unit_fetch_error = 'polling_unit_fetch_error.txt';
            
                $error_msg = "Unable to get polling unit name because ".$this->db->con->error."\n";
                file_put_contents($polling_unit_fetch_error, $error_msg, FILE_APPEND);
                
                return "<div class='alert alert-danger'>"."There is an error: ".$this->db->con->error."</div>";
            } elseif ($result->num_rows > 0) {
                while ( $row = $result->fetch_assoc()) {
                    $rows[] = $row;         
			    }
                
                return $rows;
            } else {
                return "<div class='alert alert-danger'></div>";
            }
        }
    }

?>