<?php
require_once './controllers/LocationController.php';
require_once './controllers/EquipementController.php';


$equipmentController = new EquipmentController();
$locationController = new LocationController();

$action = $_GET['action'] ?? null;

switch ($action) {
    case 'add':
        $locationController->index();
        break;
    case 'list':
        $locations = $locationController->location->ListerLocations();
        echo json_encode($locations);
        break;
    case 'get':
        $RefEquipement = $_GET['RefEquipement'] ?? null;
        if ($RefEquipement) {
            $locationController->getEquipmentDetails($RefEquipement);
        } else {
            echo 'Missing ref parameter';
        }
        break;
    case 'delete':
        $NcinClient = $_GET['NcinClient'] ?? null;
        $RefEquipement = $_GET['RefEquipement'] ?? null;
        if ($NcinClient && $RefEquipement) {
            $locationController->deleteEquipmentRental($NcinClient, $RefEquipement);
        } else {
            echo 'Missing required parameters';
        }
        break;
    case 'listClient':
        $NcinClient = $_GET['NcinClient'] ?? null;
        $RefEquipement = $_GET['RefEquipement'] ?? null;
        if ($NcinClient && $RefEquipement) {
            $locations = $locationController->location->ListerLocationsClient($NcinClient, $RefEquipement);
            echo json_encode($locations);
        } else {
            echo 'Missing required parameters';
        }
        break;
    case 'allEquipments':
        $equipmentController->AllEquipments();
        break;
    default:
        echo 'Invalid action';
        break;
}
