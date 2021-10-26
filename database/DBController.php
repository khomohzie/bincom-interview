<?php


    class DBController {
        
        // Database Connection Properties
        protected $host = 'localhost';
        protected $user = 'root';
        protected $password = '';
        protected $database = "bincomphptest";

        // connection property
        public $con;
    
        // call constructor
        public function __construct() {
            $this->con = mysqli_connect($this->host, $this->user, $this->password, $this->database);
            if ($this->con->connect_error){
                echo "Fail " . $this->con->connect_error;
            }
        }

        public function __destruct() {
            $this->closeConnection();
        }

        // for mysqli closing connection
        protected function closeConnection() {
            if ($this->con != null ) {
                $this->con->close();
                $this->con = null;
            }
        }
    }

    
    // Sanitize class definition
    class Sanitize {

        public function sanitizeInputs($data){
            $data = trim($data);
            $data = addslashes($data);
            $data = htmlspecialchars($data);

            return $data; 
        }

    }
    // End sanitize class definition


?>