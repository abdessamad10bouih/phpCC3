<?php

    class ClientModel {
        public $table = "client";
        public $conn;
        public $Ncin;
        public $Nom;
        public $Prenom;
        public $Tel;


        public function __construct(){
            require_once '../config/Database.php';
            $database = new Database();
            $this->conn = $database->getConnection();
        }


        public function All(){
            $sql = "SELECT * FROM $this->table";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // echo json_encode($result);
            return $result;
        }

        

    }
    //tests unitaires 


    // $db = new ClientModel();
    // echo $db->All();
    