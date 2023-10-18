<?php
    class dog_adoption{

        // Connection
        private $conn;

        // Table
        private $db_table = "dog_adoption";

        // Columns
        public $id;
        public $name;
        public $breed;
        public $age;
        public $gender;
        public $date_entered;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getDog(){
            $sqlQuery = "SELECT id, name, breed, age, gender, date_entered FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createDog(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        breed = :breed, 
                        age = :age, 
                        gender = :gender, 
                        date_entered = :date_entered";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->breed=htmlspecialchars(strip_tags($this->breed));
            $this->age=htmlspecialchars(strip_tags($this->age));
            $this->gender=htmlspecialchars(strip_tags($this->gender));
            $this->date_entered=htmlspecialchars(strip_tags($this->date_entered));
        
            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":breed", $this->breed);
            $stmt->bindParam(":age", $this->age);
            $stmt->bindParam(":gender", $this->gender);
            $stmt->bindParam(":date_entered", $this->date_entered);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function getSingleDog(){
            $sqlQuery = "SELECT
                        id, 
                        name, 
                        breed, 
                        age, 
                        gender, 
                        date_entered
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->name = $dataRow['name'];
            $this->breed = $dataRow['breed'];
            $this->age = $dataRow['age'];
            $this->gender = $dataRow['gender'];
            $this->date_entered = $dataRow['date_entered'];
        }        

        // UPDATE
        public function updateDog(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        breed = :breed, 
                        age = :age, 
                        gender = :gender, 
                        date_entered = :date_entered
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->breed=htmlspecialchars(strip_tags($this->breed));
            $this->age=htmlspecialchars(strip_tags($this->age));
            $this->gender=htmlspecialchars(strip_tags($this->gender));
            $this->date_entered=htmlspecialchars(strip_tags($this->date_entered));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":email", $this->breed);
            $stmt->bindParam(":age", $this->age);
            $stmt->bindParam(":designation", $this->gender);
            $stmt->bindParam(":created", $this->date_entered);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteDog(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>

