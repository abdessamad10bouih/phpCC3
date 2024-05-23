<?php
require_once 'models/EquipmentModel.php';

class EquipmentController {
    private $equipmentModel;

    public function __construct() {
        $this->equipmentModel = new EquipmentModel();
    }

    public function AllEquipments() {
        $equipments = $this->equipmentModel->all();
        echo json_encode($equipments);
        // return $equipments;
    }

}