<?php 

require_once('app/Models/Candidato.php');
require_once('app/Models/Region.php');
require_once('app/Models/Voto.php');

class VotacionController
{

    private $candidatoModel;
    private $regionModel;
    private $votoModel;

    public function __construct()
    {
        $this->candidatoModel = new Candidato();
        $this->regionModel = new Region();
        $this->votoModel = new Voto();
    }
    
    public function index()
    {
        $candidatos = $this->candidatoModel->listar();
        $regiones = $this->regionModel->listar();
        require_once('app/Views/Index.php');
    }

    public function store()
    {
        try {

            $nombre     = $_POST['nombre'];
            $alias      = $_POST['alias'];
            $rut        = $_POST['rut'];
            $email      = $_POST['email'];
            $comuna     = $_POST['comuna'];
            $candidato  = $_POST['candidato'];
            $como       = $_POST['como'];

            //  Validaciones
            // Nombre
            if ( strlen($nombre) < 1 ) {
                throw new Exception('Debe ingresar su Nombre y Apellido');
            }
            //  Alias
            if ( strlen($alias) < 6) {
                throw new Exception('El Alias debe tener más de 5 caracteres');
            }

            if ( !preg_match('/\d/',$alias) ) {
                throw new Exception('El Alias debe contener números');
            }

            if ( !preg_match('/[a-zA-Z]/', $alias) ) {
                throw new Exception('El Alias debe contener letras');
            }
            // RUT
            if ( !$this->validateRut($rut) ) {
                throw new Exception('El RUT es incorrecto');
            }

            if ( count($this->votoModel->obtenerPorRut($rut)) ) {
                throw new Exception('Solo se puede ingresar un voto por RUT');
            }
            // Email
            if ( !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
                throw new Exception('El Email no es valido');
            }
            // comuna
            if ( !$comuna ) {
                throw new Exception('Debe ingresar su Comuna');
            }
            // Candidato
            if ( !$candidato ) {
                throw new Exception('Debe ingresar su Candidato');
            }
            // Como se enteró
            if ( count($como) < 2 ) {
                throw new Exception('Debe seleccionar al menos dos campos "Como se enteró de Nosotros"');
            }

            $voto = array(
                'nombre'    => $nombre,
                'alias'     => $alias,
                'rut'       => $rut,
                'email'     => $email,
                'comuna'    => $comuna,
                'candidato' => $candidato,
                'como'      => json_encode($como)
            );

            $votoId = $this->votoModel->store($voto);

            if ( !$votoId ) {
                throw new Exception('Hubo un error inesperado, revise los datos y vuelva a intentar');
            }

            header('Content-Type: application/json');
            echo json_encode(['data' => $votoId]);
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    private function validateRut($rut) 
    {
        // El formato válido es: números, puntos y guión, y un dígito verificador al final
        if (!preg_match("/^[0-9.]+[-]?+[0-9kK]{1}/", $rut)) {
            return false;
        }

        // Elimina puntos y guiones del RUT
        $rut = preg_replace('/[\.\-]/i', '', $rut);

        // Extrae el dígito verificador y el número del RUT
        $dv = substr($rut, -1);
        $numero = substr($rut, 0, strlen($rut) - 1);

        // Calcula el dígito verificador esperado
        $i = 2;
        $suma = 0;
        foreach (array_reverse(str_split($numero)) as $v) {
            if ($i == 8)
                $i = 2;
            $suma += $v * $i;
            ++$i;
        }
        $dvr = 11 - ($suma % 11);

        // Si el dígito verificador esperado es 11, se reemplaza por 0
        if ($dvr == 11)
            $dvr = 0;

        // Si el dígito verificador esperado es 10, se reemplaza por 'K'
        if ($dvr == 10)
            $dvr = 'K';

        // Compara el dígito verificador esperado con el dígito verificador del RUT
        // Devuelve true si son iguales, false si no lo son
        if ($dvr == strtoupper($dv))
            return true;
        else
            return false;
    }
}
