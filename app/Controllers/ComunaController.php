<?php 

require_once('app/Models/Comuna.php');

class ComunaController
{

    private $comunaModel;

    public function __construct()
    {
        $this->comunaModel = new Comuna();
    }
    
    public function index()
    {
        try {
            $regionId = $_GET['region'];
            $comunas = $this->comunaModel->obtenerComunas($regionId);

            header('Content-Type: application/json');
            echo json_encode(['data' => $comunas]);
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
