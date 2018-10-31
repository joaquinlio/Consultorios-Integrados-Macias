<?
	class liquidacion 
	{
		private $idTurno;
        private $medico;
        private $dia;
        private $paciente; 
        private $monto;
	
		public function listarLiquidaciones(){
			$link = Conexion::conectar();
            $sql = "SELECT liquidacion.*, medicos.medNombre,pacientes.pacNombre FROM (liquidacion LEFT JOIN medicos ON liquidacion.medico=medicos.id) LEFT JOIN pacientes ON liquidacion.paciente=pacientes.id";
            $stmt = $link->prepare($sql);
            $stmt->execute();
            $listado = $stmt->fetchAll();
            return $listado;
		}
		public function listarLiquidacionPorMedico($dia,$medico){
			$link = Conexion::conectar();
            $sql = "SELECT liquidacion.*,DATE_FORMAT(liquidacion.dia,'%H:%i') AS dia, medicos.medNombre,pacientes.pacNombre FROM liquidacion LEFT JOIN medicos ON liquidacion.medico=medicos.id LEFT JOIN pacientes ON liquidacion.paciente=pacientes.id WHERE dia LIKE '".$dia."%' AND medico=".$medico;
            /*$sql = "SELECT COUNT(liquidacion.idTurno) as turnos,SUM(liquidacion.monto) as monto, medicos.medNombre FROM liquidacion LEFT JOIN medicos ON liquidacion.medico=medicos.id WHERE dia LIKE '".$dia."%'";*/
            $stmt = $link->prepare($sql);
            $stmt->execute();
            $listado = $stmt->fetchAll();
            return $listado;
		}
    /**
     * @return mixed
     */
    public function getIdTurno()
    {
        return $this->idTurno;
    }

    /**
     * @param mixed $idTurno
     *
     * @return self
     */
    public function setIdTurno($idTurno)
    {
        $this->idTurno = $idTurno;

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
}
 ?>