<?php

    // Create polls and result class

    class Create {
        public $db;

        public function __construct(DBController $db) {
            if (!isset($db->con)) return null;
            $this->db = $db;
        }

        // Create new polling unit
        function createNewPollingUnit (
                                        $polling_unit_id,
                                        $ward_id, $lga_id,
                                        $uniquewardid, 
                                        $polling_unit_number, 
                                        $polling_unit_name, 
                                        $polling_unit_description, 
                                        $registered_user
                                    ) {
            // sql query
            $sql = "INSERT INTO polling_unit(
                                            polling_unit_id, 
                                            ward_id, 
                                            lga_id, 
                                            uniquewardid, 
                                            polling_unit_number, 
                                            polling_unit_name, 
                                            polling_unit_description, 
                                            entered_by_user
                                        ) 
                                        VALUES(
                                            '$polling_unit_id', 
                                            '$ward_id', 
                                            '$lga_id', 
                                            '$uniquewardid', 
                                            '$polling_unit_number', 
                                            '$polling_unit_name', 
                                            '$polling_unit_description', 
                                            '$registered_user'
                                        ) ";
            
            // execution of query
            $result = $this->db->con->query($sql);
            
            if ($this->db->con->error) {
                // logging of error into a file
                $create_polling_unit_error = 'create_polling_unit_error.txt';
                
                $error_msg = "Unable to create a new polling unit because because ".$this->db->con->error."\n";
                file_put_contents($create_polling_unit_error, $error_msg, FILE_APPEND);
                
                return "<div class='alert alert-danger'>"."There is an error: ".$this->db->con->error."</div>";
            } elseif ($this->db->con->affected_rows == 1) {
                $unique_id = $this->db->con->insert_id;
                
                $msg = "<div class='alert alert-success' id='msg1'>Polling Unit Successfully Created</div>";
                
                // redirect to the new result page
                header("Location: new-result3.php?msg=$msg&unique_id=$unique_id&reg_user=$registered_user");
                
                exit;
                
            } else {
                return "<div class='alert alert-danger'>Polling Unit result unavailable, refresh.</div>";
            }
        }

        // Fetch All Wards
        function fetchAllWards() {
            
            // sql query
            $sql = "SELECT * FROM ward ORDER BY ward_name";
            
            // execution of query
            $result = $this->db->con->query($sql);
            
            if ($this->db->con->error) {
                
                // logging of error into a file
                $fetch_ward_error = 'fetch_ward_error.txt';
                
                $error_msg = "Unable to fetch ward because ".$this->db->con->error."\n";
                file_put_contents($fetch_ward_error, $error_msg, FILE_APPEND);
                
                return "<div class='alert alert-danger'>"."There is an error: ".$this->db->con->error."</div>";
            } elseif ($result->num_rows > 0) {
                while ( $row = $result->fetch_assoc()) {
                    $rows[] = $row; 
			    }
                
                return $rows;
            } else {
                return "<div class='alert alert-danger'>Unable to get Ward data</div>";
            }
        }

        
    }

?>