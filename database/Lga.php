<?php

    // Local Government Area (LGA) class

    class Lga {
        public $db;

        public function __construct(DBController $db) {
            if (!isset($db->con)) return null;
            $this->db = $db;
        }

        // Get all local government from a state
        function getAllLocalGoverments ($state_id) {
            
            // sql query
            $sql = "SELECT * FROM `lga` WHERE state_id = '$state_id'";
            
            // execution of query
            $result = $this->db->con->query($sql);
            
            if ($this->db->con->error) {
                
                // logging of error into a file
                $lga_fetch_error = 'lga_fetch_error.txt';
                
                $error_msg = "Unable to fetch local governments because ".$this->db->con->error."\n";
                file_put_contents($lga_fetch_error, $error_msg, FILE_APPEND);
                
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

        // Get total summed result from a partcular local government
        function getTotalResultFromLocalGovernment($lga_id){
            
            // sql query
            $sql = "SELECT party_abbreviation, SUM(party_score) AS total_result FROM `announced_pu_results` JOIN `polling_unit` ON `announced_pu_results`.polling_unit_uniqueid = `polling_unit`.uniqueid WHERE lga_id = '$lga_id' GROUP BY party_abbreviation";
            
            // execution of query
            $result = $this->db->con->query($sql);
            
            if ($this->db->con->error) {
                
                // logging of error into a file
                $lga_result_error = 'lga_result_error.txt';
                
                $error_msg = "Unable to get total result from local government because ".$this->db->con->error."\n";
                file_put_contents($lga_result_error, $error_msg, FILE_APPEND);
                
                return "<div class='alert alert-danger'>"."There is an error: ".$this->db->con->error."</div>";
            } elseif ($result->num_rows > 0) {
                while ( $row = $result->fetch_assoc()) {
                    $rows[] = $row; 
			    }
                
                return $rows;
            } else {
                return "<div class='alert alert-danger'>Oops!, Unable to fetch local government result please try again later.</div>";
            }
        }

    }

?>