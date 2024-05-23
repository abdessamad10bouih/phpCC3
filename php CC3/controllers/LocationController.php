<?php

require_once __DIR__ . '/../models/LocationModel.php';

class LocationController
{
    public $location;

    public function __construct()
    {
        $this->location = new LocationModel();
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $NcinClient = $_POST['NcinClient'];
            $RefEquipement = $_POST['RefEquipement'];
            $DateLoc = $_POST['DateLoc'];
            $DateRet = $_POST['DateRet'];

            if ($NcinClient && $RefEquipement && $DateLoc) {
                $result = $this->location->AjouterLocation($NcinClient, $RefEquipement, $DateLoc, $DateRet);
                if ($result) {
                    echo 'Location added successfully';
                } else {
                    echo 'Failed to add location';
                }
            } else {
                echo 'Missing required fields';
            }
        } else {
            echo 'Invalid request method';
        }
    }
    public function list()
    {
        $locations = $this->location->ListerLocations();
        echo json_encode($locations);
    }

    public function getEquipmentDetails($RefEquipement)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if ($RefEquipement) {
                $details = $this->location->RecupererLocation($RefEquipement);
                if ($details) {
                    echo json_encode($details);
                } else {
                    echo 'No details found for the given equipment reference';
                }
            } else {
                echo 'Missing equipment reference';
            }
        } else {
            echo 'Invalid request method';
        }
    }
    public function deleteEquipmentRental($NcinClient, $RefEquipement)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($NcinClient && $RefEquipement) {
                $result = $this->location->supprimerLocation($NcinClient, $RefEquipement);
                if ($result) {
                    echo 'Rental deleted successfully';
                } else {
                    echo 'Failed to delete rental';
                }
            } else {
                echo 'Missing required fields';
            }
        } else {
            echo 'Invalid request method';
        }
    }
    public function listClientRentals($NcinClient)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if ($NcinClient) {
                $rentals = $this->location->ListerLocationsClient($NcinClient);
                if ($rentals) {
                    $totalAmount = 0;
                    foreach ($rentals as &$rental) {
                        $totalAmount += $rental['amount'];
                    }
                    $response = [
                        'rentals' => $rentals,
                        'totalAmount' => $totalAmount
                    ];
                    echo json_encode($response);
                } else {
                    echo 'No rentals found for the given client';
                }
            } else {
                echo 'Missing client identifier';
            }
        } else {
            echo 'Invalid request method';
        }
    }
}
