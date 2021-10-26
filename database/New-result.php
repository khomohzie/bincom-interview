<?php

    // New Polling units and party results
    
    class NewResult {
        public $db;

        public function __construct(DBController $db) {
            if (!isset($db->con)) return null;
            $this->db = $db;
        }

        // Get all political parties
        function getPoliticalParties () {
            
            // sql query
            $sql = "SELECT * FROM party";
            
            // execution of query
            $result = $this->db->con->query($sql);
            
            if ($this->db->con->error) {
                
                // logging of error into a file
                $fetch_party_error = 'fetch_party_error.txt';
                
                $error_msg = "Unable to get all political parties because ".$this->db->con->error."\n";
                file_put_contents($fetch_party_error, $error_msg, FILE_APPEND);
                
                return "<div class='alert alert-danger'>"."There is an error: ".$this->db->con->error."</div>";
            } elseif ($result->num_rows > 0) {
                while ( $row = $result->fetch_assoc()) {
                    $rows[] = $row; 
                }
                
                return $rows;
            } else {
                return "<div class='alert alert-danger'>Polling Unit result unavailable, refresh.</div>";
            }
        }
        
        // Insert political parties results
        function insertPoliticalPartiesScore (
                                            $partyScore, 
                                            $registered_user, 
                                            $polling_unit_id, 
                                            $user_ip_address
                                        ) {
            // looping the array of political party score to insert to database
            foreach ($partyScore as $key => $value) {
                if (empty($value)) {
                   continue;
                }
                
                // sql query
                $sql = "INSERT INTO announced_pu_results  SET  polling_unit_uniqueid = (SELECT uniqueid FROM polling_unit WHERE uniqueid = '$polling_unit_id'), entered_by_user = '$registered_user', party_abbreviation = '$key', party_score = '$value', user_ip_address = '$user_ip_address'";
                
                // execution of query
                $result = $this->db->con->query($sql);
             }
             if ($this->db->con->error) {
                
                // logging of error into a file
                $upload_party_result_error = 'party_result_error.txt';
                
                $error_msg = "Unable to upload new polling unit with id '".$polling_unit_id."' results  because ".$this->db->con->error."\n";
                file_put_contents($upload_party_result_error, $error_msg, FILE_APPEND);
                
                return "<div class='alert alert-danger'>"."There is an error: ".$this->db->con->error."</div>";
            } elseif ($this->db->con->affected_rows >= 1) {
                $msg1 = "<div class='alert alert-success' id='msg1'>Result successfully uploaded</div>";
                
                // redirect to create polls page
                header("Location: create-polls.php?msg=$msg1");
                
                exit;
            } else {
                return "<div class='alert alert-danger'>Result Insertion failed! Try again</div>";
            }
   
        }
    }

?>