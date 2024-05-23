<?php
class EquipmentModel {
    private $conn;
    private $table = 'Equipement';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function all() {
        $sql = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $equipments = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $equipments;
    }
}
