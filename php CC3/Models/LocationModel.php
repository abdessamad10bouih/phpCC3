<?php
require_once __DIR__ . '/../config/Database.php';

class LocationModel
{
    public $table = "location";
    public $conn;
    public $NcinClient;
    public $RefEquipement;
    public $DateLoc;
    public $DateRet;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function AjouterLocation($NcinClient, $RefEquipement, $DateLoc, $DateRet = null)
    {
        $sql = "INSERT INTO $this->table (NcinClient, RefEquipement, DateLoc, DateRet) VALUES (:NcinClient, :RefEquipement, :DateLoc, :DateRet)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':NcinClient', $NcinClient);
        $stmt->bindParam(':RefEquipement', $RefEquipement);
        $stmt->bindParam(':DateLoc', $DateLoc);
        $stmt->bindParam(':DateRet', $DateRet);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function ListerLocations()
    {
        $sql = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // echo json_encode($res);
        return $res;
    }

    public function RecupererLocation($RefEquipement)
    {
        $sql = "SELECT * FROM $this->table WHERE RefEquipement = :RefEquipement";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':RefEquipement', $RefEquipement);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($res);
    }
    public function supprimerLocation($clientId, $equipementId)
    {
        $sql = "DELETE FROM location WHERE NcinClient = :clientId AND RefEquipement = :equipementId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':clientId', $clientId);
        $stmt->bindParam(':equipementId', $equipementId);
        if ($stmt->execute()) {
            echo 'supprimer avec succés';
        } else {
            echo 'échec de supprimation';
        }
    }

    public function ListerLocationsClient($NcinClient)
    {
        $sql = "SELECT l.*, e.PrixLocation, (DATEDIFF(IFNULL(l.DateRet, NOW()), l.DateLoc) * e.PrixLocation) AS Montant 
            FROM $this->table l 
            JOIN Equipement e ON l.RefEquipement = e.RefEquipement 
            WHERE l.NcinClient = :NcinClient";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':NcinClient', $NcinClient);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $total = 0;
        foreach ($res as &$location) {
            $total += $location['Montant'];
        }

        $result = [
            'locations' => $res,
            'total' => $total
        ];

        return $result;
    }
}

//tests unitaires

// $loc1 = new LocationModel();
// $loc1->AjouterLocation('P376355', 'Jsk01', '', '');
// $loc1 = new LocationModel();
// $loc1->ListerLocations();
// $loc1 = new LocationModel();
// $loc1->RecupererLocation('Pch76');
// $cls1 = new LocationModel();
// echo $cls1->supprimerLocation('P376355', 'Jsk01');
