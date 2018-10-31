<?
	class Turno
	{
        private $id;
        private $dia;
        private $paciente;
        private $medico;
        private $dni;
        private $monto;
        private $adicional;
        private $observacion;

        public function listarTurnos($strFecha,$medico){
            $link = Conexion::conectar();
            $sql = "SELECT turnos.*, DATE_FORMAT(turnos.dia,'%H:%i') as dia, pacientes.pacNombre, pacientes.obrasocial, pacientes.dni, pacientes.telefono, pacientes.email, obrasocial.razonsocial FROM turnos LEFT JOIN pacientes ON turnos.paciente = pacientes.id LEFT JOIN obrasocial ON pacientes.obrasocial = obrasocial.id WHERE dia LIKE '".$strFecha." %' AND medico='".$medico."' ORDER BY dia";
            $stmt = $link->prepare($sql);
            $stmt->execute();
            $listado = $stmt->fetchAll();
            return $listado;
        }
         public function listarTurnosPorMedico($id,$dia){
            $link = Conexion::conectar();
            $sql = "SELECT turnos.*,DATE_FORMAT(turnos.dia,'%H:%i') as dia, pacientes.pacNombre FROM turnos
                    LEFT JOIN pacientes ON turnos.paciente = pacientes.id  WHERE dia LIKE '".$dia." %' ORDER BY dia ";
            $stmt = $link->prepare($sql);
            //$stmt->bindParam(":id", $id,PDO::PARAM_STR);
            //$stmt->bindParam(":dia", $id,PDO::PARAM_STR);            
            $stmt->execute();
            $listado = $stmt->fetchAll();
            return $listado;          
        }
        private function cargarDatosDesdeForm(){
            if(isset($_POST['id'])){
                $this->setId($_POST['id']);
            }   
            if(isset($_POST['dia'])){
                $this->setDia($_POST['dia']);
            }
            if(isset($_POST['paciente'])){
                $this->setPaciente($_POST['paciente']);
            }
            if(isset($_POST['medico'])){
                $this->setMedico($_POST['medico']);
            }
            if(isset($_POST['dni'])){
                $this->setDni($_POST['dni']);
            }
            if(isset($_POST['monto'])){
                $this->setMonto($_POST['monto']);
            }
            if(isset($_POST['observacion'])){
                $this->setObservacion($_POST['observacion']);
            }
            if(isset($_POST['adicional'])){
                $this->setAdicional($_POST['adicional']);
            }

        }
        public function agregarTurno(){
            $this->cargarDatosDesdeForm();
            $dia = $this->getDia();
            $paciente = $this->getPaciente();
            $medico = $this->getMedico();
            $monto = $this->getMonto();
            $adicional = $this->getAdicional();
            $observacion = $this->getObservacion();              
            $link = Conexion::conectar();
            $sql = "INSERT INTO turnos (dia,paciente,medico,monto,adicional,observacion)
                                VALUES 
                                ('".$dia."',".$paciente.",".$medico.",".$monto.",'".$adicional."','".$observacion."')";
            $stmt = $link->prepare($sql);    
            $stmt->execute();          
        }
        public function editarTurno(){
            $this->cargarDatosDesdeForm();
            $dia = $this->getDia();
            $id = $this->getId();
            $paciente = $this->getPaciente();
            $monto = $this->getMonto();
            $adicional = $this->getAdicional();
            $observacion = $this->getObservacion();             
            $link = Conexion::conectar();
            $sql = "UPDATE turnos SET dia = '".$dia."', paciente = :paciente, monto = ".$monto.", adicional='".$adicional."', observacion ='".$observacion."' WHERE id=:id";
            $stmt = $link->prepare($sql);
            $stmt->bindParam(":id", $id,PDO::PARAM_STR);
            $stmt->bindParam(":paciente", $paciente,PDO::PARAM_STR);     
            $stmt->execute();          
        }
        public function borrarTurno(){
            $this->cargarDatosDesdeForm();
            $id = $this->getId();
            $link = Conexion::conectar();
            $sql = "DELETE FROM turnos WHERE id=".$id;
            $stmt = $link->prepare($sql);
            //$stmt->bindParam(":id", $id,PDO::PARAM_STR);
            $stmt->execute();            
        }
        public function realizarPago(){
            $this->cargarDatosDesdeForm();
            $id = $this->getId();
            $link = Conexion::conectar();
            $sql = "UPDATE turnos SET pago = 1 WHERE id=:id";
            $stmt = $link->prepare($sql);
            $stmt->bindParam(":id", $id,PDO::PARAM_STR);
            $stmt->execute();
            $dia = $this->getDia();
            $paciente = $this->getPaciente();
            $medico = $this->getMedico();
            $monto = $this->getMonto();
            $adicional = $this->getAdicional();
            $observacion = $this->getObservacion();       
            $sql2 = "INSERT INTO liquidacion (idTurno,medico,dia,paciente,monto,adicional,observacion)
                                VALUES 
                                (".$id.",".$medico.",'".$dia."', ".$paciente.",".$monto.",'".$adicional."','".$observacion."')";
            $stmt2 = $link->prepare($sql2);
            $stmt2->bindParam(":id", $id,PDO::PARAM_STR);
            $stmt2->execute();
        }
	
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDia()
    {
        return $this->dia;
    }

    /**
     * @param mixed $dia
     *
     * @return self
     */
    public function setDia($dia)
    {
        $this->dia = $dia;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaciente()
    {
        return $this->paciente;
    }

    /**
     * @param mixed $paciente
     *
     * @return self
     */
    public function setPaciente($paciente)
    {
        $this->paciente = $paciente;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMedico()
    {
        return $this->medico;
    }

    /**
     * @param mixed $medico
     *
     * @return self
     */
    public function setMedico($medico)
    {
        $this->medico = $medico;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * @param mixed $dni
     *
     * @return self
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMonto()
    {
        return $this->monto;
    }

    /**
     * @param mixed $monto
     *
     * @return self
     */
    public function setMonto($monto)
    {
        $this->monto = $monto;

        return $this;
    }

    /**
     * @return mixed
     */

    /**
     * @return mixed
     */
    public function getObservacion()
    {
        return $this->observacion;
    }

    /**
     * @param mixed $observacion
     *
     * @return self
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAdicional()
    {
        return $this->adicional;
    }

    /**
     * @param mixed $adicional
     *
     * @return self
     */
    public function setAdicional($adicional)
    {
        $this->adicional = $adicional;

        return $this;
    }
}
?>
