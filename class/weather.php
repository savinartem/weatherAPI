<?php
    class weather{

        // Connection
        private $conn;

        // Table
        private $db_table = "weatherdb";

        // Columns

        public $name;
        public $temp;
        public $description;
        public $wind;
        public $atmp;
        public $icon;
        public $humidity;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getWeather(){
            $sqlQuery = "SELECT name,temp,wind,atmp,description, icon, humidity FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createWeather(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        temp = :temp, 
                        wind = :wind, 
                        atmp = :atmp,
                        icon= :icon,
                        description=:description ,
                        humidity=:humidity
                        ";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->temp=htmlspecialchars(strip_tags($this->temp));
            $this->wind=htmlspecialchars(strip_tags($this->wind));
            $this->atmp=htmlspecialchars(strip_tags($this->atmp));
            $this->description=htmlspecialchars(strip_tags($this->description));
            $this->icon=htmlspecialchars(strip_tags($this->icon));
            $this->humidity=htmlspecialchars(strip_tags($this->humidity));

        
            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":temp", $this->temp);
            $stmt->bindParam(":wind", $this->wind);
            $stmt->bindParam(":atmp", $this->atmp);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":icon", $this->icon);
            $stmt->bindParam(":humidity", $this->humidity);

        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function getSingleWeather(){
            $sqlQuery = "SELECT
                        name,  
                        temp, 
                        wind,  
                        atmp,
                        description,
                        icon,
                        humidity
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       name = ?
                       LIMIT 0,1
                       ";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->name);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->name = $dataRow['name'];
            $this->temp = $dataRow['temp'];
            $this->wind = $dataRow['wind'];
            $this->atmp = $dataRow['atmp'];
            $this->description = $dataRow['description'];
            $this->icon = $dataRow['icon'];
            $this->humidity = $dataRow['humidity'];

        }        

        // UPDATE
        public function updateWeather(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        temp = :temp, 
                        wind = :wind, 
                        atmp = :atmp,
                        description=:description,
                        icon=: icon,
                        humidity=:humidity
                       
                    WHERE 
                        name = :name";
        
            $stmt = $this->conn->prepare($sqlQuery);
        

            $this->temp=htmlspecialchars(strip_tags($this->temp));
            $this->wind=htmlspecialchars(strip_tags($this->wind));
            $this->atmp=htmlspecialchars(strip_tags($this->atmp));
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->description=htmlspecialchars(strip_tags($this->description));
            $this->icon=htmlspecialchars(strip_tags($this->icon));
            $this->humidity=htmlspecialchars(strip_tags($this->humidity));


        
            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":temp", $this->temp);
            $stmt->bindParam(":wind", $this->wind);
            $stmt->bindParam(":atmp", $this->atmp);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":icon", $this->icon);
            $stmt->bindParam(":humidity", $this->humidity);

        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteWeather(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE name = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->name=htmlspecialchars(strip_tags($this->name));
        
            $stmt->bindParam(1, $this->name);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>

